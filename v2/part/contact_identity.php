<?php

$row = GetContactRow(145);

//include 'form_management.php';
//begin_form();
?>





<form action="/signup" method="post">

<div class="form-group">
	<label for="gender">Sexe</label>
	<input type="text" class="form-control" id="gender" placeholder="">
	<div class="btn-group" data-toggle="buttons">
		<label class="btn btn-primary active">
			<input type="radio" name="options" id="gender" autocomplete="off" checked>Homme
		</label>
		<label class="btn btn-primary">
			<input type="radio" name="options" id="gender" autocomplete="off">Femme
		</label>
	</div>
</div>

<?php

AddTextBox($row, 'title', 'Titre');
AddTextBox($row, 'first_name', 'Prénom');
AddTextBox($row, 'last_name', 'Nom');

function AddTextBox($row, $fieldName, $label)
{
	$value = $row[$fieldName];
?>
<div class="form-group">
	<label for="<?= $fieldName ?>"><?= $label ?></label>
	<input type="text" class="form-control small" id="<?= $fieldName ?>" placeholder="<?= $label ?>" value="<?= $value ?>" autocomplete="off" >
</div>
<?php
}
?>

<div class="pull-right">
	<button type="button" class="btn btn-primary">Enregistrer</button>
	<button type="button" id="identity<?= $int ?>Cancel" class="btn btn-default">Annuler</button>
</div>
</form>

<!-- 
<input type="hidden" name="contact_id" value="<?php echo $row["contact_id"]; ?>">
<table>
<tbody>
<tr>
<td>
Sexe
</td>
<td>
<select name="gender">
<option value="M" <?php echo (strcasecmp($row["gender"], 'M') == 0 ? 'selected = "true"' : ''); ?>>M</option>
<option value="F" <?php echo (strcasecmp($row["gender"], 'F') == 0 ? 'selected = "true"' : ''); ?>>F</option>
</select>
</td>
</tr>
<?php
$detail = '';
add_new_row_to_detail('Titre', 'title', 5);
add_new_row_to_detail('Prénom', 'first_name', 30);
add_new_row_to_detail('Nom', 'last_name', 30);
echo $detail;
?>
</tbody>
</table>
 -->


<?php //end_form('Mettre à jour', '../prm_controllers/contact_controller.php?type=update', false, true); ?>