<?php
/**
 * 
 */
class EventsAllController extends EventsController {
	public function get(EventsRequest $request) {
		// @todo add to response?
		elgg_register_title_button();

		$response = new EventsResponse();
		$response->setTitle('All Events');
		$response->setParams(array(
			'title' => 'test',
			'content' => 'hello, world',
		));
		return $response;
	}
}