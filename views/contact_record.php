<form class="form-inline">
	<label for="last_contact" class="col-form-label">Dernier contact</label>
	<input type="date" class="form-control" name="last_contact" id="last_contact" value="<?= $row['last_contact'] ?>" autocomplete="off" readonly="readonly">
	<button type="submit" class="btn btn-primary" onclick="SetLastContactDateToToday();">Aujourd'hui</button>
</form>
<form class="form-inline">
	<label for="last_update" class="col-form-label">Dernière mise à jour</label>
	<input type="date" class="form-control" name="last_update" id="last_update" value="<?= $row['last_update'] ?>" autocomplete="off" readonly="readonly">
</form>

<script type="text/javascript">
function SetLastContactDateToToday() {
	$.post(
		'../prm_controllers/contact_controller.php?type=last_contact&contact_id=<?php echo $row["contact_id"]; ?>',
		function(response, status) {
			if (status == 'success') {
				if (response.indexOf("<!-- ERROR -->") != 0) {
					RefreshBottomPanel();
				}
				else {
					$("#lastContactActionResult").html(response);
				}
			}
			else {
				$("#lastContactActionResult").html(status);
			}
		}
	);

	return false;
}
</script>