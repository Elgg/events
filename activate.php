<?php
/**
 * Register the class type/subtype association
 */

if (get_subtype_id('object', 'event')) {
	update_subtype('object', 'event', 'ElggEvent');
} else {
	add_subtype('object', 'event', 'ElggEvent');
}
