<?php

// Contact attributes
function GetContactAttributes($ContactId)
{
	include 'database_use_start.php';

	$query = 'select
		CA.contact_attribute_id,
		A.attribute,
		CA.creation_date,
		CA.contact_id
		from '.$DB_TABLE_PREFIX.'prm_contact_attribute CA
		inner join '.$DB_TABLE_PREFIX.'prm_attribute A on A.attribute_id = CA.attribute_id
		where CA.contact_id = '.$ContactId.'
		order by attribute';
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return $result;
}

function GetBirthdaysHighlight()
{
	include 'database_use_start.php';

	$query = "select *
		from
		(
		SELECT STR_TO_DATE(CONCAT(DATE_FORMAT(date_add(now(), interval -1 year),'%Y'), '-', DATE_FORMAT(personal_birthday, '%m-%d')), '%Y-%m-%d') as birthday, contact_id, first_name, last_name, archived FROM ".$DB_TABLE_PREFIX."prm_contact WHERE personal_birthday is not null
		union
		SELECT STR_TO_DATE(CONCAT(DATE_FORMAT(now(),'%Y'), '-', DATE_FORMAT(personal_birthday, '%m-%d')), '%Y-%m-%d') as birthday, contact_id, first_name, last_name, archived FROM ".$DB_TABLE_PREFIX."prm_contact WHERE personal_birthday is not null
		union
		SELECT STR_TO_DATE(CONCAT(DATE_FORMAT(date_add(now(), interval +1 year),'%Y'), '-', DATE_FORMAT(personal_birthday, '%m-%d')), '%Y-%m-%d') as birthday, contact_id, first_name, last_name, archived FROM ".$DB_TABLE_PREFIX."prm_contact WHERE personal_birthday is not null
		) as birthday_table
		where birthday between date_add(now(), INTERVAL -2 WEEK) and date_add(now(), INTERVAL +2 MONTH)
		and ifnull(archived, 0) != 1
		order by birthday";
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return $result;
}

function GetContactsToUpdateHighlight()
{
	include 'database_use_start.php';

	$query = "select contact_id, first_name, last_name FROM ".$DB_TABLE_PREFIX."prm_contact 
		where ifnull(archived, 0) != 1
		order by ifnull(last_view, '1900-01-01') asc limit 3";
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return $result;
}

function GetContactsNextActionsHighlight()
{
	include 'database_use_start.php';

	$query = "select contact_id, next_action, first_name, last_name
		from ".$DB_TABLE_PREFIX."prm_contact
		where ifnull(next_action, '') != ''
		order by ifnull(last_update, '1900-01-01') asc";
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return $result;
}

// OK
function GetContactRow($ContactId)
{
	$result = GetContactResource($ContactId);
	

	return $result;
}

// OK
function GetContactResource($ContactId)
{
	include 'database_use_start.php';

	$query = 'select cn.*, cm.name as company_name from '.$DB_TABLE_PREFIX.'prm_contact cn left join '.$DB_TABLE_PREFIX.'prm_company cm on cn.company_id = cm.company_id where cn.contact_id = '.$ContactId;
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	$row = $result->fetch_assoc();

	include 'database_use_stop.php';

	return $row;
}

// Set attribute
function SetAttributeToContact($ContactId, $Attribute, $CreationDate)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = sprintf("select attribute_id from ".$DB_TABLE_PREFIX."prm_attribute where attribute='%s'",
		(get_magic_quotes_gpc() ? $Attribute : $mysqli->real_escape_string($Attribute)));
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	$row = $result->fetch_assoc();

	if (!isset($row["attribute_id"]))
		return;

	$query = sprintf("delete from ".$DB_TABLE_PREFIX."prm_contact_attribute where contact_id = %s and attribute_id = %s",
		$ContactId,
		$row["attribute_id"]);
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	$query = sprintf("insert into ".$DB_TABLE_PREFIX."prm_contact_attribute (contact_id, attribute_id, creation_date) values (%s, %s, '%s')",
		$ContactId,
		$row["attribute_id"],
		$mysqli->real_escape_string($CreationDate));
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	_UpdateContactLastUpdateDate($ContactId);

	include 'database_use_stop.php';
}

