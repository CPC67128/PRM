<?php
AddGroupLink('contact_followup', 'Suivi'); ?> &gt; <?php
AddGroupLink('contact_identity', 'Identité'); ?> &gt; <?php
AddGroupLink('contact_personal', 'Personnel'); ?> &gt; <?php
AddGroupLink('contact_professional', 'Professionnel'); ?> &gt; <?php
AddGroupLink('contact_comment', 'Commentaires'); ?> &gt; <?php
AddGroupLink('contact_attributes', 'Attributs'); ?> &gt; <?php
AddGroupLink('contact_files', 'Fichiers'); ?> &gt; <?php
AddGroupLink('contact_actions', 'Actions'); ?> &gt; <?php

$row = GetContactRow($id);

BeginRow();
AddGroup('contact_record', '');
EndRow();
AddGroup('contact_followup', 'Suivi');
AddGroup('contact_identity', 'Identité');
AddGroup('contact_personal', 'Personnel');
AddGroup('contact_professional', 'Professionnel');
AddGroup('contact_comment', 'Commentaires');
AddGroup('contact_attributes', 'Attributs');
AddGroup('contact_files', 'Fichiers');
AddGroup('contact_actions', 'Actions');
?>

<script>
$("a.groupLink").click(function(e){
	e.preventDefault();
	//alert($(this).attr("href"));
    $('html, body').animate({
        'scrollTop':   $($(this).attr("href")).offset().top-70
      }, 0);
	//return false;
});
</script>