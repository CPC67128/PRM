<?php
include 'controller_top.php';

if (isset($_GET["type"]))
{
	if ($_GET["type"] == "update")
	{
		if (isset($_POST["view_archived"]))
			UpdateConfiguration($_POST["view_archived"] == 'on' ? '1' : '0');
		else
			UpdateConfiguration('0');
	}
	return;
}

die("NO TYPE!");
?>