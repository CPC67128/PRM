<?php include 'mobile_view_top.php'; ?>
<script type="text/javascript" charset="utf-8">
</script>
</head>
<body>
<?php
if (isset($_GET['contact_id']))
	$ContactId = $_GET['contact_id'];
?>

<div data-role="page" id="home">

<div data-role="header" data-position="inline">
	<a href="index.php" data-icon="back">Home</a>
	<h1>Contact view</h1>
	<div data-role="navbar">
		<ul>
			<li><a href="#home" class="ui-btn-active" data-icon="home">Info</a></li>
			<li><a href="#note" data-icon="grid">Notes</a></li>
			<li><a href="#attribute" data-icon="star">Attributes</a></li>
		</ul>
	</div>
</div>

<div data-role="content">
<?php
$result = GetContactResource($ContactId);
$row = mysql_fetch_assoc($result);

$i = 0;
$fields_to_ignore = array("contact_id", "user_id", "picture_file_id");
while ($i < count($row))
{
	$meta = mysql_fetch_field($result, $i);
	if (!in_array($meta->name, $fields_to_ignore))
	{
		if ($row[$meta->name] != null && $row[$meta->name] != "0")
		{
			if ($meta->name == 'picture_file_name')
			{
				echo '<img src="../uploads/'.$row[$meta->name].'" max-width="270px"><br />';
			}
			elseif ($meta->name == 'company_id')
			{
				$rowowCompany = GetCompanyRow($row[$meta->name]);

				echo $contact_fields[$meta->name].' : <a rel=external href="company_view.php?company_id='.$row[$meta->name].'">'.$rowowCompany["name"].'</a><br />';
			}
			elseif ($meta->name == 'personal_phone' || $meta->name == 'personal_mobile_phone' || $meta->name == 'professional_phone' || $meta->name == 'professional_mobile_phone')
			{
				echo $contact_fields[$meta->name].' : <a rel=external href="tel:'.$row[$meta->name].'">'.$row[$meta->name].'</a><br />';
			}
			elseif ($meta->name == 'personal_email_1' || $meta->name == 'personal_email_2' || $meta->name == 'professional_email' || $meta->name == 'professional_email_2')
			{
				echo $contact_fields[$meta->name].' : <a rel=external href="mailto:'.$row[$meta->name].'">'.$row[$meta->name].'</a><br />';
			}
			else
			{
				echo $contact_fields[$meta->name].' : '.$row[$meta->name].'<br />';
			}
		}
	}
	$i++;
}

?>
</div>

</div>

<!-- --------------- Follow up --------------- -->

<div data-role="page" id="note">

<div data-role="header" data-position="inline">
	<a href="index.php" data-icon="back">Home</a>
	<h1>Contact view</h1>
	<div data-role="navbar">
		<ul>
			<li><a href="#home" data-icon="home">Info</a></li>
			<li><a href="#note" class="ui-btn-active" data-icon="grid">Notes</a></li>
			<li><a href="#attribute" data-icon="star">Attributes</a></li>
		</ul>
	</div>
</div>

<div data-role="content">
<table>
<?php

$result = GetNotesFromContact($ContactId);
$n = mysql_num_rows($result);
for ($i = 0; $i < $n; $i++)
{
	$ligneNote = mysql_fetch_assoc($result);
	?>
	<tr><td>
	<b>
	<?php echo nl2br($ligneNote["creation_date"]); ?>
	&nbsp;<a onclick="var confirmation = confirm('Confirmez-vous la suppression ?'); if (confirmation) window.location = '../prm_controllers/contact_controller_mobile.php?type=remove_note&contact_id=<?php echo $ContactId; ?>&note_id=<?php echo $ligneNote["note_id"]; ?>';">Supprimer</a>
	</b>
	</td></tr>
	<tr><td>
	<?php echo nl2br($ligneNote["comment"]); ?>
	</td></tr>
	<?php
}
?>
</table>

<form method="post" name="add_note" action="../prm_controllers/contact_controller_mobile.php?type=add_note">
<div data-role="fieldcontain">
	<fieldset data-role="controlgroup">
		<label for="textarea">Texte de la note:</label>
		<textarea cols="40" rows="8" name="new_note" id="new_note_textarea"></textarea>
	</div>
	<fieldset data-role="controlgroup">
		<input type="checkbox" name="contact" id="contact" />
		<label for="contact">Contact</label>
    </fieldset>
</div>
<input type="hidden" name="contact_id" value="<?php echo $ContactId; ?>">
<input type="button" onclick="document.forms['add_note'].submit();" value="Ajouter" />
</form>

</div>

</div>

<!-- --------------- Attributes --------------- -->

<div data-role="page" id="attribute">

<div data-role="header" data-position="inline">
	<a href="index.php" data-icon="back">Home</a>
	<h1>Contact view</h1>
	<div data-role="navbar">
		<ul>
			<li><a href="#home" data-icon="home">Info</a></li>
			<li><a href="#note" data-icon="grid">Notes</a></li>
			<li><a href="#attribute" class="ui-btn-active" data-icon="star">Attributes</a></li>
		</ul>
	</div>
</div>

<div data-role="content">
<table>
<?php

$result = GetContactAttributes($ContactId);
$n = mysql_num_rows($result);
for ($i = 0; $i < $n; $i++)
{
	$ligneAttribute = mysql_fetch_assoc($result);
	?>
	<tr><td>
	<?php echo $ligneAttribute["attribute"]; ?>
	</td></tr>
	<?php
}
?>
</table>

</div>
</body>
</html>
