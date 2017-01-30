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

switch ($type)
{
	case 'contact': include_once 'page_contact.php'; break;
	case 'company': include_once 'page_company.php'; break;
	case 'attribute': include_once 'page_attribute.php'; break;
	default: include_once 'search.php'; break;
}
?>