<?php BeginForm('contact_identity'); ?>

<div class="form-group row">
	<div class="form-check form-check-inline">
	  <label class="form-check-label">
	    <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="M" <?php echo (strcasecmp($row["gender"], 'M') == 0 ? 'checked' : ''); ?>>Homme
	  </label>
	</div>
	<div class="form-check form-check-inline">
	  <label class="form-check-label">
	    <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="F" <?php echo (strcasecmp($row["gender"], 'F') == 0 ? 'checked' : ''); ?>>Femme
	  </label>
	</div>
</div>

<?php
AddTextBox($row, 'title', 'Titre', '');
AddTextBox($row, 'first_name', 'Prénom', '');
AddTextBox($row, 'last_name', 'Nom', '');

EndForm('contact_identity', '../controllers/contact_controller.php?type=update');
?>