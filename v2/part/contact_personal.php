<?php
BeginForm('contact_personal');

AddTextBox($row, 'personal_address_1', 'Adresse', '');
AddTextBox($row, 'personal_address_2', '', '');
AddTextBox($row, 'personal_address_3', '', '');
AddTextBox($row, 'personal_zip', 'Code postal', '');
AddTextBox($row, 'personal_city', 'Ville', '');
AddTextBox($row, 'personal_cedex', 'Cedex', '');
AddTextBox($row, 'personal_country', 'Pays', '');
AddTextBox($row, 'personal_phone', 'Téléphone', '');
AddTextBox($row, 'personal_mobile_phone', 'Mobile', '');
AddTextBox($row, 'personal_email_1', 'Email', '');
AddTextBox($row, 'personal_email_2', '', '');
AddTextBox($row, 'personal_msn', 'MSN', '');
AddTextBox($row, 'personal_icq', 'ICQ', '');
AddTextBox($row, 'personal_skype', 'Skype', '');
AddTextBox($row, 'personal_website', 'Site Internet', '');
AddTextBox($row, 'personal_website_2', '', '');
AddTextBox($row, 'personal_birthday', 'Naissance', 'Date de naissance');
AddTextBox($row, 'personal_birthplace', '', 'Lieu de naissance');
AddTextBox($row, 'vehicle_model', 'Véhicule', 'Modèle véhicule');
AddTextBox($row, 'vehicle_license_plate', '', 'Plaque d\'immatriculation');

EndForm('contact_personal', '../prm_controllers/contact_controller.php?type=update');
?>