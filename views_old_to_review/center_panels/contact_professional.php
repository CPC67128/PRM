<?php
include 'form_management.php';
begin_form();
?>
<input type="hidden" name="contact_id" value="<?php echo $row["contact_id"]; ?>">
<table>
<tbody>
<?php
$detail = '';
add_new_row_to_detail('Entreprise', 'company_name');
add_new_row_to_detail('Service', 'professional_service');
add_new_row_to_detail('Fonction', 'professional_function');
add_new_row_to_detail('Téléphone', 'professional_phone');
add_new_row_to_detail('Extension', 'professional_phone_extension');
add_new_row_to_detail('Mobile', 'professional_mobile_phone');
add_new_row_to_detail('Fax', 'professional_fax');
add_new_row_to_detail('Email', 'professional_email');
add_new_row_to_detail('', 'professional_email_2');
add_new_row_to_detail('Site Internet', 'professional_website_1');
add_new_row_to_detail('', 'professional_website_2');
add_new_row_to_detail('Viadeo', 'professional_viadeo');
add_new_row_to_detail('LinkedIn', 'professional_linkedin');
add_new_row_to_detail('Twitter', 'professional_twitter');
add_new_row_to_detail('Skype', 'professional_skype');
add_new_row_to_detail('Login', 'professional_login');
echo $detail;
?>
</tbody>
</table>
<?php end_form('Mettre à jour', '../prm_controllers/contact_controller.php?type=update'); ?>

<script type="text/javascript" charset="utf-8">
$(function() {
	$("#company_name").autocomplete({
		source: function( request, response ) {
			$.ajax({
				url: "pc_search_company.php",
				dataType: "json",
				data: {
					search_string: request.term
				},
				success: function( data ) {
					response( $.map( data.items, function( item ) {
						return {
							label: item.fullName,
							id: item.id
						}
					}));
				}
			});
		},
		minLength: 2
	});

	$("#company_name").focus(function () {
		$("#company_name").select();
	});
});
</script>