function UpdateLastContactDate($ContactId)
{
	if (IsReadOnly())
		return;
	
	include 'database_use_start.php';

	$query = sprintf("update ".$DB_TABLE_PREFIX."prm_contact set last_contact = curdate() where contact_id = %s",
		$ContactId);
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	
	_UpdateContactLastUpdateDate($ContactId);
	
	include 'database_use_stop.php';
}

function UpdateLastUpdateDate($ContactId)
{
	if (IsReadOnly())
		return;
	
	include 'database_use_start.php';

	_UpdateContactLastUpdateDate($ContactId);
	
	include 'database_use_stop.php';
}

function UpdateLastViewDate($ContactId)
{
	if (IsReadOnly())
		return;
	
	include 'database_use_start.php';

	$query = sprintf("update ".$DB_TABLE_PREFIX."prm_contact set last_view = curdate() where contact_id = %s",
	$ContactId);
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';
}

function _UpdateContactLastUpdateDate($ContactId)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = sprintf("update ".$DB_TABLE_PREFIX."prm_contact set last_update = curdate() where contact_id = %s",
		$ContactId);
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';
}

function UpdateRegularContact($ContactId, $Value)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = sprintf("update ".$DB_TABLE_PREFIX."prm_contact set regular_contact = %s where contact_id = %s",
		$Value,
		$ContactId);
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';
}

// Contact archive
function ArchiveContact($ContactId)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = sprintf("update ".$DB_TABLE_PREFIX."prm_contact set archived = 1 where contact_id = %s",
		$_POST["contact_id"]);
	$mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	$query = sprintf("insert into ".$DB_TABLE_PREFIX."prm_note (contact_id, comment, creation_date) values (%s, '%s', now())",
		$_POST["contact_id"],
		'Archivage',
		USER_ID);
	$mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	_UpdateContactLastUpdateDate($ContactId);

	include 'database_use_stop.php';
}

// Contact deletion
function DeleteContact($ContactId)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = 'delete from '.$DB_TABLE_PREFIX.'prm_contact_attribute where contact_id = '.$ContactId;
	$mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	$query = 'delete from '.$DB_TABLE_PREFIX.'prm_contact where contact_id = '.$ContactId;
	$mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';
}


// OK
function GetNotesFromContact($ContactId)
{
	include 'database_use_start.php';

	$query = 'select * from '.$DB_TABLE_PREFIX.'prm_note where contact_id = '.$ContactId.' order by creation_date desc, note_id desc';
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return $result;
}

function AddNoteToContact($ContactId, $Note, $CreationDate)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = sprintf("insert into ".$DB_TABLE_PREFIX."prm_note (contact_id, comment, creation_date) values (%s, '%s', '%s')",
		$ContactId,
		FormatStringForSqlQuery($Note),
		$CreationDate);
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	_UpdateContactLastUpdateDate($ContactId);

	include 'database_use_stop.php';
}

function RemoveNoteFromContact($ContactId, $NoteId)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = sprintf("delete from ".$DB_TABLE_PREFIX."prm_note where note_id = %s",
		$NoteId);
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	_UpdateContactLastUpdateDate($ContactId);

	include 'database_use_stop.php';
}

function RemoveAttributeFromContact($ContactId, $ContactAttributeId)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = sprintf("delete from ".$DB_TABLE_PREFIX."prm_contact_attribute where contact_attribute_id = %s",
		$ContactAttributeId);
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	_UpdateContactLastUpdateDate($ContactId);

	include 'database_use_stop.php';
}

function UpdatePictureFileName($ContactId, $PictureFileName)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = sprintf("update ".$DB_TABLE_PREFIX."prm_contact set picture_file_name = '%s' where contact_id = %s",
		(get_magic_quotes_gpc() ? $PictureFileName: $mysqli->real_escape_string($PictureFileName)),
		$ContactId);
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	_UpdateContactLastUpdateDate($ContactId);

	include 'database_use_stop.php';
}

function SetPictureFileToContact($ContactId, $FileId)
{
	if (IsReadOnly())
		return;
	
	include 'database_use_start.php';
	
	$query = sprintf("update ".$DB_TABLE_PREFIX."prm_contact set picture_file_id = %s where contact_id = %s",
		$FileId,
		$ContactId);
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	
	_UpdateContactLastUpdateDate($ContactId);
	
	include 'database_use_stop.php';
}

