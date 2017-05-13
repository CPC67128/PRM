<?php
include 'controller_top.php';

if (isset($_GET["type"]))
{
	if ($_GET["type"] == "update")
	{
		echo UpdateAttribute($_POST["attribute_id"], $_POST);
	}
	else if ($_GET["type"] == "delete")
	{
		DeleteAttribute($_POST["attribute_id"]);
	}
	else if ($_GET["type"] == "insert")
	{
		echo CreateAttribute($_POST);
	}
	return;
}

die("NO TYPE");
?>