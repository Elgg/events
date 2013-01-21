<?php

class ElggEvent extends ElggObject {
	/** @override */
	protected function initializeAttributes() {
		$this->attributes['subtype'] = 'location';
	}
}