<?php
include_once '../configuration/configuration.php';

function IsReadOnly()
{
	global $READ_ONLY;
	if ($READ_ONLY)
		return true;
	return false;
}

function String2StringForSprintfQueryBuilder($String)
{
	include 'database_use_start.php';
	if (get_magic_quotes_gpc())
		$result = $String;
	else
		$result = $mysqli->real_escape_string($String);
	return $result;
}

