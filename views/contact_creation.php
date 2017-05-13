<?php BeginForm('contact_creation'); ?>

<div class="form-group row">
	<div class="form-check form-check-inline">
	  <label class="form-check-label">
	    <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="M" checked>Homme
	  </label>
	</div>
	<div class="form-check form-check-inline">
	  <label class="form-check-label">
	    <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="F">Femme
	  </label>
	</div>
</div>

<?php
AddTextBox($row, 'first_name', 'Prénom', '');
AddTextBox($row, 'last_name', 'Nom', '');

EndForm('contact_creation', '../controllers/contact_controller.php?type=insert', 'DisplayRecord(TYPE_CONTACT, response);');
?>