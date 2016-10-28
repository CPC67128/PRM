<?php
include_once '../dal/dal_prm.php';

$type = '';
if (isset($_POST['type']))
	$type = $_POST['type'];

$id = -1;
if (isset($_POST['id']))
	$id = $_POST['id'];

$page = '';
if (isset($_POST['page']))
	$page = $_POST['page'];

if ($type == 'contact')
{
	include_once 'page_contact.php';
}
else
{
	include_once 'search.php';
}
?>