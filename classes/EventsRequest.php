<?php
/**
 * 
 */
class EventsRequest {
	const GET = 'get';
	const POST = 'post';

	protected $name = null;
	protected $method = null;
	protected $params = array();
	
	public function __construct($request, $method = EventsRequest::GET) {
		$this->method = $method;

		$this->name = array_shift($request);
		if (!$this->name) {
			$this->name = 'all';
		}

		while (count($request) > 0) {
			$key = array_shift($request);
			$value = array_shift($request);
			$this->params[$key] = $value;
		}
	}

	public function isGet() {
		return $this->method == EventsRequest::GET;
	}

	public function isPost() {
		return $this->method == EventsRequest::POST;
	}

	public function isAjax() {
		return elgg_is_xhr();
	}

	public function get($key, $default = null, $filter = true) {
		if (isset($this->params[$key])) {
			return $this->params[$key];
		} else {
			// @todo look into mocking $_GET/$_POST variables
			return get_input($key, $default, $filter);
		}
	}

	public function getName() {
		return $this->name;
	}
}