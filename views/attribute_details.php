<?php BeginForm('attribute_details'); ?>

<div class="form-group">
	<label for="attribute">Attribut</label>
	<input type="text" class="form-control" id="attribute" name="attribute" value="<?php echo $row["attribute"]; ?>" autocomplete="off" >
</div>

<div class="form-check">
  <label class="form-check-label">
    <input class="form-check-input" type="checkbox" value="" name="for_company" <?php echo (strcasecmp($row["for_company"], '1') == 0 ? 'checked' : ''); ?>>
    Attribut entreprise
  </label>
</div>

<div class="form-check">
  <label class="form-check-label">
    <input class="form-check-input" type="checkbox" value="" name="for_contact" <?php echo (strcasecmp($row["for_contact"], '1') == 0 ? 'checked' : ''); ?>>
    Attribut contact
  </label>
</div>

<?php EndForm('attribute_details', '../prm_controllers/attribute_controller.php?type=update'); ?>