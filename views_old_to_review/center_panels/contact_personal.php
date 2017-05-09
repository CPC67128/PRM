<?php
include 'form_management.php';
begin_form();
?>
<input type="hidden" name="contact_id" value="<?php echo $row["contact_id"]; ?>">
<table>
<tbody>
<?php
$detail = '';
add_new_row_to_detail('Adresse', 'personal_address_1');
add_new_row_to_detail('', 'personal_address_2');
add_new_row_to_detail('', 'personal_address_3');
add_new_row_to_detail('Code postal', 'personal_zip');
add_new_row_to_detail('Ville', 'personal_city');
add_new_row_to_detail('Cedex', 'personal_cedex');
add_new_row_to_detail('Pays', 'personal_country');
add_new_row_to_detail('Téléphone', 'personal_phone');
add_new_row_to_detail('Mobile', 'personal_mobile_phone');
add_new_row_to_detail('Email', 'personal_email_1');
add_new_row_to_detail('', 'personal_email_2');
add_new_row_to_detail('MSN', 'personal_msn');
add_new_row_to_detail('ICQ', 'personal_icq');
add_new_row_to_detail('Skype', 'personal_skype');
add_new_row_to_detail('Site Internet', 'personal_website');
add_new_row_to_detail('', 'personal_website_2');
add_new_row_to_detail('Date de naissance', 'personal_birthday');
add_new_row_to_detail('Lieu de naissance', 'personal_birthplace');
add_new_row_to_detail('Modèle véhicule', 'vehicle_model');
add_new_row_to_detail('Plaque d\'immatriculation', 'vehicle_license_plate');
echo $detail;
?>
</tbody>
</table>
<?php end_form('Mettre à jour', '../prm_controllers/contact_controller.php?type=update'); ?>
<br />
<button data-dojo-type="dijit.form.Button" onclick="window.open('https://maps.google.fr/?q=<?php echo GetContactGoogleMapsItSearchString($id); ?>','Google Maps it!','toolbar=1,scrollbars=1');">Google Maps it!</button>
