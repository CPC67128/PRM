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
<ul class="list-group">
<?php
for ($i=0 ; $i < count($contacts) && $i < 10 ; $i++ )
{
	$picture_file_id = contact_GetContactPictureFileId($contacts[$i]['id']);
	$row = GetContactRow($contacts[$i]['id']);

	if ($picture_file_id >= 0)
		$pictureUrl = "download.php?file_id=".$picture_file_id;
	else
		$pictureUrl = "avatar-blank.jpg";
	$pictureUrl = "../images/avatar-blank.jpg";
	?>
	<li class="list-group-item">
	    <div class="col-xs-8">
	        <span class="name"><?= $row['first_name'] ?> <?= $row['last_name'] ?></span>
	        <button type="button" class="btn btn-primary" onclick="DisplayRecord(TYPE_CONTACT, <?= $contacts[$i]['id'] ?>);">Modifier</button>
		</div>
	    <div class="clearfix"></div>
	</li>
	<?php
}
?>
</ul>

<ul class="list-group">
<?php
for ($i=0 ; $i < count($companies) && $i < 10 ; $i++ )
{
	$row = GetCompanyRow($companies[$i]['id']);
	?>
	<li class="list-group-item">
	    <div class="col-xs-8">
	        <span class="name"><?= $row['name'] ?></span>
	        <button type="button" class="btn btn-primary" onclick="DisplayRecord(TYPE_COMPANY, <?= $companies[$i]['id'] ?>);">Modifier</button>
		</div>
	    <div class="clearfix"></div>
	</li>
	<?php
}
?>
</ul>

<ul class="list-group">
<?php
for ($i=0 ; $i < count($attributes) ; $i++ )
{
	$row = GetAttributeRow($attributes[$i]['id']);
	?>
	<li class="list-group-item">
	    <div class="col-xs-8">
	 		<span class="name"><?= $row['attribute'] ?></span>
			<button type="button" class="btn btn-primary" onclick="DisplayRecord(TYPE_ATTRIBUTE, <?= $attributes[$i]['id'] ?>);">Modifier</button>
		</div>
	    <div class="clearfix"></div>
	</li>
	<?php
}
?>
</ul>
</div>