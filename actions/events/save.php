<?php
/**
 * Create a new event or update an existing one.
 */

$request = new EventsRequest(array('save'), EventsRequest::POST);
$handler = new EventsRequestHandler();
$response = $handler->process($request);
if ($response) {
	forward($response->getForwardUrl());
}
