<?php

class ContestantViewGlobalState {
	/**
	 *
	 */
	private $gs_status;

	/**
	 *
	 */
	private $gs_message;

	/**
	 *
	 */
	private $gs_contestant;

	/**
	 *
	 */
	function __construct($status, $message, $contestant) {
		$this->gs_status = $status;
		$this->gs_message = $message;
		$this->gs_contestant = $contestant;
	}

	/**
	 *
	 */
	public function jsonEncode() {
		return json_encode(array(
			"status" => $this->gs_status,
			"message" => $this->gs_message,
			"contestant" => json_decode($this->gs_contestant->jsonEncode())
		));
	}
}