function UpdateContact($ContactId, $post)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = "select * from ".$DB_TABLE_PREFIX."prm_contact where contact_id = ".$ContactId;
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	$row = $result->fetch_assoc();

	$fields_checkbox = array("regular_contact");
	$fields_to_ignore = array("notes_length", "attributes_length", "new_attribute", "new_note", "new_attribute_date", "new_note_date", "relations_contact_to_contact_length");

	$update_query = '';
	$note_comment = '';

	$something_has_changed = false;

	foreach($post as $field_name=>$field_value)
	{
		if (in_array($field_name, $fields_to_ignore))
		{
		}
		elseif (in_array($field_name, $fields_checkbox))
		{
			// Checkboxes will be managed a little bit later
		}
		elseif ($field_name == "company_name")
		{
			// We look for the new company
			$requete = "select * from ".$DB_TABLE_PREFIX."prm_company where name = '".FormatStringForSqlQuery($field_value)."'";
			$resultat = $mysqli->query($requete) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
			$ligne_company = $resultat->fetch_assoc();

			// We look for the current company name
			$requete = 'select company_id, name from '.$DB_TABLE_PREFIX.'prm_company where company_id in (select company_id from '.$DB_TABLE_PREFIX.'prm_contact where contact_id = '.$ContactId.')';
			$resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.mysql_error());
			$ligne_contact = $resultat->fetch_assoc();

			$field_name = 'company_id';
			if (isset($ligne_company["company_id"]) && $ligne_company["company_id"] != '')
			{
				if ($ligne_company["company_id"] != $ligne_contact[$field_name])
				{
					// update of a field
					if (strlen($update_query) > 0)
					$update_query .= ',';
					$update_query .= $field_name.'='.$ligne_company["company_id"].'';

					if (isset($ligne_contact["name"]))
					{
						if (strlen($note_comment) > 0)
						$note_comment .= chr(10);
						$note_comment .= 'L\'entreprise est modifiée de "'.(isset($ligne_contact["name"]) ? $ligne_contact["name"] : '').'" vers "'.$ligne_company["name"].'"';
					}

					$something_has_changed = true;
				}
			}
			else
			{
				if (isset($ligne_contact[$field_name]))
				{
					if (strlen($update_query) > 0)
					$update_query .= ',';
					$update_query .= $field_name.'=null';

					if (strlen($note_comment) > 0)
					$note_comment .= chr(10);
					$note_comment .= 'L\'entreprise est supprimée, elle était "'.$ligne_contact["name"].'"';

					$something_has_changed = true;
				}
			}
		}
		else
		{
			// Fields names that match with prm_attribute table field names (type VARCHAR)
			if ($field_value != $row[$field_name])
			{
				if (strlen($row[$field_name]) > 0)
				{
					if (strlen($note_comment) > 0)
					$note_comment .= chr(10);
					$note_comment .= $field_name.' est modifié de "'.$row[$field_name].'" vers "'.$field_value.'"';
				}

				// update of the field
				if (strlen($update_query) > 0)
				$update_query .= ',';

				$update_query .= $field_name.'=\''.FormatStringForSqlQuery($field_value).'\'';
				$something_has_changed = true;
			}
		}
	}

	if ($something_has_changed)
	{
		//die($update_query);
		$query = 'update '.$DB_TABLE_PREFIX.'prm_contact set '.$update_query.' where contact_id = '.$ContactId;
		$mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

		if (strlen($note_comment) > 0)
		{
			$query = sprintf("insert into ".$DB_TABLE_PREFIX."prm_note (contact_id, comment, creation_date) values (%s, '%s', now())",
					$ContactId,
					ForceFormatStringForSqlQuery($note_comment));
			$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
		}

		_UpdateContactLastUpdateDate($ContactId);
	}

	include 'database_use_stop.php';

	if ($something_has_changed)
		return 'MODIFIED';
	else
		return 'UNMODIFIED';
}

