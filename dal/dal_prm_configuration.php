<?php

function GetConfigurationRow()
{
	if (!configuration_IsConfigurationExisting())
		configuration_CreateConfigurationRow();

	include 'database_use_start.php';

	$query = 'select * from '.$DB_TABLE_PREFIX.'prm_configuration';
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.$mysqli->error);
	$row = $result->fetch_assoc();

	include 'database_use_stop.php';
	
	return $row;
}

function configuration_IsConfigurationExisting()
{
	include 'database_use_start.php';

	$is_existing = false;

	$query = 'select configuration_id from '.$DB_TABLE_PREFIX.'prm_configuration';
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.$mysqli->error);
	$row = $result->fetch_assoc();

	if (isset($row["configuration_id"]))
		$is_existing = true;

	include 'database_use_stop.php';

	return $is_existing;
}

function configuration_CreateConfigurationRow()
{
	include 'database_use_start.php';

	$is_existing = false;

	$query = 'insert into '.$DB_TABLE_PREFIX.'prm_configuration (view_archived) values (0)';
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.$mysqli->error);

	include 'database_use_stop.php';

	return true;
}
?>