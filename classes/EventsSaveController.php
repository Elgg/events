<?php
/**
 * 
 */
class EventsSaveController extends EventsController {
	public function post(EventsRequest $request) {
		$response = new EventsResponse();
		$response->setMessage("Event created...not really");
		$response->setForwardUrl('events/all');
		return $response;
	}
}