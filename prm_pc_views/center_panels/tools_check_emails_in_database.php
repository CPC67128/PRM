<?php
include 'form_management.php';
begin_form();
?>
1 email per line<br />
<textarea name="emails" rows=20 cols=100><?php if (isset($_POST["emails"])) echo $_POST["emails"]; ?></textarea>
<br />
<?php end_form('Envoyer', '../prm_controllers/tools_controller.php?type=check_emails_in_database'); ?>