<?php

function GetCompaniesNextActionsHighlight()
{
	include 'database_use_start.php';

	$query = "select company_id, next_action, name
		from ".$DB_TABLE_PREFIX."prm_company
		where ifnull(next_action, '') != ''
		order by ifnull(last_update, '1900-01-01') asc";
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return $result;
}

// Company deletion
function DeleteCompany($CompanyId)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = 'update '.$DB_TABLE_PREFIX.'prm_contact set company_id = null where company_id = '.$CompanyId;
	$mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());  
	
	$query = 'delete from '.$DB_TABLE_PREFIX.'prm_company_attribute where company_id = '.$CompanyId;
	$mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());  
	
	$query = 'delete from '.$DB_TABLE_PREFIX.'prm_company where company_id = '.$CompanyId;
	$mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());  

	include 'database_use_stop.php';
}

function ArchiveCompany($CompanyId)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = 'update '.$DB_TABLE_PREFIX.'prm_company set archived = 1 where company_id = '.$CompanyId;
	$mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());  
	
	$query = sprintf("insert into ".$DB_TABLE_PREFIX."prm_note (contact_id, comment, creation_date) values (%s, '%s', now())",
		$_POST["company_id"],
		'Archivage');
	$mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	_UpdateCompanyLastUpdateDate($CompanyId);

	include 'database_use_stop.php';
}

function GetCompanyRow($CompanyId)
{
	$result = GetCompanyResource($CompanyId);
	$row = $result->fetch_assoc();

	return $row;
}

function GetCompanyResource($CompanyId)
{
	include 'database_use_start.php';

	$query = 'select * from '.$DB_TABLE_PREFIX.'prm_company where company_id = '.$CompanyId;
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return $result;
}

function GetAllCompanyNames()
{
	include 'database_use_start.php';
	
	$query = 'select distinct name from '.$DB_TABLE_PREFIX.'prm_company order by name';
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	
	include 'database_use_stop.php';
	
	return $result;
}

// Company attributes
function GetCompanyAttributes($CompanyId)
{
	include 'database_use_start.php';

	$query = 'select
		CA.company_attribute_id,
		A.attribute,
		CA.creation_date,
		CA.company_id
		from '.$DB_TABLE_PREFIX.'prm_company_attribute CA
		inner join '.$DB_TABLE_PREFIX.'prm_attribute A on A.attribute_id = CA.attribute_id
		where CA.company_id = '.$CompanyId.'
		order by attribute';
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return $result;
}

// Set attribute
function SetAttributeToCompany($CompanyId, $Attribute, $CreationDate)
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

	$query = sprintf("delete from ".$DB_TABLE_PREFIX."prm_company_attribute where company_id = %s and attribute_id = %s",
		$CompanyId,
		$row["attribute_id"]);
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	$query = sprintf("insert into ".$DB_TABLE_PREFIX."prm_company_attribute (company_id, attribute_id, creation_date) values (%s, %s, '%s')",
		$CompanyId,
		$row["attribute_id"],
		$mysqli->real_escape_string($CreationDate));
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	_UpdateCompanyLastUpdateDate($CompanyId);

	include 'database_use_stop.php';
}

function _UpdateCompanyLastUpdateDate($CompanyId)
{
	if (IsReadOnly())
		return;

	include '../configuration/configuration.php';

	$query = sprintf("update ".$DB_TABLE_PREFIX."prm_company set last_update = curdate() where company_id = %s",
		$CompanyId);
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
}

function UpdateCompanyLastUpdateDate($CompanyId)
{
	_UpdateCompanyLastUpdateDate($CompanyId);
}

function CreateCompany($CompanyName)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = sprintf("insert into ".$DB_TABLE_PREFIX."prm_company (name, last_update) values ('%s', now())",
		FormatStringForSqlQuery($CompanyName));
	$mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	$newId = mysql_insert_id();

	$query = sprintf("insert into ".$DB_TABLE_PREFIX."prm_note (company_id, comment, creation_date) values (%s, '%s', now())",
		$newId,
		'Création');
	$mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return $newId;
}

function GetNotesFromCompany($CompanyId)
{
	include 'database_use_start.php';

	$query = 'select * from '.$DB_TABLE_PREFIX.'prm_note where company_id = '.$CompanyId;
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return $result;
}

function AddNoteToCompany($CompanyId, $Note)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = sprintf("insert into ".$DB_TABLE_PREFIX."prm_note (company_id, comment, creation_date) values (%s, '%s', now())",
		$CompanyId,
		(get_magic_quotes_gpc() ? $Note : $mysqli->real_escape_string($Note)));
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	_UpdateCompanyLastUpdateDate($CompanyId);

	include 'database_use_stop.php';
}

function RemoveNoteFromCompany($CompanyId, $NoteId)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = sprintf("delete from ".$DB_TABLE_PREFIX."prm_note where note_id = %s",
		$NoteId);
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	_UpdateCompanyLastUpdateDate($CompanyId);

	include 'database_use_stop.php';
}

