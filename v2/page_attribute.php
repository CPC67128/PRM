<?php
$row = GetAttributeRow($id);

AddGroup('attribute_details', 'Details');

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
