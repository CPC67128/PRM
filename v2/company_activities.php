<?php
BeginForm('company_activities');

AddTextBox($row, 'activities', 'Activités', '');
AddTextBox($row, 'opening_hours', 'Heures d\'ouverture', '');

EndForm('company_activities', '../prm_controllers/company_controller.php?type=update');
?>