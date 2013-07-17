<?php

function ConnectToDBAndReturnMysqli()
{
	global $DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME;
	$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	$mysqli->query("SET NAMES 'utf8'");

	return $mysqli;
}

function GetDBValidString($chaine)
{
	global $mysqli;
	return mysqli_real_escape_string($mysqli, $chaine);
}