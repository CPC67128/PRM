<?php BeginForm('company_attributes'); ?>

<div class="form-group">
	<label for="set_date">Date</label>
	<input type="text" class="form-control" id="set_date" name="set_date" value="<?php echo date("Y-m-d"); ?>" autocomplete="off" >
</div>

<div class="form-group">
	<label for="new_attribute">Attribut</label>
	<input type="text" class="form-control" id="new_attribute" name="new_attribute" autocomplete="off" >
</div>

<?php EndForm('company_attributes', '../controllers/company_controller.php?type=set_attribute', 'LoadCompanyAttributesDetail();'); ?>


<script type="text/javascript">
var availableTagsAttributes = [
	<?php
		$resultat = GetAttributeNamesForCompany();
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

$( "#new_attribute" ).autocomplete({
	source: availableTagsAttributes
});

$("#new_attribute").focus(function () {
	$("#new_attribute").select();
});
</script>

<div id="divCompanyAttributesDetail" />

<script type="text/javascript" charset="utf-8">
function LoadCompanyAttributesDetail() {
	console.log("LoadCompanyAttributesDetail() called");

	$.post("company_attributes_detail.php",
			{
				id: <?= $row["company_id"] ?>
		    },
		    function(data, status){
		    	$("#divCompanyAttributesDetail").html(data);
		    });
}

LoadCompanyAttributesDetail();
</script>