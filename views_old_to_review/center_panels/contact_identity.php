<?php
include 'form_management.php';
begin_form();
?>
<input type="hidden" name="contact_id" value="<?php echo $row["contact_id"]; ?>">
<table>
<tbody>
<tr>
<td>
Sexe
</td>
<td>
<select name="gender">
<option value="M" <?php echo (strcasecmp($row["gender"], 'M') == 0 ? 'selected = "true"' : ''); ?>>M</option>
<option value="F" <?php echo (strcasecmp($row["gender"], 'F') == 0 ? 'selected = "true"' : ''); ?>>F</option>
</select>
</td>
</tr>
<?php
$detail = '';
add_new_row_to_detail('Titre', 'title', 5);
add_new_row_to_detail('Prénom', 'first_name', 30);
add_new_row_to_detail('Nom', 'last_name', 30);
echo $detail;
?>
</tbody>
</table>
<?php end_form('Mettre à jour', '../prm_controllers/contact_controller.php?type=update', false, true); ?>