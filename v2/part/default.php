<h3>Anniversaires</h3>
<ul>
<?php
$resultat = GetBirthdaysHighlight();
$n = mysql_num_rows($resultat);
for ($i = 0; $i < $n; $i++)
{
	$row = mysql_fetch_assoc($resultat);
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
$n = mysql_num_rows($resultat);
for ($i = 0; $i < $n; $i++)
{
  $row = mysql_fetch_assoc($resultat);
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

<h3>Des actions à faire sur des contacts ?</h3>
<ul>
<?php
$resultat = GetContactsNextActionsHighlight();
$n = mysql_num_rows($resultat);
for ($i = 0; $i < $n; $i++)
{
  $row = mysql_fetch_assoc($resultat);
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

<h3>Des actions à faire sur des entreprises ?</h3>
<ul>
<?php
$resultat = GetCompaniesNextActionsHighlight();
$n = mysql_num_rows($resultat);
for ($i = 0; $i < $n; $i++)
{
  $row = mysql_fetch_assoc($resultat);
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