<?php
/**
 * Primary handler for HTTP requests
 *
 */
class EventsRequestHandler {

	/**
	 * Process a request
	 * 
	 * @param EventsRequest $request
	 * @return EventsResponse
	 */
	public function process(EventsRequest $request) {

		$controller = $this->getController($request);
		if (!$controller) {
			return null;
		}

		if ($request->isGet()) {
			return $controller->get($request);
		} else {
			return $controller->post($request);
		}
	}

	protected function getController($request) {
		$className = 'Events' . ucfirst($request->getName()) . 'Controller';
		if (class_exists($className)) {
			return new $className();
		} else {
			return null;
		}
	}
}