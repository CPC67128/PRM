<?php BeginForm('contact_followup'); ?>

<div class="form-group">
	<label for="new_note_date">Date</label>
	<input type="text" class="form-control" id="new_note_date" name="new_note_date" value="<?php echo date("Y-m-d"); ?>" autocomplete="off" >
</div>

<div class="form-group">
	<label for="new_note">Note</label>
	<textarea class="form-control" id="new_note" name="new_note" rows="3"></textarea>
</div>

<?php EndForm('contact_followup', '../prm_controllers/contact_controller.php?type=add_note', 'LoadContactFollowUpDetail();'); ?>

<div id="divContactFollowUpDetail" />

<script type="text/javascript" charset="utf-8">
function LoadContactFollowUpDetail() {
	console.log("ContactFollowUpDetail() called");

	$.post("contact_followup_detail.php",
			{
				id: <?= $row["contact_id"] ?>
		    },
		    function(data, status){
		    	$("#divContactFollowUpDetail").html(data);
		    });
}

LoadContactFollowUpDetail();
</script>
