<?php

class ElggLocation extends ElggObject {
	/** @override */
	protected function initializeAttributes() {
		$this->attributes['subtype'] = 'location';
	}
}