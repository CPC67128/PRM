<?php
include 'form_management.php';
begin_form();
?>
<input type="hidden" name="contact_id" value="<?php echo $row["contact_id"]; ?>">
<table>
<tbody>
<?php
$detail = '';
add_new_row_to_detail('Commentaire', 'comment');
add_new_row_to_detail('Actions à faire', 'next_action');
echo $detail;
?>
</tbody>
</table>
<?php end_form('Mettre à jour', '../prm_controllers/contact_controller.php?type=update'); ?>