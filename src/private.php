<?php

/**
 * Enable error display
 */
ini_set('display_errors', 'On');
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

/**
 * Set timezone
 */
date_default_timezone_set("Europe/Madrid");
setlocale(LC_ALL,"es_ES");

/**
 * Database configuration
 */
$e2mcspa_db_host = "localhost";
$e2mcspa_db_user = "";
$e2mcspa_db_password = "";
$e2mcspa_db_name = "";
$e2mcspa_db_prefix = "e2mcspa_";

/**
 * Initialize lobals
 */
$e2mcspa_app_title = "Meet cryptocurrencies – encrypta2";
$e2mcspa_app_url = ""; /* Do not add trailing slash */
$e2mcspa_app_path = ""; /* Do not add trailing slash */
$e2mcspa_dir_separator = "\\";
$e2mcspa_db = new mysqli($e2mcspa_db_host, $e2mcspa_db_user, $e2mcspa_db_password, $e2mcspa_db_name);
if ($e2mcspa_db->connect_error) {
	trigger_error('Database connection failed: '  . $dbs->connect_error, E_USER_ERROR);
}

require_once("class.contestant.php");
require_once("class.contestantviewglobalstate.php");
require_once("class.ranking.php");
require_once("class.http.php");