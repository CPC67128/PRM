<?php

include_once 'dal_common.php';

function FormatStringForSqlQuery($string)
{
	include 'database_use_start.php';
	$result = (get_magic_quotes_gpc() ? $string: $mysqli->real_escape_string($string));
	include 'database_use_stop.php';
	return $result;
}

function ForceFormatStringForSqlQuery($string)
{
	include 'database_use_start.php';
	$result = $mysqli->real_escape_string($string);
	include 'database_use_stop.php';
	return $result;
}

function IsFileAPicture($fileName)
{
    if (endsWith(strtolower($fileName), '.jpg'))
        return true;
    if (endsWith(strtolower($fileName), '.jpeg'))
        return true;
	if (endsWith(strtolower($fileName), '.png'))
		return true;
	if (endsWith(strtolower($fileName), '.gif'))
		return true;
	return false;
}

function startsWith($haystack, $needle)
{
	$length = strlen($needle);
	return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle)
{
	$length = strlen($needle);
	if ($length == 0) {
		return true;
	}

	return (substr($haystack, -$length) === $needle);
}

$contact_fields = array(
	"contact_id" => "Identifiant du contact",
	"gender" => "Sexe",
	"title" => "Titre",
	"first_name" => "Prénom",
	"last_name" => "Nom",
	"personal_address_1" => "Addresse",
	"personal_address_2" => "",
	"personal_address_3" => "",
	"personal_zip" => "Code postal",
	"personal_city" => "Ville",
	"personal_cedex" => "Cedex",
	"personal_country" => "Pays",
	"personal_phone" => "Téléphone",
	"personal_mobile_phone" => "Mobile",
	"personal_email_1" => "Email",
	"personal_email_2" => "",
	"personal_msn" => "MSN",
	"personal_icq" => "ICQ",
	"personal_skype" => "Skype",
	"personal_website" => "Site Internet",
	"personal_website_2" => "",
	"personal_birthday" => "Date de naissance",
	"personal_birthplace" => "Lieu de naissance",
	"company_id" => "Entreprise",
	"professional_company" => "Entreprise",
	"professional_service" => "Service",
	"professional_function" => "Fonction",
	"professional_phone" => "Téléphone",
	"professional_phone_extension" => "Extension",
	"professional_mobile_phone" => "Mobile",
	"professional_fax" => "Fax",
	"professional_email" => "Email",
	"professional_email_2" => "",
	"professional_website_1" => "Site Internet",
	"professional_website_2" => "",
	"professional_skype" => "Skype pro.",
	"professional_linkedin" => "LinkedIn",
	"professional_twitter" => "Twitter",
	"professional_viadeo" => "Viadeo",
	"professional_login" => "Login",
	"vehicle_license_plate" => "Plaque d'immatriculation",
	"vehicle_model" => "Modèle de véhicule",
	"comment" => "Commentaire",
	"last_contact" => "Dernier contact",
	"last_update" => "Dernière mise à jour",
	"next_action" => "Action à faire",
	"archived" => "Archivé",
	"picture_file_name" => "Portait",
	"regular_contact" => "Contact régulier",
	"last_view" => "Dernièer accès"
);

$company_fields = array(
	"company_id" => "Identifiant de l'entreprise",
	"name" => "Nom",
	"postal_name" => "Nom postal",
	"address_1" => "Adresse",
	"address_2" => "",
	"address_3" => "",
	"address_4" => "",
	"zip_country" => "Code pays",
	"zip" => "Code postal",
	"city" => "Ville",
	"cedex" => "Cedex",
	"country" => "Pays",
	"phone" => "Téléphone",
	"fax" => "Fax",
	"email" => "Email",
	"website" => "Site Internet",
	"activities" => "Activités",
	"recruitment" => "Recrutement",
	"opening_hours" => "Horaires d'ouverture",
	"comment" => "Commentaire",
	"next_action" => "Action à faire",
	"last_update" => "Dernière mise à jour",
	"archived" => "Archivé"
);

$attribute_fields = array(
	"attribute_id" => "Identifiant de l'attribut",
	"attribute" => "Attribut",
	"for_company" => "Attribut d'entreprise",
	"for_contact" => "Attribut de contact"
);

$pages = array(
	"contact/identity" => "Identité",
	"contact/personal" => "Personnel",
	"contact/professional" => "Professionnel",
	"contact/followup" => "Suivi",
	"contact/comment" => "Commentaires",
	"contact/attributes" => "Attributs",
	"contact/picture" => "Image",
	"contact/files" => "Fichiers",
	"contact/relations" => "Relations",
	"contact/actions" => "Actions",
	"company/details" => "Coordonées",
	"company/activities" => "Activités",
	"company/recruitment" => "Recrutement",
	"company/comment" => "Commentaires",
	"company/followup" => "Suivi",
	"company/attributes" => "Attributs",
	"company/files" => "Fichiers",
	"company/actions" => "Actions",
	"attribute/details" => "Details",
	"attribute/contacts" => "Contacts",
	"attribute/companies" => "Entreprises",
	"attribute/actions" => "Actions",
	"tools/invalidate_emails" => "Invalider des emails",
	"tools/check_emails_in_database" => "Vérifier des emails en BDD",
	"tools/set_attribute_to_emails" => "Affecter un attribut selon les emails",
	"tools/set_last_contact_date_to_emails" => "Mise à jour de la date de dernier contact selon les emails",
	"tools/remove_attribute_to_emails" => "Enlever un attribut selon les emails",
	"tools/export_emails" => "Exporter des emails"
);

include 'dal_prm_configuration.php';
include 'dal_prm_contact.php';
include 'dal_prm_company.php';
include 'dal_prm_attribute.php';
include 'dal_prm_file.php';
include 'dal_prm_data_management_tools.php';

function ExecuteQuery_toremove($query)
{
	include 'database_use_start.php';

	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return $result;
}