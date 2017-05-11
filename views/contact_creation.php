<?php BeginForm('contact_creation'); ?>

Sexe
<select class="custom-select" name="gender">
  <option selected value="M">M</option>
  <option value="F">F</option>
</select>

<?php
AddTextBox($row, 'first_name', 'Prénom', '');
AddTextBox($row, 'last_name', 'Nom', '');

EndForm('contact_creation', '../controllers/contact_controller.php?type=insert', 'DisplayRecord(TYPE_CONTACT, response);');
?>