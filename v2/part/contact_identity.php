<?php BeginForm('contact_identity'); ?>

<input type="hidden" name="contact_id" value="<?= $row["contact_id"] ?>">

<div class="form-group">
	<label for="gender">Sexe</label>
    <select class="form-control" name="gender">
      <option <?php echo (strcasecmp($row["gender"], 'M') == 0 ? 'selected' : ''); ?>>M</option>
      <option <?php echo (strcasecmp($row["gender"], 'F') == 0 ? 'selected' : ''); ?>>F</option>
    </select>
</div>

<?php

AddTextBox($row, 'title', 'Titre', '');
AddTextBox($row, 'first_name', 'Prénom', '');
AddTextBox($row, 'last_name', 'Nom', '');

?>

<?php EndForm('contact_identity', '../prm_controllers/contact_controller.php?type=update'); ?>