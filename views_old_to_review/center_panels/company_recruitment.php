<?php
include 'form_management.php';
begin_form();
?>
<input type="hidden" name="company_id" value="<?php echo $row["company_id"]; ?>">
<table>
<tbody>
<?php
$detail = '';
add_new_row_to_detail('Recrutement', 'recruitment');
echo $detail;
?>
</tbody>
</table>
<?php end_form('Mettre à jour', '../prm_controllers/company_controller.php?type=update'); ?>