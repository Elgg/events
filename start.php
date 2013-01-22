<?php

elgg_register_event_handler('init', 'system', 'events_init');

function events_init() {
	$item = new ElggMenuItem('events', elgg_echo('events'), 'events');
	elgg_register_menu_item('site', $item);

	elgg_register_page_handler('events', 'events_page_handler');

	$actions = __DIR__ . "/actions";
	elgg_register_action('events/cancel', "$actions/events/cancel.php");
	elgg_register_action('events/rsvp', "$actions/events/rsvp.php");
	elgg_register_action('events/save', "$actions/events/save.php");
}

function events_page_handler($segments) {
	$handler = new EventsRequestHandler();
	$response = $handler->process(new EventsRequest($segments));
	if (!$response) {
		return false;
	}
	
	$body = elgg_view_layout($response->getLayout(), $response->getParams());
	echo elgg_view_page($response->getTitle(), $body);
	return true;
}
