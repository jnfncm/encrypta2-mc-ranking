<?php

class Contestant {
	/**
	 * Contestant identificator (unique integer)
	 */
	private $contestant_id;

	/**
	 * Contestant name (unique integer)
	 */
	private $contestant_name;

	/**
	 * Contestant email address (string)
	 */
	private $contestant_email;

	/**
	 * Contestant current score (double)
	 */
	private $contestant_score;

	/**
	 * Contestant registration date (date)
	 */
	private $contestant_registration_date;

	/**
	 * Inserts a contestant to the database
	 */
	function __construct($id, $name, $email, $score, $registration_date) {
		$this->contestant_id = $id;
		$this->contestant_name = $name;
		$this->contestant_email = $email;
		$this->contestant_score = $score;
		$this->contestant_registration_date = $registration_date;
	}

	/**
	 *
	 */
	public function getId() {
		return $this->contestant_id;
	}

	/**
	 *
	 */
	public function getName() {
		return $this->contestant_name;
	}

	/**
	 *
	 */
	public function hasEmail() {
		return $this->contestant_email != "";
	}

	/**
	 *
	 */
	public function getEmail() {
		return $this->contestant_email;
	}

	/**
	 *
	 */
	public function getScore() {
		return $this->contestant_score;
	}

	/**
	 *
	 */
	public function getRegistrationDate() {
		return $this->contestant_registration_date;
	}

	/**
	 * Checks if a name already exists in database contestants table
	 */
	public static function dbNameExists($name) {
		global $e2mcspa_db, $e2mcspa_db_prefix;
		$statement = $e2mcspa_db->prepare("SELECT name FROM " . $e2mcspa_db_prefix . "contestants WHERE name = ? LIMIT 1");
		$statement->bind_param("s", $name);
		$statement->execute();
		$statement->store_result();
		if($statement->num_rows > 0) {
			$return = true;
		} else {
			$return = false;
		}
		$statement->free_result();
		$statement->close();
		return $return;
	}

	/**
	 *
	 *
	 * @pre $name does not already exist in database contestants table
	 */
	public static function dbCreate($name) {
		global $e2mcspa_db, $e2mcspa_db_prefix;

		$email = "";
		$score = 0;
		$registration_date = time();

		$statement = $e2mcspa_db->prepare("INSERT INTO " . $e2mcspa_db_prefix . "contestants (name, email, score, registration_date) VALUES (?, ?, ?, ?)");
		$statement->bind_param("ssii", $name, $email, $score, $registration_date);
		$result = $statement->execute();
		$result_id = $e2mcspa_db->insert_id;
		$statement->close();
		
		return new Contestant($result_id, $name, $email, $score, $registration_date);
	}

	/**
	 *
	 */
	public function jsonEncode() {
		return json_encode(array(
			"id" => $this->contestant_id,
			"name" => $this->contestant_name,
			"email" => $this->contestant_email,
			"score" => $this->contestant_score,
			"registration_date" => $this->contestant_registration_date
		));
	}

	/**
	 *
	 */
	public static function dbGetAll() {
		global $e2mcspa_db, $e2mcspa_db_prefix;
		$statement = $e2mcspa_db->prepare("SELECT id, name, score FROM " . $e2mcspa_db_prefix . "contestants");
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($id, $name, $score);
		while($statement->fetch()) {
			$rows[] = array("id" => $id, "name" => utf8_encode($name), "score" => $score);
		}
		$statement->close();
		if (! empty($rows)) {
			return $rows;
		} else {
			return null;
		}
	}

	/**
	 *
	 */
	public static function dbUpdateScore($id, $score) {
		global $e2mcspa_db, $e2mcspa_db_prefix;
		$statement = $e2mcspa_db->prepare("UPDATE " . $e2mcspa_db_prefix . "contestants SET score = ? WHERE id = ?");
		$statement->bind_param("ii", $score, $id);
		$result = $statement->execute();
		$statement->close();
		return $result;
	}

	/**
	 *
	 */
	public static function dbRemove($id) {
		global $e2mcspa_db, $e2mcspa_db_prefix;
		$statement = $e2mcspa_db->prepare("DELETE FROM " . $e2mcspa_db_prefix . "contestants WHERE id = ?");
		$statement->bind_param("i", $id);
		$result = $statement->execute();
		$statement->close();
		return $result;
	}

}