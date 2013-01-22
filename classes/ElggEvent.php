<?php

class ElggEvent extends ElggObject {

	/**
	 * User is attending the event
	 */
	const RSVP_YES = 1;

	/**
	 * User may attend the event
	 */
	const RSVP_MAYBE = 0;

	/**
	 * User is not attending the event
	 */
	const RSVP_NO = -1;

	/**
	 * Annotation name for response
	 */
	const RSVP_NAME = "rsvp";

	/**
	 * Relationship name for location
	 */
	const LOCATION_NAME = "hasLocation";

	/** @override */
	protected function initializeAttributes() {
		$this->attributes['subtype'] = 'event';
	}

	public function getAttending($limit) {
		return $this->getUsersByResponse(ElggEvent::RSVP_YES, $limit);
	}

	public function getMaybeAttending($limit) {
		return $this->getUsersByResponse(ElggEvent::RSVP_MAYBE, $limit);
	}

	public function getNotAttending($limit) {
		return $this->getUsersByResponse(ElggEvent::RSVP_NO, $limit);
	}

	/**
	 * Get users for this event based on how they responded
	 * 
	 * @param int $response Response code: RSVP_YES, RSVP_NO, RSVP_MAYBE
	 * @param int $limit    Maximum number of users to return
	 * @return array
	 */
	protected function getUsersByResponse($response, $limit) {
		$guid = sanitize_int($this->guid);
		$nameId = sanitize_int(get_metastring_id(ElggEvent::RSVP_NAME));
		$valueId = sanitize_int(get_metastring_id($response));

		// @todo is there a way to do this with the API?
		$db_prefix = elgg_get_config('dbprefix');
		return elgg_get_entities(array(
			'type' => 'user',
			'joins'  => array("JOIN {$db_prefix}annotations a ON e.guid = a.owner_guid"),
			'wheres' => array(
				"a.entity_guid = $guid",
				"a.name_id = $nameId",
				"a.value_id = $valueId",
			),
			'limit' => $limit,
		));
	}

	/**
	 * @param ElggUser $user     The user responding
	 * @param int      $response Response code: RSVP_YES, RSVP_NO, RSVP_MAYBE
	 */
	public function setResponse(ElggUser $user, $response) {
		$this->annotate(ElggEvent::RSVP_NAME, $response, ACCESS_PUBLIC, $user->guid);
	}

	/**
	 * @return DateTime The time this event begins.
	 */
	public function getStartTime() {
		$startTime = new DateTime();
		$startTime->setTimestamp($this->calendar_start);
		return $startTime;
	}

	public function setStartTime(DateTime $startTime) {
		$this->calendar_start = $startTime->getTimestamp();
	}

	/**
	 * @return DateTime The time this event ends.
	 */
	public function getEndTime() {
		$endTime = new DateTime();
		$endTime->setTimestamp($this->calendar_end);
		return $endTime;
	}

	public function setEndTime(DateTime $endTime) {
		$this->calendar_end = $endTime->getTimestamp();
	}

	/**
	 * @return ElggLocation The location of this event.
	 */
	public function getLocation() {
		// inverse relationship means we are querying for guid_one
		$location = elgg_get_entities_from_relationship(array(
			'type' => 'object',
			'subtype' => 'location',
			'relationship' => ElggEvent::LOCATION_NAME,
			'relationship_guid' => $this->guid,
			'inverse_relationship' => true,
			'limit' => 1,
		));
		if ($location) {
			return $location[0];
		} else {
			return null;
		}
	}

	public function setLocation(ElggLocation $location) {
		remove_entity_relationships($this->guid, ElggEvent::LOCATION_NAME);
		$this->addRelationship($location->guid, ElggEvent::LOCATION_NAME);
	}
}