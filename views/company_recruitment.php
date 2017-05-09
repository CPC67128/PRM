<?php
BeginForm('company_recruitment');

AddTextBox($row, 'recruitment', 'Recrutement', '');

EndForm('company_recruitment', '../controllers/company_controller.php?type=update');
?>