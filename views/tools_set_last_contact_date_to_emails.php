<?php
include '../views_old_to_review/center_panels/form_management.php';
begin_form();
?>
<b>Mise à jour de la date de dernier contact</b>
<br />
1 email par ligne<br />
<textarea name="emails" rows=20 cols=100><?php if (isset($_POST["emails"])) echo $_POST["emails"]; ?></textarea>
<br />
<?php end_form('Envoyer', '../prm_controllers/tools_controller.php?type=set_last_contact_date_to_emails'); ?>
