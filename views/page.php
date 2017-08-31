<div class="container">
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

if ($id == -1)
{
	switch ($type)
	{
		case 'contact': include_once 'contact_creation.php'; break;
		case 'company': include_once 'company_creation.php'; break;
		case 'attribute': include_once 'attribute_creation.php'; break;
		case 'tools': include_once 'tools.php'; break;
		default: include_once 'home.php'; break;
	}
}
else
{
	switch ($type)
	{
		case 'contact': include_once 'contact.php'; break;
		case 'company': include_once 'company.php'; break;
		case 'attribute': include_once 'attribute.php'; break;
		case 'tools': include_once 'tools.php'; break;
		default: include_once 'home.php'; break;
	}
}

// ----- AddTextBox -----
function AddTextBox($row, $fieldName, $label, $placeHolder, $type='text')
{
	$value = $row[$fieldName];

	if (strlen($placeHolder) == 0)
		$placeHolder = $label;

	if (strlen($label) == 0)
	{
		?>
		<div class="form-group">
			<input type="<?= $text ?>" class="form-control" name="<?= $fieldName ?>" placeholder="<?= $placeHolder ?>" value="<?= $value ?>" autocomplete="off" >
		</div>
		<?php
	}
	else
	{
		?>
		<div class="form-group">
			<label for="<?= $fieldName ?>" class="col-form-label"><?= $label ?></label>
			<input type="<?= $type ?>" class="form-control" name="<?= $fieldName ?>" id="<?= $fieldName ?>" placeholder="<?= $placeHolder ?>" value="<?= $value ?>" autocomplete="off" >
		</div>
		<?php
	}
}
?>


<?php


function BeginRow()
{
	?>
	<div class="row justify-content-md-center">
	<?php
}

function EndRow()
{
	?>
	<div class="row justify-content-md-center">
	<?php
}

function AddGroup($divId, $title, $class = "col-xl-12") 
{
	global $row;
	$titleId = $divId.'Title';
?>
<div id="<?= $divId ?>" class="<?= $class ?>">
<?php if (strlen($title) > 0) { ?>
<h1 class="page-header" id="<?= $titleId ?>"><?= $title ?></h1>
<?php } ?>
<?php include ''.$divId.'.php'; ?>
</div>
<?php
}

function AddGroupLink($divId, $title)
{
	?>
	<a class="groupLink" href="#<?= $divId ?>"><?= $title ?></a>
	<?php
}





function BeginForm($idForm)
{
	global $row, $type;
	?>
<div id="div<?= $idForm ?>">
<form action="/" method="post" id="form<?= $idForm ?>">
	<?php
	switch ($type)
	{
		case 'contact': ?> <input type="hidden" name="contact_id" value="<?= $row["contact_id"] ?>"> <?php break;
		case 'company': ?> <input type="hidden" name="company_id" value="<?= $row["company_id"] ?>"> <?php break;
		case 'attribute': ?> <input type="hidden" name="attribute_id" value="<?= $row["attribute_id"] ?>"> <?php break;
	}
}

function EndForm($idForm, $controller, $functionToCallOnSuccess = "", $submitButtonText="")
{
	?>
<div class="form-group">
	<div class="float-right">
	<button type="submit" class="btn btn-primary" id="submit<?= $idForm ?>">Enregistrer</button>
	<button type="reset" class="btn btn-default" id="reset<?= $idForm ?>" >Annuler</button>
	<label id="form<?= $idForm ?>Result"></label>
	</div>
</div>
</form>

<script type="text/javascript" charset="utf-8">
$("#form<?= $idForm ?>").submit(function () {
	console.log("submit on #form<?= $idForm ?>");
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

function SpecialEndForm($idForm, $controller, $functionToCallOnSuccess = "")
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
</div>
</div>