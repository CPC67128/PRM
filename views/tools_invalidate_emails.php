<?php BeginForm('tools_invalidate_emails'); ?>
1 email per line<br />
<textarea name="emails" rows=10></textarea>
<?php EndForm('tools_invalidate_emails', '../controllers/tools_controller.php?type=invalidate_emails'); ?>