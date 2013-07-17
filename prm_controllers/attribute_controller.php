<?php
include 'controller_top.php';

if (isset($_GET["type"]))
{
	if ($_GET["type"] == "update")
	{
		UpdateAttribute($_POST["attribute_id"], $_POST);
	}
	else if ($_GET["type"] == "delete")
	{
		DeleteAttribute($_POST["attribute_id"]);
	}
	else if ($_GET["type"] == "insert")
	{
		$newAttributeId = CreateAttribute($_POST);
		echo $newAttributeId;
	}
	return;
}

die("NO TYPE");
?>