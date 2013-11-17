<?php

function GetFileRow($FileId)
{
	include 'database_use_start.php';
	
	$query = 'select * from '.$DB_TABLE_PREFIX.'prm_file where file_id = '.$FileId;
	$result = mysql_query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	
	include 'database_use_stop.php';

	$row = mysql_fetch_assoc($result);

	return $row;
}

function GetFilesFromContact($ContactId)
{
	include 'database_use_start.php';

	$query = 'select * from '.$DB_TABLE_PREFIX.'prm_file where record_type = 1 and record_id = '.$ContactId.' order by file_id asc';
	$result = mysql_query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return $result;
}

function GetFilesFromCompany($CompanyId)
{
	include 'database_use_start.php';

	$query = 'select * from '.$DB_TABLE_PREFIX.'prm_file where record_type = 2 and record_id = '.$CompanyId.' order by file_id asc';
	$result = mysql_query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return $result;
}

function DeleteFile($FileId)
{
	if (IsReadOnly())
		return;

	$row = GetFileRow($FileId);
	
	if (isset($row["filename"]))
	{
		unlink("../uploads/".$row["filename"]);
	}

	include 'database_use_start.php';

	$query = 'delete from '.$DB_TABLE_PREFIX.'prm_file where file_id = '.$FileId;
	$result = mysql_query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	$query = 'update '.$DB_TABLE_PREFIX.'prm_contact set picture_file_id = null where picture_file_id = '.$FileId;
	$result = mysql_query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';

	return $result;
}

function InsertFileToContact($ContactId, $Filename, $OriginalFilename)
{
	if (IsReadOnly())
	return;

	include 'database_use_start.php';

	$query = sprintf("insert into ".$DB_TABLE_PREFIX."prm_file (record_type, record_id, filename, original_filename, creation_date) values (1, %s, '%s', '%s', now())",
	$ContactId,
	FormatStringForSqlQuery($Filename),
	FormatStringForSqlQuery($OriginalFilename));
	$result = mysql_query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	UpdateLastUpdateDate($ContactId);

	include 'database_use_stop.php';
}

function InsertFileToCompany($CompanyId, $Filename, $OriginalFilename)
{
	if (IsReadOnly())
		return;

	include 'database_use_start.php';

	$query = sprintf("insert into ".$DB_TABLE_PREFIX."prm_file (record_type, record_id, filename, original_filename, creation_date) values (2, %s, '%s', '%s', now())",
		$CompanyId,
		FormatStringForSqlQuery($Filename),
		FormatStringForSqlQuery($OriginalFilename));
	$result = mysql_query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	include 'database_use_stop.php';
}

function SetCompanyPictureFile($CompanyId, $FileId)
{
	if (IsReadOnly())
	return;

	include 'database_use_start.php';

	$query = sprintf("update ".$DB_TABLE_PREFIX."prm_company set picture_file_id = %s where company_id = %s",
		$FileId,
		$CompanyId);
	$result = mysql_query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());

	UpdateCompanyLastUpdateDate($CompanyId);

	include 'database_use_stop.php';
}

function file_GetFileName($File_id)
{
	include 'database_use_start.php';

	$query = 'select filename
		from '.$DB_TABLE_PREFIX.'prm_file
		where file_id = '.$File_id;
	$result = mysql_query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	$row = mysql_fetch_assoc($result);

	include 'database_use_stop.php';

	if (isset($row['filename']))
		return $row['filename'];

	return '';
}

function file_GetOrginalFileName($File_id)
{
	include 'database_use_start.php';

	$query = 'select original_filename
		from '.$DB_TABLE_PREFIX.'prm_file
		where file_id = '.$File_id;
	$result = mysql_query($query) or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
	$row = mysql_fetch_assoc($result);

	include 'database_use_stop.php';

	if (isset($row['original_filename']))
		return $row['original_filename'];

	return '';
}