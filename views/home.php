<h3>Anniversaires</h3>
<ul>
<?php
$resultat = GetBirthdaysHighlight();
$n = $resultat->num_rows;
for ($i = 0; $i < $n; $i++)
{
	$row = $resultat->fetch_assoc();
?>
<li>
<span class="centerLink" onclick="DisplayRecord(TYPE_CONTACT, <?php echo $row["contact_id"]; ?>);">
<font color="<?php if ($row["birthday"] < date("Y-m-d",time())) echo 'darkblue'; else if ($row["birthday"] > date("Y-m-d",time())) echo 'green'; else echo 'red'; ?>">
<?php echo $row["birthday"]; ?>&nbsp;:&nbsp;<?php echo $row["first_name"]; ?>&nbsp;<?php echo $row["last_name"]; ?>
</font>
</span>
</li>
<?php
}
?>
</ul>

<h3>Quelques contacts à mettre à jour</h3>
<ul>
<?php
$resultat = GetContactsToUpdateHighlight();
$n = $resultat->num_rows;
for ($i = 0; $i < $n; $i++)
{
  $row = $resultat->fetch_assoc();
?>
<li>
<span class="centerLink" onclick="DisplayRecord(TYPE_CONTACT, <?php echo $row["contact_id"]; ?>);">
<?php echo $row["first_name"]; ?>&nbsp;<?php echo $row["last_name"]; ?>
</span>
</li>
<?php
}
?>
</ul>

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
<br />
<div class="row">
<small>
<a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Licence Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" /></a><br />PRM / Private Relationship Manager de <a href="http://stevefuchs.fr">Steve Fuchs</a> est mis à disposition selon les termes de la <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">Licence Creative Commons Attribution 4.0 International</a>.
</small>
</div>