function OBSOLETEUpdateContact($ContactId, $post)
{
	if (IsReadOnly())
	return;

	include 'database_use_start.php';

	$query = "select * from ".$DB_TABLE_PREFIX."prm_contact where contact_id = ".$ContactId;
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	$row = $result->fetch_assoc();

	$fields_checkbox = array("regular_contact");
	$fields_to_ignore = array("notes_length", "attributes_length", "new_attribute", "new_note", "new_attribute_date", "new_note_date", "relations_contact_to_contact_length");

	$update_query = '';
	$note_comment = '';

	$something_has_changed = false;

	foreach($post as $field_name=>$field_value)
	{
		if (in_array($field_name, $fields_to_ignore))
		{
		}
		elseif (in_array($field_name, $fields_checkbox))
		{
			// Checkboxes will be managed a little bit later
		}
		elseif ($field_name == "company_name")
		{
			// We look for the new company
			$requete = "select * from ".$DB_TABLE_PREFIX."prm_company where name = '".FormatStringForSqlQuery($field_value)."'";
			$resultat = $mysqli->query($requete) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
			$ligne_company = $resultat->fetch_assoc();

			// We look for the current company name
			$requete = 'select company_id, name from '.$DB_TABLE_PREFIX.'prm_company where company_id in (select company_id from '.$DB_TABLE_PREFIX.'prm_contact where contact_id = '.$ContactId.')';
			$resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.mysql_error());
			$ligne_contact = $resultat->fetch_assoc();

			$field_name = 'company_id';
			if (isset($ligne_company["company_id"]) && $ligne_company["company_id"] != '')
			{
				if ($ligne_company["company_id"] != $ligne_contact[$field_name])
				{
					// update of a field
					if (strlen($update_query) > 0)
					$update_query .= ',';
					$update_query .= $field_name.'='.$ligne_company["company_id"].'';

					if (isset($ligne_contact["name"]))
					{
						if (strlen($note_comment) > 0)
						$note_comment .= chr(10);
						$note_comment .= 'L\'entreprise est modifiée de "'.(isset($ligne_contact["name"]) ? $ligne_contact["name"] : '').'" vers "'.$ligne_company["name"].'"';
					}

					$something_has_changed = true;
				}
			}
			else
			{
				if (isset($ligne_contact[$field_name]))
				{
					if (strlen($update_query) > 0)
					$update_query .= ',';
					$update_query .= $field_name.'=null';

					if (strlen($note_comment) > 0)
					$note_comment .= chr(10);
					$note_comment .= 'L\'entreprise est supprimée, elle était "'.$ligne_contact["name"].'"';

					$something_has_changed = true;
				}
			}
		}
		else
		{
			// Fields names that match with prm_attribute table field names (type VARCHAR)
			if ($field_value != $row[$field_name])
			{
				if (strlen($row[$field_name]) > 0)
				{
					if (strlen($note_comment) > 0)
					$note_comment .= chr(10);
					$note_comment .= $field_name.' est modifié de "'.$row[$field_name].'" vers "'.$field_value.'"';
				}

				// update of the field
				if (strlen($update_query) > 0)
				$update_query .= ',';

				$update_query .= $field_name.'=\''.FormatStringForSqlQuery($field_value).'\'';
				$something_has_changed = true;
			}
		}
	}


	// Checkbox management
	foreach($fields_checkbox as $field_name)
	{
		$newFieldValue = 0;
		if (isset($_POST[$field_name]))
		{
			if ($_POST[$field_name] == 'on')
			$newFieldValue = 1;
		}

		if ($newFieldValue != $row[$field_name])
		{
			// update of the field
			if (strlen($update_query) > 0)
			$update_query .= ',';
			$update_query .= $field_name.'='.$newFieldValue;

			$something_has_changed = true;
		}
	}

	if ($something_has_changed)
	{
		$query = 'update '.$DB_TABLE_PREFIX.'prm_contact set '.$update_query.' where contact_id = '.$ContactId;
		$mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

		if (strlen($note_comment) > 0)
		{
			$query = sprintf("insert into ".$DB_TABLE_PREFIX."prm_note (contact_id, comment, creation_date) values (%s, '%s', now())",
			$ContactId,
			ForceFormatStringForSqlQuery($note_comment));
			$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
		}

		_UpdateContactLastUpdateDate($ContactId);
	}

	include 'database_use_stop.php';
}

