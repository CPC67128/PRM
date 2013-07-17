<?php
include 'form_management.php';
begin_form();
?>
Include these attributes :<br />
<input class="attribute" name="attribute_include_1" size="60"><br />
<input class="attribute" name="attribute_include_2" size="60"><br />
<input class="attribute" name="attribute_include_3" size="60"><br />
<br />
Exclude these attributes :<br />
<input class="attribute" name="attribute_exclude_1" size="60"><br />
<input class="attribute" name="attribute_exclude_2" size="60"><br />
<input class="attribute" name="attribute_exclude_3" size="60"><br />
<br />
<?php end_form('Envoyer', '../prm_controllers/tools_controller.php?type=export_emails'); ?>

<script type="text/javascript" charset="utf-8">
$(function() {

	var availableTagsAttributeNames = [
	<?php
	$resultat = GetAllAttributesForContact();
	$first_record = true;
	while ($ligne = mysql_fetch_assoc($resultat))
	{
		if (!$first_record)
		echo ',';
		echo '"'.str_replace('"','\"', $ligne["attribute"]).'"';
		$first_record = false;
	}
	?>
];

$( ".attribute" ).autocomplete({
	source: availableTagsAttributeNames
});

});
</script>