<?php BeginForm('tools_check_emails_in_database'); ?>
1 email per line<br />
<textarea name="emails" rows=10></textarea>
<?php EndForm('tools_invalidate_emails', '../controllers/tools_controller.php?type=check_emails_in_database'); ?>


