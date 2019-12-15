<?php

require_once("private.php");

if (false /*empty($_POST)*/) {
	/**
	 * Did not get post
	 */

	http_response_code(400);
} else {

	header('Content-Type: application/json');
	echo json_encode(Ranking::getGlobalState());
}

?>