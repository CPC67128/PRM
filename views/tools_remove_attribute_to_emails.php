<?php BeginForm('tools_remove_attribute_to_emails'); ?>
1 email per line<br />
<textarea name="emails" rows=10></textarea><br />
Which attribute to remove?
<input id="attribute" name="attribute" size="60"><br />
<?php EndForm('tools_remove_attribute_to_emails', '../controllers/tools_controller.php?type=remove_attribute_to_emails'); ?>

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