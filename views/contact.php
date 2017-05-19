<?php
$row = GetContactRow($id);

BeginRow();
AddGroup('contact_record', '', 'col-12');
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