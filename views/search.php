<?php
include_once '../dal/dal_prm.php';

$searchString = '';
if (isset($_POST['search_string']))
	$searchString = $_POST['search_string'];

$contacts = SearchContacts($searchString);
$companies = SearchCompanies($searchString);
$attributes = SearchAttributes($searchString);
?>
<div class="row">
<div class="list-group">
<?php
for ($i=0 ; $i < count($contacts) && $i < 10 ; $i++ )
{
	$row = GetContactRow($contacts[$i]['id']);
	$picture_file_id = contact_GetContactPictureFileId($contacts[$i]['id']);

	if ($picture_file_id >= 0)
		$pictureUrl = "download.php?file_id=".$picture_file_id;
	else
		$pictureUrl = "../images/avatar-blank.jpg";
	?>
	<a href="#" class="list-group-item list-group-item-action" onclick="DisplayRecord(TYPE_CONTACT, <?= $contacts[$i]['id'] ?>); return false;">
	<img src="<?= $pictureUrl ?>" style="max-height: 30px;"> 
	<?= $row['first_name'] ?> <?= $row['last_name'] ?></a>
	<?php
}
?>
</div>

<div class="list-group">
<?php
for ($i=0 ; $i < count($companies) && $i < 10 ; $i++ )
{
	$row = GetCompanyRow($companies[$i]['id']);
	?>
	<a href="#" class="list-group-item list-group-item-action" onclick="DisplayRecord(TYPE_COMPANY, <?= $companies[$i]['id'] ?>); return false;"><?= $row['name'] ?></a>
	<?php
}
?>
</div>

<div class="list-group">
<?php
for ($i=0 ; $i < count($attributes) ; $i++ )
{
	$row = GetAttributeRow($attributes[$i]['id']);
	?>
	<a href="#" class="list-group-item list-group-item-action" onclick="DisplayRecord(TYPE_ATTRIBUTE, <?= $attributes[$i]['id'] ?>); return false;"><?= $row['attribute'] ?></a>
	<?php
}
?>
</ul>
</div>

</div>