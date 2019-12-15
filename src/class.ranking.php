<?php

class Ranking {
	/**
	 *
	 */
	public static function getGlobalState() {

		return array(
			"status" => "updated",
			"contestants" => Contestant::dbGetAll()
		);
		
	}
}