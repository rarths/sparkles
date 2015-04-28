<?php

namespace Rarths\Sparkles;

class CSparkles {

	use \Anax\DI\TInjectable;

	public function __construct($options = array()) {
		if (isset($options) && is_array($options)) {
			$this->error = isset($options['error']) ? $options['error'] : 'error'; 
			$this->success = isset($options['success']) ? $options['success'] : 'success'; 
			$this->notice = isset($options['notice']) ? $options['notice'] : 'notice'; 
		}
	}

	private function _setSession($message) {
		$messages = $this->session->get('flash', []);
		$messages['message'][] = $message;
        $this->session->set('flash', $messages);
	}

	private function _getSession() {
		$message = $this->session->get('flash', []);

		return $message;
	}

	private function _clean() {
		$this->session->set('flash', []);
	}

	public function flash($type, $message) {
		$flash = "<span class='" . $this->{$type} . "'><p>" . $message . "</p></span>";

		$this->_setSession($flash);
	}

	public function output() {
		$flash = $this->_getSession();
		$this->_clean();

		return $flash['message'];
	}
}