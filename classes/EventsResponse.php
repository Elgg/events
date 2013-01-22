<?php
/**
 * @todo maybe base class and then inherit for get/post responses
 */
class EventsResponse {
	protected $layout = 'content';
	protected $title = '';
	protected $params = array();
	protected $forwardUrl = REFERER;

	public function __construct() {
		;
	}

	public function setLayout($layout) {
		$this->layout = $layout;
	}

	public function getLayout() {
		return $this->layout;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setParams(array $params) {
		$this->params = $params;
	}

	public function getParams() {
		return $this->params;
	}

	public function setForwardUrl($url) {
		$this->forwardUrl = $url;
	}

	public function getForwardUrl() {
		return $this->forwardUrl;
	}

	public function setMessage($text, $type = 'success') {
		// @todo
		system_message($text);
	}
}