<?php
BeginForm('company_comment');

AddTextBox($row, 'comment', 'Commentaire', '');
AddTextBox($row, 'next_action', 'Action à faire', '');

EndForm('company_comment', '../controllers/company_controller.php?type=update');
?>