function CreateContact($post)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = sprintf("insert into ".$DB_TABLE_PREFIX."prm_contact (gender, first_name, last_name, last_update) values ('%s', '%s', '%s', now())",
		FormatStringForSqlQuery($post["gender"]),
		FormatStringForSqlQuery($post["first_name"]),
		FormatStringForSqlQuery($post["last_name"]));
	$mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	$newId = mysql_insert_id();

	$query = sprintf("insert into ".$DB_TABLE_PREFIX."prm_note (contact_id, comment, creation_date) values (%s, '%s', now())",
		$newId,
		'Création');
	$mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';
	
	return $newId;
}

function GetRelationsFromContactToContact($ContactId)
{
	include 'database_use_start.php';

	$query = 'select * from '.$DB_TABLE_PREFIX.'prm_relation_contact_to_contact where (left_contact_id = '.$ContactId.' or right_contact_id = '.$ContactId.') order by creation_date desc';
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return $result;
}

function AddRelationFromContactToContact($LeftContactId, $RelationTypeId, $RightContactId)
{
	if (IsReadOnly())
		return;

	if ($LeftContactId < 0 || $RightContactId < 0 || $RelationTypeId < 0)
		return;

	include 'database_use_start.php';

	$query = sprintf("insert into ".$DB_TABLE_PREFIX."prm_relation_contact_to_contact (left_contact_id, relation_type_id, right_contact_id, creation_date) values (%s, '%s', %s, now())",
		$LeftContactId,
		$RelationTypeId,
		$RightContactId);
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return $result;
}

function RemoveRelationFromContactToContact($RelationId)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = sprintf("delete from ".$DB_TABLE_PREFIX."prm_relation_contact_to_contact where relation_contact_to_contact_id = %s",
		$RelationId);
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return $result;
}

function GetContactShortDescription($ContactId)
{
	include 'database_use_start.php';
	
	$query = 'select first_name, last_name
			from '.$DB_TABLE_PREFIX.'prm_contact
			where contact_id = '.$ContactId;
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	$row = $result->fetch_assoc();
	
	include 'database_use_stop.php';
	
	$shortDescriptionString = "";
	
	if (isset($row["first_name"]))
		$shortDescriptionString = $row["first_name"];
	
	if (isset($row["last_name"]))
	{
		if (strlen($shortDescriptionString) > 0)
			$shortDescriptionString .= ' ';
		$shortDescriptionString .= $row["last_name"];
	}

	return $shortDescriptionString;
}

function contact_GetContactPictureFileId($Contact_id)
{
	include 'database_use_start.php';

	$query = 'select FIL.file_id
			from '.$DB_TABLE_PREFIX.'prm_contact CNT
			inner join '.$DB_TABLE_PREFIX.'prm_file FIL on CNT.picture_file_id = FIL.file_id
			where CNT.contact_id = '.$Contact_id;
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	$row = mysqli_fetch_assoc($result);

	include 'database_use_stop.php';

	if (isset($row["file_id"]))
		return $row["file_id"];

	return -1;
}

function GetContactGoogleItSearchString($ContactId)
{
	include 'database_use_start.php';

	$query = 'select first_name, last_name
		from '.$DB_TABLE_PREFIX.'prm_contact
		where contact_id = '.$ContactId;
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	$row = $result->fetch_assoc();

	include 'database_use_stop.php';

	$searchString = "";

	if (isset($row["first_name"]))
		$searchString = $row["first_name"];

	if (isset($row["last_name"]))
	{
		if (strlen($searchString) > 0)
			$searchString .= '+';
		$searchString .= $row["last_name"]; 
	}

	$searchString = str_replace(' ', '+', $searchString);
	$searchString = str_replace('-', '+', $searchString);
	$searchString = str_replace('++', '+', $searchString);
	$searchString = str_replace('++', '+', $searchString);
	$searchString = str_replace('++', '+', $searchString);
	return $searchString;
}

