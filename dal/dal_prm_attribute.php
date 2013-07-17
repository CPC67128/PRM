<?php

function GetAttributeRow($AttributeId)
{
	$result = GetAttributeResource($AttributeId);
	$row = mysql_fetch_assoc($result);

	return $row;
}

function GetAttributeResource($AttributeId)
{
	include 'database_use_start.php';

	$query = 'select *
		from '.$DB_TABLE_PREFIX.'sf_prm_attribute
		where attribute_id = '.$AttributeId.'
		order by attribute';
	$result = mysql_query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return $result;
}

// Attributes for companies
function GetAttributeNamesForCompany()
{
	include 'database_use_start.php';

	$query = 'select distinct attribute from '.$DB_TABLE_PREFIX.'sf_prm_attribute where for_company = 1 order by attribute';
	$result = mysql_query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return $result;
}

function GetAllAttributesForContact()
{
	include 'database_use_start.php';
	
	$query = 'select distinct attribute from '.$DB_TABLE_PREFIX.'sf_prm_attribute where for_contact = 1 order by attribute';
	$result = mysql_query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	
	include 'database_use_stop.php';
	
	return $result;
}

function UpdateAttribute($AttributeId, $post)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = "select * from '.$DB_TABLE_PREFIX.'sf_prm_attribute where attribute_id = ".$AttributeId;
	$result = mysql_query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	$row = mysql_fetch_assoc($result);

	$fields_to_ignore = array("attribute_id");
	$fields_checkbox = array("for_contact", "for_company");
	
	$update_query = '';
	$delete_query = '';
	
	$something_has_changed = false;
	
	foreach($post as $field_name=>$field_value)
	{
		if (!in_array($field_name, $fields_to_ignore) && !in_array($field_name, $fields_checkbox))
		{
			// Fields names that match with sf_prm_attribute table field names (type VARCHAR)
			if ($field_value != $row[$field_name])
			{
				// update of the field
				if (strlen($update_query) > 0)
					$update_query .= ',';

				$update_query .= $field_name.'=\''.(get_magic_quotes_gpc() ? $field_value : mysql_real_escape_string($field_value)).'\'';

				$something_has_changed = true;
			}
		}
	}

	// Fields names that match with sf_prm_attribute table field names (type CHECKBOX)
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

			if ($newFieldValue == 0)
			{
				if ($field_name == 'for_contact')
					$delete_query .= 'delete from '.$DB_TABLE_PREFIX.'sf_prm_contact_attribute where attribute_id = '.$AttributeId;
				else if ($field_name == 'for_company')
					$delete_query .= 'delete from '.$DB_TABLE_PREFIX.'sf_prm_company_attribute where attribute_id = '.$AttributeId;
			}
		}
	}

	if ($something_has_changed)
	{
		$update_query = 'update '.$DB_TABLE_PREFIX.'sf_prm_attribute set '.$update_query.' where attribute_id = '.$AttributeId;
		mysql_query($update_query);
		
		mysql_query($delete_query);
	}
}

// Delete update
function DeleteAttribute($AttributeId)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = 'delete from '.$DB_TABLE_PREFIX.'sf_prm_contact_attribute where attribute_id = '.$AttributeId;
	mysql_query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	$query = 'delete from '.$DB_TABLE_PREFIX.'sf_prm_company_attribute where attribute_id = '.$AttributeId;
	mysql_query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	$query = 'delete from '.$DB_TABLE_PREFIX.'sf_prm_attribute where attribute_id = '.$AttributeId;
	mysql_query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';
}

// Attribute update
function CreateAttribute($post)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = sprintf("insert into ".$DB_TABLE_PREFIX."sf_prm_attribute (attribute, for_company, for_contact) values ('%s', %s, %s)",
		(get_magic_quotes_gpc() ? $Attribute : mysql_real_escape_string($_POST["attribute"])),
		(isset($post["for_company"]) && $post["for_company"] == 'on' ? '1' : '0'),
		(isset($post["for_contact"]) && $post["for_contact"] == 'on' ? '1' : '0'));
	$result = mysql_query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	$newId = mysql_insert_id();

	include 'database_use_stop.php';

	return $newId;
}


function GetAttributeShortDescription($AttributeId)
{
	include 'database_use_start.php';

	$query = 'select attribute
		from '.$DB_TABLE_PREFIX.'sf_prm_attribute
		where attribute_id = '.$AttributeId;
	$result = mysql_query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	$row = mysql_fetch_assoc($result);

	include 'database_use_stop.php';

	$shortDescriptionString = "";

	if (isset($row["attribute"]))
		$shortDescriptionString = $row["attribute"];

	return $shortDescriptionString;
}

?>
