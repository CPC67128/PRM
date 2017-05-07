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


AddGroup('contact_files', 'Fichiers');
AddGroup('contact_identity', 'Identité');
AddGroup('contact_personal', 'Personnel');
AddGroup('contact_professional', 'Professionnel');
AddGroup('contact_followup', 'Suivi');
AddGroup('contact_comment', 'Commentaires');
AddGroup('contact_attributes', 'Attributs');



function AddTextBox($row, $fieldName, $label, $placeHolder)
{
	$value = $row[$fieldName];

	if (strlen($placeHolder) == 0)
		$placeHolder = $label;

	if (strlen($label) == 0)
	{
?>
<div class="form-group">
	<input type="text" class="form-control small" name="<?= $fieldName ?>" placeholder="<?= $placeHolder ?>" value="<?= $value ?>" autocomplete="off" >
</div>
<?php
	}
	else
	{
?>
<div class="form-group">
	<label for="<?= $fieldName ?>"><?= $label ?></label>
	<input type="text" class="form-control small" name="<?= $fieldName ?>" id="<?= $fieldName ?>" placeholder="<?= $placeHolder ?>" value="<?= $value ?>" autocomplete="off" >
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





function BeginForm($idForm)
{
	global $row;
	?>
<div id="div<?= $idForm ?>">
<form action="/" method="post" id="form<?= $idForm ?>">
<input type="hidden" name="contact_id" value="<?= $row["contact_id"] ?>">

	<?php
}

function EndForm($idForm, $controller, $functionToCallOnSuccess = "")
{
	?>
<div class="pull-right">
	<label id="form<?= $idForm ?>Result"></label>
	<button type="submit" class="btn btn-primary" id="submit<?= $idForm ?>">Enregistrer</button>
	<button type="reset" class="btn btn-default" id="reset<?= $idForm ?>" >Annuler</button>
</div>
</form>

<script type="text/javascript" charset="utf-8">
$("#form<?= $idForm ?>").submit(function () {
	document.getElementById("submit<?= $idForm ?>").disabled = true;
	$.post(
      "<?= $controller ?>",
      $(this).serialize(),
      function(response, status){
    	  document.getElementById("submit<?= $idForm ?>").disabled = false;
          if (status == 'success')
          {
              <?php
              if ($functionToCallOnSuccess != "")
              	echo $functionToCallOnSuccess;
              else ?>
				$("#form<?= $idForm ?>Result").html(response);
          }
          else
          {
              $("#form<?= $idForm ?>Result").html(status);
          }
      }
    );

	return false;   
});
</script>

</div>

<?php
}
?>
