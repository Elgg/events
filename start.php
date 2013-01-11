<?php

elgg_register_event_handler('init', 'system', 'events_init');

function events_init() {
    $actions = __DIR__ . "/actions";
    
    elgg_register_action('events/cancel', "$actions/events/cancel.php");
    elgg_register_action('events/invite', "$actions/events/invite.php");
    elgg_register_action('events/rsvp', "$actions/events/rsvp.php");
    elgg_register_action('events/save', "$actions/events/save.php");
}