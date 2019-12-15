<?php

require_once("private.php");

if (empty($_POST)) {
	/**
	 * Did not get post
	 */

	http_response_code(400);
} else {
	if (! isset($_POST["enterFormName"])) {
		/**
		 * Got post but did not get enter form name
		 */

		Http::throwError("missing_name", "Unable to register the contestant. Missing contestant name.");
	} else {
		$name = $_POST["enterFormName"];
		
		if ($name == "" || preg_match('/^[a-zA-Z0-9_\- ]$/', $name) || strlen($name) > 60 || strlen($name) < 6) {
			/**
			 * Got post and enter form name but last one was empty
			 */

			Http::throwError("invalid_name", "Unable to register the contestant. Invalid contestant name: is empty, contains invalid characters or has less than 6 characters or more than 60.");
		} else {
			/**
			 * Request is ok
			 */

			if (Contestant::dbNameExists($name)) {
				/**
				 * Name is already registered
				 */

				Http::throwError("name_already_exists", "Unable to register the contestant. Contestant name already exists in the database.");
			} else {
				$contestant = Contestant::dbCreate($name);

				if ($contestant) {
					Http::throwContestantCreateSuccess($contestant);
				} else {
					Http::throwError("db_error", "Unable to register the contestant. Name may already exist or service is unavailable.");
				}
			}
		}
	}
}

?>