function RemoveAttributeFromCompany($CompanyId, $CompanyAttributeId)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = sprintf("delete from ".$DB_TABLE_PREFIX."prm_company_attribute where company_attribute_id = %s",
		$CompanyAttributeId);
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	
	_UpdateCompanyLastUpdateDate($CompanyId);

	include 'database_use_stop.php';
}

function UpdateCompany($CompanyId, $post)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = "select * from ".$DB_TABLE_PREFIX."prm_company where company_id = ".$CompanyId;
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	$row = $result->fetch_assoc();

	$fields_to_ignore = array("notes_length", "attributes_length", "new_attribute", "new_note", "last_update");

	$update_query = '';
	$note_comment = '';

	$something_has_changed = false;

	foreach($post as $field_name=>$field_value)
	{
		if (!in_array($field_name, $fields_to_ignore))
		{
			// Fields names that match with prm_attribute table field names (type VARCHAR)
			if ($field_value != $row[$field_name])
			{
				if (strlen(chop($row[$field_name])) > 0)
				{
					if (strlen($note_comment) > 0)
						$note_comment .= chr(10);
					$note_comment .= $field_name.' est modifié de "'.$row[$field_name].'" vers "'.$field_value.'"';
				}

				// update of the field
				if (strlen($update_query) > 0)
					$update_query .= ',';

				$update_query .= $field_name.'=\''.(get_magic_quotes_gpc() ? $field_value : $mysqli->real_escape_string($field_value)).'\'';
				$something_has_changed = true;
			}
		}
	}

	if ($something_has_changed)
	{
		$query = 'update '.$DB_TABLE_PREFIX.'prm_company set '.$update_query.' where company_id = '.$CompanyId;
		$mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

		if (strlen(chop($note_comment)) > 0)
		{
			$query = sprintf("insert into ".$DB_TABLE_PREFIX."prm_note (company_id, comment, creation_date) values (%s, '%s', now())",
				$CompanyId,
				(get_magic_quotes_gpc() ? $Note : $mysqli->real_escape_string($note_comment)));
			$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
		}

		_UpdateCompanyLastUpdateDate($CompanyId);
	}

	include 'database_use_stop.php';
}

function GetCompanyShortDescription($CompanyId)
{
	include 'database_use_start.php';

	$query = 'select name
		from '.$DB_TABLE_PREFIX.'prm_company
		where company_id = '.$CompanyId;
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	$row = $result->fetch_assoc();

	include 'database_use_stop.php';

	$shortDescriptionString = "";

	if (isset($row["name"]))
		$shortDescriptionString = $row["name"];

	return $shortDescriptionString;
}

function GetCompanyGoogleItSearchString($CompanyId)
{
	include 'database_use_start.php';

	$query = 'select name
		from '.$DB_TABLE_PREFIX.'prm_company
		where company_id = '.$CompanyId;
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	$row = $result->fetch_assoc();

	include 'database_use_stop.php';

	$searchString = "";

	if (isset($row["name"]))
		$searchString = $row["name"];

	$searchString = str_replace(' ', '+', $searchString);
	$searchString = str_replace('-', '+', $searchString);
	$searchString = str_replace('++', '+', $searchString);
	$searchString = str_replace('++', '+', $searchString);
	$searchString = str_replace('++', '+', $searchString);
	return $searchString;
}

function GetCompanyGoogleMapsItSearchString($CompanyId)
{
	include 'database_use_start.php';

	$query = 'select name, postal_name, address_1, address_2, address_3, address_4, zip, city, country
		from '.$DB_TABLE_PREFIX.'prm_company
		where company_id = '.$CompanyId;
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	$row = $result->fetch_assoc();

	include 'database_use_stop.php';

	$searchString = "";

	if (isset($row["postal_name"]))
		$searchString = $row["postal_name"];
	else
		$searchString = $row["name"];

	if (isset($row["address_1"]))
		$searchString .= '+,+'.$row["address_1"];
	if (isset($row["address_2"]))
		$searchString .= '+'.$row["address_2"];
	if (isset($row["address_3"]))
		$searchString .= '+'.$row["address_3"];
	if (isset($row["address_4"]))
		$searchString .= '+'.$row["address_4"];
	if (isset($row["zip"]))
	$searchString .= '+,+'.$row["zip"];
	if (isset($row["city"]))
	$searchString .= '+,+'.$row["city"];
	if (isset($row["country"]))
	$searchString .= '+,+'.$row["country"];

	$searchString = str_replace(' ', '+', $searchString);
	$searchString = str_replace('-', '+', $searchString);
	$count = 1;
	while ($count > 0)
	{
		$searchString = str_replace('++', '+', $searchString, $count);
	}
	return $searchString;
}

function company_GetCompanyPictureFileId($Company_id)
{
	include 'database_use_start.php';

	$query = 'select FIL.file_id
			from '.$DB_TABLE_PREFIX.'prm_company COM
			inner join '.$DB_TABLE_PREFIX.'prm_file FIL on COM.picture_file_id = FIL.file_id
			where COM.company_id = '.$Company_id;
	$result = $mysqli->query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	$row = $result->fetch_assoc();

	include 'database_use_stop.php';

	if (isset($row["file_id"]))
		return $row["file_id"];

	return '';
}

?>