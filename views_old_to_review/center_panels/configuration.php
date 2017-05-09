<?php
include 'form_management.php';
begin_form();
?>
<table>
<tbody>
<tr>
<td>Voir archivées</td>
<td><input type="checkbox" name="view_archived" <?php echo ($row["view_archived"] ? 'CHECKED' : ''); ?> /></td>
</tbody>
</table>
<?php end_form('Mettre à jour', '../prm_controllers/configuration_controller.php?type=update'); ?>