<?php
BeginForm('contact_professional');

AddTextBox($row, 'company_name', 'Entreprise', '');
AddTextBox($row, 'professional_service', 'Service', '');
AddTextBox($row, 'professional_function', 'Fonction', '');
AddTextBox($row, 'professional_phone', 'Téléphone', '');
AddTextBox($row, 'professional_phone_extension', 'Extension', '');
AddTextBox($row, 'professional_mobile_phone', 'Mobile', '');
AddTextBox($row, 'professional_fax', 'Fax', '');
AddTextBox($row, 'professional_email', 'Email', '');
AddTextBox($row, 'professional_email_2', '', '');
AddTextBox($row, 'professional_website_1', 'Site Internet', '');
AddTextBox($row, 'professional_website_2', '', '');
AddTextBox($row, 'professional_viadeo', 'Viadeo', '');
AddTextBox($row, 'professional_linkedin', 'LinkedIn', '');
AddTextBox($row, 'professional_twitter', 'Twitter', '');
AddTextBox($row, 'professional_skype', 'Skype', '');
AddTextBox($row, 'professional_login', 'Login', '');

EndForm('contact_professional', '../controllers/contact_controller.php?type=update');
?>