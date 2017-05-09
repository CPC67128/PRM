<?php
include_once '../dal/dal_prm.php';
?>
<div id="leftPanelDynamic">
<?php

$type = '';
if (isset($_GET['type']))
	$type = $_GET['type'];

$id = -1;
if (isset($_GET['id']))
	$id = $_GET['id'];

function AddLink($page)
{
	global $pages;

	$page_identifier = $page;
	$page_identifier = str_replace('contact/', '', $page_identifier);
	$page_identifier = str_replace('company/', '', $page_identifier);
	$page_identifier = str_replace('attribute/', '', $page_identifier);
	$page_identifier = str_replace('tools/', '', $page_identifier);
?>
<div class="leftLink" onclick="SetPage('<?php echo $page_identifier; ?>'); return false;"><?php echo $pages[$page]; ?></div>
<?php
}

if ($type == 'contact' && $id >= 0)
{
?>
<div class="leftDescription"><?php echo GetContactShortDescription($id); ?></div>
<?php
$picture_file_id = contact_GetContactPictureFileId($id);
if ($picture_file_id >= 0)
{
?>
<img class="pictureView" src="download.php?file_id=<?php echo $picture_file_id; ?>" border=0 /><br />
<?php
}
?>
<br />
<?php
	AddLink($type.'/identity');
	AddLink($type.'/personal');
	AddLink($type.'/professional');
	AddLink($type.'/followup');
	AddLink($type.'/comment');
	AddLink($type.'/attributes');
	AddLink($type.'/files');
	AddLink($type.'/relations');
	AddLink($type.'/actions');
?>
<div class="leftLink" onclick="window.open('http://www.google.com/search?q=<?php echo GetContactGoogleItSearchString($id); ?>','Google it!','toolbar=1,scrollbars=1');">Google it!</div>
<?php
}
else if ($type == 'company' && $id >= 0)
{
?>
<div class="leftDescription"><?php echo GetCompanyShortDescription($id); ?></div>
<?php
$picture_file_id = company_GetCompanyPictureFileId($id);
if ($picture_file_id >= 0)
{
?>
<img class="pictureView" src="download.php?file_id=<?php echo $picture_file_id; ?>" border=0 /><br />
<?php
}
?>
<br />
<?php
	AddLink($type.'/details');
	AddLink($type.'/activities');
	AddLink($type.'/recruitment');
	AddLink($type.'/followup');
	AddLink($type.'/comment');
	AddLink($type.'/attributes');
	AddLink($type.'/files');
	AddLink($type.'/actions');
?>
<div class="leftLink" onclick="window.open('http://www.google.com/search?q=<?php echo GetCompanyGoogleItSearchString($id); ?>','Google it!','toolbar=1,scrollbars=1');">Google it!</div>
<?php
}
else if ($type == 'attribute' && $id >= 0)
{
?>
<div class="leftDescription"><?php echo GetAttributeShortDescription($id); ?></div>
<br />
<?php
	AddLink($type.'/details');
	AddLink($type.'/contacts');
	AddLink($type.'/companies');
	AddLink($type.'/actions');
}
else if ($type == 'configuration')
{
}
else if ($type == 'tools')
{
	AddLink($type.'/invalidate_emails');
	AddLink($type.'/check_emails_in_database');
	AddLink($type.'/set_attribute_to_emails');
	AddLink($type.'/set_last_contact_date_to_emails');
	AddLink($type.'/remove_attribute_to_emails');
	AddLink($type.'/export_emails');
}
?>
</div>