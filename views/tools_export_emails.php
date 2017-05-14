<?php BeginForm('tools_export_emails'); ?>
Include these attributes :<br />
<input class="attribute" name="attribute_include_1" size="60"><br />
<input class="attribute" name="attribute_include_2" size="60"><br />
<input class="attribute" name="attribute_include_3" size="60"><br />
<br />
Exclude these attributes :<br />
<input class="attribute" name="attribute_exclude_1" size="60"><br />
<input class="attribute" name="attribute_exclude_2" size="60"><br />
<input class="attribute" name="attribute_exclude_3" size="60"><br />
<?php EndForm('tools_export_emails', '../controllers/tools_controller.php?type=export_emails'); ?>

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

$( ".attribute" ).autocomplete({
	source: availableTagsAttributeNames
});

});
</script>