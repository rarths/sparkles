<?php

namespace Rarths\Sparkles;

/**
 * Class for flashing messages in your Anax
 *
 */
class CSparkles {

	use \Anax\DI\TInjectable;

	/**
	 * Instanstiate custom CSS classes. Using default classes if no parameter is passed.
	 *
     * @param array $options with custom CSS classes.
     * 
     * @return void
	 */
	public function __construct($options = array()) {
		// Set CSS classes
		$this->error = isset($options['error']) ? $options['error'] : 'error'; 
		$this->success = isset($options['success']) ? $options['success'] : 'success'; 
		$this->notice = isset($options['notice']) ? $options['notice'] : 'notice'; 
		
	}

	/**
	 * Store message to session.
	 *
     * @param string $message with message to store.
     * 
     * @return void
	 */
	private function _setSession($message) {
		$messages = $this->session->get('flash', []);
		$messages['message'][] = $message;
        $this->session->set('flash', $messages);
	}

	/**
	 * Get message(s) from session.
	 *
     * @return string $message
	 */
	private function _getSession() {
		$message = $this->session->get('flash', []);

		return $message;
	}

	/**
	 * Removes all messages from session.
	 *
     * @return void
	 */
	private function _clean() {
		$this->session->set('flash', []);
	}

	/**
	 * Edit massage with type and send it to session.
	 *
     * @param string $type with the message type.
     * @param string $message with message.
     * 
     * @return void
	 */
	public function flash($type, $message) {
		// Build HTML
		$flash = "<span class='" . $this->{$type} . "'><p>" . $message . "</p></span>";

		$this->_setSession($flash);
	}

	/**
	 * Output stored messages.
	 *
     * @return object $flash with all messages.
	 */
	public function output() {
		$flash = $this->_getSession();
		$this->_clean();

		return $flash['message'];
	}
}