<?php
/**
 * 
 */
class EventsAddController extends EventsController {
	public function get(EventsRequest $request) {
		$response = new EventsResponse();
		$response->setTitle('Add Event');
		$response->setParams(array(
			'title' => 'Create an event',
			'content' => elgg_view_form('events/save'),
			'filter' => false,
		));
		return $response;
	}
}
