<?php
BeginForm('company_details');

AddTextBox($row, 'name', 'Nom', '');
AddTextBox($row, 'postal_name', 'Nom postal', '');
AddTextBox($row, 'address_1', 'Adresse', '');
AddTextBox($row, 'address_2', '', '');
AddTextBox($row, 'address_3', '', '');
AddTextBox($row, 'address_4', '', '');
AddTextBox($row, 'zip_country', 'Code pays', '');
AddTextBox($row, 'zip', 'Code postal', '');
AddTextBox($row, 'city', 'Ville', '');
AddTextBox($row, 'cedex', 'Cedex', '');
AddTextBox($row, 'country', 'Pays', '');
AddTextBox($row, 'phone', 'Téléphone', '');
AddTextBox($row, 'fax', 'Fax', '');
AddTextBox($row, 'email', 'Email', '');
AddTextBox($row, 'website', 'Site Internet', '');

EndForm('company_details', '../prm_controllers/company_controller.php?type=update');
?>