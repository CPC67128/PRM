<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Bootstrap 101 Template</title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<style>
.panel > .panel-heading {
    //background-color: #ff7777;
}
</style>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

<?php
add(1);
add(2);
add(3);
add(4);
?>

</div>


</body>
</html>

<?php 

function add($int)
{
?>

<div id="identity" class="panel panel-primary">

<h1 class=page-header id=breadcrumbs>Breadcrumbs</h1>

  <div class="panel-heading">
  	Identité <?= $int ?>
  </div>
  <div class="panel-body">
  	<div id="identity<?= $int ?>View">
  	<p>Steve Fuchs</p>
  	<button type="button" id="identity<?= $int ?>Toggle" class="btn btn-default pull-right">Modifier</button>
  	</div>
<div id="identity<?= $int ?>Modify"  class="hidden">
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
		<div class="form-group">
			<label for="title">Titre</label>
			<input type="text" class="form-control" id="title" placeholder="Titre" autocomplete="off" >
		</div>
		<div class="form-group">
			<label for="firstName">Prénom</label>
			<input type="text" class="form-control" id="firstName" placeholder="Prénom" value="Steve" autocomplete="off" >
		</div>
		<div class="form-group">
			<label for="lastName">Nom</label>
			<input type="text" class="form-control" id="lastName" placeholder="Nom" value="Fuchs" autocomplete="off" >
		</div>
		<div class="pull-right">
		<button type="button" class="btn btn-primary">Enregistrer</button>
		<button type="button" id="identity<?= $int ?>Cancel" class="btn btn-default">Annuler</button>
		</div>
	</form>
</div>
</div>
</div>

<script>
$(function(){

	$("#identity<?= $int ?>Toggle").click(function()
			{
				$("#identity<?= $int ?>View").addClass('hidden');
				$("#identity<?= $int ?>Modify").removeClass('hidden');
			}
	)

	$("#identity<?= $int ?>Cancel").click(function()
			{
				$("#identity<?= $int ?>View").removeClass('hidden');
				$("#identity<?= $int ?>Modify").addClass('hidden');
			}
	)

	})
</script>
<?php
}

?>