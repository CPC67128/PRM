<span>
Dernier contact&nbsp;<input type="text" name="last_contact" value="<?php echo $row['last_contact']; ?>" readonly="readonly" size="10em" />
<button data-dojo-type="dijit.form.Button" onclick="SetLastContactDateToToday();">Aujourd'hui</button>
<span id="lastContactActionResult"></span>
Contact régulier&nbsp;<input type="checkbox" id="regular_contact" onclick="ClickOnRegularContact();" name="regular_contact" <?php echo ($row['regular_contact'] == 1 ? 'checked' : ''); ?> />
<span id="lastRegularContactActionResult"></span>
Dernière mise à jour&nbsp;<input type="text" name="last_update" value="<?php echo $row['last_update']; ?>" readonly="readonly" size="10em" />
</span>

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
}

function ClickOnRegularContact() {
	var value = 0;
	if (document.getElementById("regular_contact").checked)
		value = 1;

	$.post(
		'../prm_controllers/contact_controller.php?type=regular_contact&contact_id=<?php echo $row["contact_id"]; ?>&value=' + value,
		function(response, status) {
			if (status == 'success') {
				if (response.indexOf("<!-- ERROR -->") != 0) {
					RefreshBottomPanel();
				}
				else {
					$("#lastRegularContactActionResult").html(response);
				}
			}
			else {
				$("#lastRegularContactActionResult").html(status);
			}
		}
	);
}
</script>