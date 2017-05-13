<?php
include '../views_old_to_review/center_panels/form_management.php';
begin_form();
?>
1 email per line<br />
<textarea name="emails" rows=20 cols=100><?php if (isset($_POST["emails"])) echo $_POST["emails"]; ?></textarea>
<br />
Which attribute to remove?
<input id="attribute" name="attribute" size="60">
<br />
<?php end_form('Envoyer', '../prm_controllers/tools_controller.php?type=remove_attribute_to_emails'); ?>

<script type="text/javascript" charset="utf-8">
$(function() {
	var availableTagsAttributeNames = [
	<?php
	$resultat = GetAllAttributesForContact();
	$first_record = true;
	while ($ligne = $resultat->fetch_assoc())
	{
		if (!$first_record)
		echo ',';
		echo '"'.str_replace('"','\"', $ligne["attribute"]).'"';
		$first_record = false;
	}
	?>
];

$( "#attribute" ).autocomplete({
	source: availableTagsAttributeNames
});

$("#attribute").focus(function () {
	$("#attribute").select();
});

});
</script>