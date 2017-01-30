<?php
/*
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

*/
$row = GetContactRow($id);
?>
<?php

AddGroup('contact_comment', 'Commentaires');
AddGroup('contact_identity', 'Identité');
AddGroup('contact_personal', 'Personnel');
AddGroup('contact_professional', 'Professionnel');
AddGroup('contact_followup', 'Suivi');

function AddTextBox($row, $fieldName, $label, $placeHolder)
{
	$value = $row[$fieldName];

	if (strlen($placeHolder) == 0)
		$placeHolder = $label;

	if (strlen($label) == 0)
	{
?>
<div class="form-group">
	<input type="text" class="form-control small" id="<?= $fieldName ?>" placeholder="<?= $placeHolder ?>" value="<?= $value ?>" autocomplete="off" >
</div>
<?php
	}
	else
	{
?>
<div class="form-group">
	<label for="<?= $fieldName ?>"><?= $label ?></label>
	<input type="text" class="form-control small" id="<?= $fieldName ?>" placeholder="<?= $placeHolder ?>" value="<?= $value ?>" autocomplete="off" >
</div>
<?php
	}
}
?>


<?php

function AddGroup($divId, $title)
{
	global $row;
	$titleId = $divId.'Title';

?>
<div id="<?= $divId ?>">
<h1 class="page-header" id="<?= $titleId ?>"><?= $title ?></h1>
<?php include 'part/'.$divId.'.php'; ?>
</div>
<?php
}

function BeginForm()
{
	?>
<form action="/signup" method="post">
	<?php
}

function EndForm()
{
	?>
<div class="pull-right">
	<button type="button" class="btn btn-primary">Enregistrer</button>
	<button type="button" id="identity<?= $int ?>Cancel" class="btn btn-default">Annuler</button>
</div>
</form>
<?php
}

?>
