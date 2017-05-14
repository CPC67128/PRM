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

<h3>Des actions à faire sur des contacts ?</h3>
<ul>
<?php
$resultat = GetContactsNextActionsHighlight();
$n = $resultat->num_rows;
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

<div class="row">
<a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/deed.fr"><img alt="Licence Creative Commons" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-nd/3.0/88x31.png" /></a><br /><span id="licence"><span xmlns:dct="http://purl.org/dc/terms/" href="http://purl.org/dc/dcmitype/InteractiveResource" property="dct:title" rel="dct:type">PRM / Private Relationship Manager</span> de <a xmlns:cc="http://creativecommons.org/ns#" href="http://stevefuchs.fr" property="cc:attributionName" rel="cc:attributionURL">Steve Fuchs</a> est mis à disposition selon les termes de la <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/deed.fr">licence Creative Commons Attribution - Pas d’Utilisation Commerciale - Pas de Modification 3.0 non transposé</a>.</span>
</div>