function GetContactGoogleMapsItSearchString($ContactId)
{
	include 'database_use_start.php';

	$query = 'select personal_address_1, personal_address_2, personal_address_3, personal_zip, personal_city, personal_country
		from '.$DB_TABLE_PREFIX.'prm_contact
		where contact_id = '.$ContactId;
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	$row = $result->fetch_assoc();

	include 'database_use_stop.php';

	$searchString = "";

	if (isset($row["personal_address_1"]))
		$searchString = $row["personal_address_1"];
	if (isset($row["personal_address_2"]))
		$searchString .= '+'.$row["personal_address_2"];
	if (isset($row["personal_address_3"]))
		$searchString .= '+'.$row["personal_address_3"];
	if (isset($row["personal_zip"]))
		$searchString .= '+,+'.$row["personal_zip"];
	if (isset($row["personal_city"]))
		$searchString .= '+,+'.$row["personal_city"];
	if (isset($row["personal_country"]))
		$searchString .= '+,+'.$row["personal_country"];

	$searchString = str_replace(' ', '+', $searchString);
	$searchString = str_replace('-', '+', $searchString);
	$count = 1;
	while ($count > 0)
	{
		$searchString = str_replace('++', '+', $searchString, $count);
	}
	return $searchString;
}

function GetRelationTypes()
{
	include 'database_use_start.php';

	$query = 'select relation_type_id, description_left_to_right from '.$DB_TABLE_PREFIX.'prm_relation_type order by description_left_to_right asc';
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return $result;
}

function GetRelationTypeLeftToRightDescription($RelationTypeId)
{
	include 'database_use_start.php';

	$query = 'select relation_type_id, description_left_to_right from '.$DB_TABLE_PREFIX.'prm_relation_type where relation_type_id = '.$RelationTypeId;
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	$row = $result->fetch_assoc();

	include 'database_use_stop.php';

	return $row['description_left_to_right'];
}

function GetRelationTypeRightToLeftDescription($RelationTypeId)
{
	include 'database_use_start.php';

	$query = 'select relation_type_id, description_right_to_left from '.$DB_TABLE_PREFIX.'prm_relation_type where relation_type_id = '.$RelationTypeId;
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	$row = $result->fetch_assoc();

	include 'database_use_stop.php';

	return $row['description_right_to_left'];
}

function SearchContacts($searchString)
{
	global $DB_TABLE_PREFIX;
	$aColumns = array('contact_id', 'first_name', 'last_name');
	$aColumnsForSearch = array('personal_city', 'personal_phone', 'personal_mobile_phone', 'professional_phone', 'professional_mobile_phone', 'vehicle_license_plate');
	
	$sIndexColumn = "contact_id";
	
	$sTable = $DB_TABLE_PREFIX."prm_contact";
	
	$sLimit = "LIMIT 10";
	
	$sWhere = "";
	if ($searchString != "" )
	{
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			$sWhere .= $aColumns[$i]." LIKE '%".String2StringForSprintfQueryBuilder($searchString)."%' OR ";
		}
		for ( $i=0 ; $i<count($aColumnsForSearch) ; $i++ )
		{
			$sWhere .= $aColumnsForSearch[$i]." LIKE '%".String2StringForSprintfQueryBuilder($searchString)."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	$requete_cnf = "select view_archived from ".$DB_TABLE_PREFIX."prm_configuration";
	$resultat_cnf = ExecuteQuery_toremove($requete_cnf);
	$ligne_cnf = mysqli_fetch_assoc($resultat_cnf);
	if (!$ligne_cnf["view_archived"])
	{
		if ( $sWhere == "" )
		{
			$sWhere = "WHERE ";
		}
		else
		{
			$sWhere .= " AND ";
		}
		$sWhere .= 'ifnull(archived, 0) != 1';
	}
	
	$sQuery = "
	SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		$sWhere
		$sLimit
		";
	$rResult = ExecuteQuery_toremove($sQuery);
	
	$contacts = array();
	
	$type = "contact";
	
	/*
	 $row = array();
	 $row['id'] = -1;
	 $row['type'] = $type;
	 $row['fullName'] = "Ajouter un contact";
	 $contacts[]= $row;
	 */
	
	while ( $aRow = mysqli_fetch_array( $rResult ) )
	{
		$row = array();
		$id = -1;
		$fullName = "";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $aColumns[$i] == "contact_id" )
				$id = $aRow[ $aColumns[$i] ];
			elseif ( $aColumns[$i] == "first_name" )
			$fullName .= $aRow[ $aColumns[$i] ];
			elseif ( $aColumns[$i] == "last_name" )
			$fullName .= " ".$aRow[ $aColumns[$i] ];
		}
		$row['id'] = $id;
		$row['type'] = $type;
		$row['fullName'] = $fullName;
		$contacts[]= $row;
	}

	return $contacts;
}

?>
