<?php
include 'form_management.php';
begin_form();
?>
<input type="hidden" name="company_id" value="<?php echo $row["company_id"]; ?>">
<table>
<tbody>
<?php
$detail = '';
add_new_row_to_detail('Activités', 'activities');
add_new_row_to_detail('Heures d\'ouverture', 'opening_hours');
echo $detail;
?>
</tbody>
</table>
<?php end_form('Mettre à jour', '../prm_controllers/company_controller.php?type=update'); ?>