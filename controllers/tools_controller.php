<?php
include 'controller_top.php';

if (isset($_GET["type"]))
{
	if ($_GET["type"] == "check_emails_in_database")
	{
		$result = check_emails_in_database($_POST);
		echo 'Traitement terminé !<br/><br />'; 
		echo $result;
	}
	else if ($_GET["type"] == "export_emails")
	{
		$result = export_emails($_POST);
		echo 'Traitement terminé !<br/><br />La liste des emails est :<br />'; 
		echo $result;
	}
	else if ($_GET["type"] == "invalidate_emails")
	{
		$result = invalidate_emails($_POST);
		echo 'Traitement terminé !<br/><br />';
		echo $result;
	}
	else if ($_GET["type"] == "set_attribute_to_emails")
	{
		$result = set_attribute_to_emails($_POST);
		echo 'Traitement terminé !<br/><br />';
		echo $result;
	}
	else if ($_GET["type"] == "set_last_contact_date_to_emails")
	{
		$result = set_last_contact_date_to_emails($_POST);
		echo 'Traitement terminé !<br/><br />';
		echo $result;
	}
	else if ($_GET["type"] == "remove_attribute_to_emails")
	{
		$result = remove_attribute_to_emails($_POST);
		echo 'Traitement terminé !<br/><br />';
		echo $result;
	}
	
	return;
}

die("NO TYPE!");
?>