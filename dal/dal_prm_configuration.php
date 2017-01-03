<?php

function GetConfigurationRow()
{
	if (!configuration_IsConfigurationExisting())
		configuration_CreateConfigurationRow();

	include 'database_use_start.php';

	$query = 'select * from '.$DB_TABLE_PREFIX.'prm_configuration';
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	$row = $result->fetch_assoc();

	include 'database_use_stop.php';
	
	return $row;
}

function UpdateConfiguration($ViewArchived)
{
	if (!configuration_IsConfigurationExisting())
		configuration_CreateConfigurationRow();

	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = sprintf("update ".$DB_TABLE_PREFIX."prm_configuration set view_archived = %s",
		$ViewArchived);
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';
}

function configuration_IsConfigurationExisting()
{
	include 'database_use_start.php';

	$is_existing = false;

	$query = 'select configuration_id from '.$DB_TABLE_PREFIX.'prm_configuration';
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
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
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return true;
}
?>