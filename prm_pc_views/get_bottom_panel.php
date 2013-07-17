<?php
include_once '../dal/dal_prm.php';
?>
<div id="bottomPanelDynamic">
<?php
$type = '';
if (isset($_GET['type']))
	$type = $_GET['type'];

$id = -1;
if (isset($_GET['id']))
	$id = $_GET['id'];

$page = '';
if (isset($_GET['page']))
	$page = $_GET['page'];

// ====================================== CONTACT ======================================

if ($type == 'contact' && $id >= 0)
{
	UpdateLastViewDate($id);
	$row = GetContactRow($id);
	include 'bottom_panels/contact.php';
}

// ====================================== COMPANY ======================================

else if ($type == 'company' && $id >= 0)
{
	$row = GetCompanyRow($id);
	include 'bottom_panels/company.php';
}

// ====================================== DEFAULT ======================================

else
{
	include 'bottom_panels/default.php';
}
?>
</div>