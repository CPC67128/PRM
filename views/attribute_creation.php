<?php BeginForm('attribute_creation'); ?>

<div class="form-group">
	<label for="attribute">Attribut</label>
	<input type="text" class="form-control" id="attribute" name="attribute" value="<?php echo $row["attribute"]; ?>" autocomplete="off" >
</div>

<div class="form-check">
  <label class="form-check-label">
    <input class="form-check-input" type="checkbox" name="for_company">
    Attribut entreprise
  </label>
</div>

<div class="form-check">
  <label class="form-check-label">
    <input class="form-check-input" type="checkbox" name="for_contact">
    Attribut contact
  </label>
</div>

<?php
EndForm('attribute_creation', '../controllers/attribute_controller.php?type=insert', 'DisplayRecord(TYPE_ATTRIBUTE, response);');
?>