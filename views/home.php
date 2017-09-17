<div class="container">
<div class="row">

<div class="col-lg-6">
<h1>Anniversaires</h1>
<div class="list-group">
<?php
$resultat = GetBirthdaysHighlight();
$n = $resultat->num_rows;
for ($i = 0; $i < $n; $i++)
{
	$row = $resultat->fetch_assoc();

	if (isset($row['picture_file_id']) && $row['picture_file_id'] >= 0)
		$pictureUrl = "download.php?file_id=".$row['picture_file_id'];
	else
		$pictureUrl = "../images/avatar-blank.jpg";

	if ($row["birthday"] < date("Y-m-d",time()))
		$class = "list-group-item-primary";
	else if ($row["birthday"] > date("Y-m-d",time()))
		$class = "list-group-item-success";
	else
		$class = "list-group-item-danger";
	?>
	<a href="#" class="list-group-item list-group-item-action <?= $class ?>" onclick="DisplayRecord(TYPE_CONTACT, <?php echo $row["contact_id"]; ?>); return false;">
	<img src="<?= $pictureUrl ?>" style="max-height: 30px;"> 
	<?= $row['first_name'] ?> <?= $row['last_name'] ?> <?php echo $row["birthday"]; ?></a>
	<?php
}
?>
</div>
</div>

<div class="col-lg-6">
<h1>Contacts à mettre à jour</h1>
<div class="list-group">
<?php
$resultat = GetContactsToUpdateHighlight();
$n = $resultat->num_rows;
for ($i = 0; $i < $n; $i++)
{
	$row = $resultat->fetch_assoc();

	if (isset($row['picture_file_id']) && $row['picture_file_id'] >= 0)
		$pictureUrl = "download.php?file_id=".$row['picture_file_id'];
	else
		$pictureUrl = "../images/avatar-blank.jpg";
	?>
	<a href="#" class="list-group-item list-group-item-action" onclick="DisplayRecord(TYPE_CONTACT, <?php echo $row["contact_id"]; ?>); return false;">
	<img src="<?= $pictureUrl ?>" style="max-height: 30px;"> 
	<?= $row['first_name'] ?> <?= $row['last_name'] ?></a>
<?php
}
?>
</div>

<?php
$resultat = GetContactsNextActionsHighlight();
$n = $resultat->num_rows;
if ($n > 0)
{
?>
<h3>Des actions à faire sur des contacts ?</h3>
<ul>
<?php
for ($i = 0; $i < $n; $i++)
{
  $row = $resultat->fetch_assoc();
?>
<li>
<span class="centerLink" onclick="DisplayRecord(TYPE_CONTACT, <?php echo $row["contact_id"]; ?>);">
<?php echo $row["first_name"]; ?>&nbsp;<?php echo $row["last_name"]; ?> : <?php echo $row["next_action"]; ?>
</span>
</li>
<?php
}
?>
</ul>
<?php
}
?>

</div>
<div class="row">

<?php
$resultat = GetContactsNextActionsHighlight();
$n = $resultat->num_rows;
if ($n > 0)
{
?>
<h3>Des actions à faire sur des entreprises ?</h3>
<ul>
<?php
$resultat = GetCompaniesNextActionsHighlight();
$n = $resultat->num_rows;
for ($i = 0; $i < $n; $i++)
{
  $row = $resultat->fetch_assoc();
?>
<li>
<span class="centerLink" onclick="DisplayRecord(TYPE_COMPANY, <?php echo $row["company_id"]; ?>);">
<?php echo $row["name"]; ?> : <?php echo $row["next_action"]; ?>
</span>
</li>
<?php
}
?>
</ul>
<?php
}
?>

</div>
<div class="row">
<small>
<a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Licence Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" /></a><br />PRM / Private Relationship Manager de <a href="http://stevefuchs.fr">Steve Fuchs</a> est mis à disposition selon les termes de la <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">Licence Creative Commons Attribution 4.0 International</a>.
</small>
</div>

</div>