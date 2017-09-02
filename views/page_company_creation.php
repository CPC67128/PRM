<?php
BeginForm('company_creation');

AddTextBox($row, 'name', 'Nom', '');

EndForm('company_creation', '../controllers/company_controller.php?type=insert', 'DisplayRecord(TYPE_COMPANY, response);');
?>