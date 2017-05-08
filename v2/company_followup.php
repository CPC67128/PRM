<?php BeginForm('company_followup'); ?>

<div class="form-group">
	<label for="new_note_date">Date</label>
	<input type="text" class="form-control" id="new_note_date" name="new_note_date" value="<?php echo date("Y-m-d"); ?>" autocomplete="off" >
</div>

<div class="form-group">
	<label for="new_note">Note</label>
	<textarea class="form-control" id="new_note" name="new_note" rows="3"></textarea>
</div>

<?php EndForm('company_followup', '../prm_controllers/company_controller.php?type=add_note', 'LoadCompanyFollowUpDetail();'); ?>

<div id="divCompanyFollowUpDetail" />

<script type="text/javascript" charset="utf-8">
function LoadCompanyFollowUpDetail() {
	console.log("LoadCompanyFollowUpDetail() called");

	$.post("company_followup_detail.php",
			{
				id: <?= $row["company_id"] ?>
		    },
		    function(data, status){
		    	$("#divCompanyFollowUpDetail").html(data);
		    });
}

LoadCompanyFollowUpDetail();
</script>