<?php

class Http {
	/**
	 *
	 */
	public static function throwError($type, $message) {
		header('Content-Type: application/json');

		echo json_encode(array(
			"status" => "error",
			"error_type" => $type,
			"message" => $message
		));
	}

	/**
	 *
	 */
	public static function throwContestantCreateSuccess($contestant) {
		header('Content-Type: application/json');
		
		$gs = new ContestantViewGlobalState("created", "Contestant created successfully.", $contestant);
		echo $gs->jsonEncode();
	}
}