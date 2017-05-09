<?php
include 'form_management.php';
begin_form();
?>
<input type="hidden" name="company_id" value="<?php echo $row["company_id"]; ?>">
<table>
<tbody>
<?php
$detail = '';
add_new_row_to_detail('Nom', 'name');
add_new_row_to_detail('Nom postal', 'postal_name');
add_new_row_to_detail('Adresse', 'address_1');
add_new_row_to_detail('', 'address_2');
add_new_row_to_detail('', 'address_3');
add_new_row_to_detail('', 'address_4');
add_new_row_to_detail('Code pays', 'zip_country');
add_new_row_to_detail('Code postal', 'zip');
add_new_row_to_detail('Ville', 'city');
add_new_row_to_detail('Cedex', 'cedex');
add_new_row_to_detail('Pays', 'country');
add_new_row_to_detail('Téléphone', 'phone');
add_new_row_to_detail('Fax', 'fax');
add_new_row_to_detail('Email', 'email');
add_new_row_to_detail('Site Internet', 'website');
echo $detail;
?>
</tbody>
</table>
<?php end_form('Mettre à jour', '../prm_controllers/company_controller.php?type=update', false, true); ?>
<br />
<button data-dojo-type="dijit.form.Button" onclick="window.open('https://maps.google.fr/?q=<?php echo GetCompanyGoogleMapsItSearchString($id); ?>','Google Maps it!','toolbar=1,scrollbars=1');">Google Maps it!</button>