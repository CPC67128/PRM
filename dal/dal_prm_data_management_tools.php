<?php

function invalidate_emails($post)
{
	if (IsReadOnly())
		return '';

	include 'database_use_start.php';

	$message = "";
	$numberOfChange = 0;

	$emails_list = $post["emails"];
	$emails_list = str_replace(" ", "\n", $emails_list );
	$emails_list = str_replace(",", "\n", $emails_list );
	$emails_list = str_replace("\r\n", "\n", $emails_list );
	$emails_list = str_replace("\n\n", "\n", $emails_list );
	
	$emails = explode("\n", $emails_list);
	
	$index = 0;
	$total = sizeof($emails);
	
	while ($index < $total)
	{
		$current_email = $emails[$index];
		$current_email = trim($current_email);
	
		$in_here = false;
	
		if (strlen($current_email) > 0)
		{
			$contact_id = -1;
	
			$requete = "select contact_id from ".$DB_TABLE_PREFIX."prm_contact where (".
					"personal_email_1 like '%".$current_email."%' or ".
					"personal_email_2 like '%".$current_email."%' or ".
					"personal_msn like '%".$current_email."%' or ".
					"professional_email like '%".$current_email."%' or ".
					"professional_email_2 like '%".$current_email."%' )";
			$resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.mysql_error());
			if ($resultat->num_rows > 0)
			{
				$ligne = $resultat->fetch_assoc();
				$contact_id = $ligne["contact_id"];
			}
			mysqli_free_result($resultat);
	
			if ($contact_id >= 0)
			{
				$requete = "update ".$DB_TABLE_PREFIX."prm_contact set personal_email_1 = '' where personal_email_1 like '%".$current_email."%' and contact_id = ".$contact_id;
				$resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.mysql_error());
				$numberOfChange += mysql_affected_rows();
				$requete = "update ".$DB_TABLE_PREFIX."prm_contact set personal_email_2 = '' where personal_email_2 like '%".$current_email."%' and contact_id = ".$contact_id;
				$resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.mysql_error());
				$numberOfChange += mysql_affected_rows();
				$requete = "update ".$DB_TABLE_PREFIX."prm_contact set personal_msn = '' where personal_msn like '%".$current_email."%' and contact_id = ".$contact_id;
				$resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.mysql_error());
				$numberOfChange += mysql_affected_rows();
				$requete = "update ".$DB_TABLE_PREFIX."prm_contact set professional_email = '' where professional_email like '%".$current_email."%' and contact_id = ".$contact_id;
				$resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.mysql_error());
				$numberOfChange += mysql_affected_rows();
				$requete = "update ".$DB_TABLE_PREFIX."prm_contact set professional_email_2 = '' where professional_email_2 like '%".$current_email."%' and contact_id = ".$contact_id;
				$resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.mysql_error());
				$numberOfChange += mysql_affected_rows();
				$requete = "insert into ".$DB_TABLE_PREFIX."prm_note (contact_id, comment, creation_date) values (".$contact_id.", 'Email invalidé : ".$current_email."', curdate())";
				$resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.mysql_error());

				$message .= $current_email.'<br/>';
			}
		}
	
		$index = $index + 1;
	}

	$message .= $numberOfChange.' invalidations effectuées';

	include 'database_use_stop.php';

	return $message;
}

function check_emails_in_database($post)
{
	if (IsReadOnly())
		return '';

	include 'database_use_start.php';

	$message = "";

	$emails_list = $post["emails"];
	$emails_list = str_replace(" ", "\n", $emails_list );
	$emails_list = str_replace(",", "\n", $emails_list );
	$emails_list = str_replace("\r\n", "\n", $emails_list );
	$emails_list = str_replace("\n\n", "\n", $emails_list );
	
	$emails = explode("\n", $emails_list);
	
	$index = 0;
	$total = sizeof($emails);
	
	while ($index < $total)
	{
		$current_email = $emails[$index];
		$current_email = trim($current_email);

		$in_here = false;

		if (strlen($current_email) > 0)
		{
			$requete = "select * from ".$DB_TABLE_PREFIX."prm_contact where (".
				"personal_email_1 like '%".$current_email."%' or ".
				"personal_email_2 like '%".$current_email."%' or ".
				"personal_msn like '%".$current_email."%' or ".
				"professional_email like '%".$current_email."%' or ".
				"professional_email_2 like '%".$current_email."%' )";
			$resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.mysql_error());
			if ($resultat->num_rows > 0)
			{
				$in_here = true;
			}
			mysql_free_result($resultat);

			if (!$in_here)
			{		
				$message .= $current_email.'<br/>';
			}
		}

		$index = $index + 1;
	}

	$message = 'Ces emails ne sont pas en base :<br />'.$message;

	include 'database_use_stop.php';

	return $message;
}

function set_attribute_to_emails($post)
{
	if (IsReadOnly())
		return '';

	include 'database_use_start.php';

	$message = "";

	$requete = "select * from ".$DB_TABLE_PREFIX."prm_attribute where attribute = '".FormatStringForSqlQuery($_POST["attribute"])."'";
	$resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.mysql_error());
	if ($resultat->num_rows > 0)
	{
		$ligne = $resultat->fetch_assoc();
		$attribute_id = $ligne["attribute_id"];
		$attribute = $ligne["attribute"];
	}
	else
		die('No attribute');
	mysql_free_result($resultat);
	
	
	$emails_list = $post["emails"];
	$emails_list = str_replace(" ", "\n", $emails_list );
	$emails_list = str_replace(",", "\n", $emails_list );
	$emails_list = str_replace("\r\n", "\n", $emails_list );
	$emails_list = str_replace("\n\n", "\n", $emails_list );
	
	$emails = explode("\n", $emails_list);
	
	$index = 0;
	$total = sizeof($emails);
	
	while ($index < $total)
	{
		$current_email = $emails[$index];
		$current_email = trim($current_email);

		$in_here = false;

		if (strlen($current_email) > 0)
		{
			$contact_id = -1;

			$requete = "select contact_id from ".$DB_TABLE_PREFIX."prm_contact where (".
				"personal_email_1 like '%".FormatStringForSqlQuery($current_email)."%' or ".
				"personal_email_2 like '%".FormatStringForSqlQuery($current_email)."%' or ".
				"personal_msn like '%".FormatStringForSqlQuery($current_email)."%' or ".
				"professional_email like '%".FormatStringForSqlQuery($current_email)."%' or ".
				"professional_email_2 like '%".FormatStringForSqlQuery($current_email)."%' )";
			$resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.mysql_error());
			if ($resultat->num_rows > 0)
			{
				$ligne = $resultat->fetch_assoc();
				$contact_id = $ligne["contact_id"];
			}
			mysql_free_result($resultat);

			if ($contact_id >= 0)
			{
				$requete = "select contact_id from ".$DB_TABLE_PREFIX."prm_contact_attribute where contact_id = ".$contact_id." and attribute_id = ".$attribute_id;
				$resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.mysql_error());
				if ($resultat->num_rows == 0)
				{
					$note_comment  = sprintf("insert into ".$DB_TABLE_PREFIX."prm_contact_attribute (contact_id, attribute_id, creation_date) values (%s, %s, curdate())", $contact_id, $attribute_id);
					$mysqli->query($note_comment);

					$last_update = 'update '.$DB_TABLE_PREFIX.'prm_contact set last_update = curdate() where contact_id = '.$contact_id;
					$mysqli->query($last_update);

					$message .= '(+1)';
				}
				$message .= $current_email.'<br/>';
			}
		}

		$index = $index + 1;
	}

	include 'database_use_stop.php';

	return $message;
}

function set_last_contact_date_to_emails($post)
{
	if (IsReadOnly())
		return '';

	include 'database_use_start.php';

	$message = "";

	$emails_list = $post["emails"];
	$emails_list = str_replace(" ", "\n", $emails_list );
	$emails_list = str_replace(",", "\n", $emails_list );
	$emails_list = str_replace("\r\n", "\n", $emails_list );
	$emails_list = str_replace("\n\n", "\n", $emails_list );

	$emails = explode("\n", $emails_list);

	$index = 0;
	$total = sizeof($emails);

	while ($index < $total)
	{
		$current_email = $emails[$index];
		$current_email = trim($current_email);

		$in_here = false;

		if (strlen($current_email) > 0)
		{
			$contact_id = -1;

			$requete = "select contact_id from ".$DB_TABLE_PREFIX."prm_contact where (".
					"personal_email_1 like '%".FormatStringForSqlQuery($current_email)."%' or ".
					"personal_email_2 like '%".FormatStringForSqlQuery($current_email)."%' or ".
					"personal_msn like '%".FormatStringForSqlQuery($current_email)."%' or ".
					"professional_email like '%".FormatStringForSqlQuery($current_email)."%' or ".
					"professional_email_2 like '%".FormatStringForSqlQuery($current_email)."%' )";
			$resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.mysql_error());
			if ($resultat->num_rows > 0)
			{
				$ligne = $resultat->fetch_assoc();
				$contact_id = $ligne["contact_id"];
			}
			mysql_free_result($resultat);

			if ($contact_id >= 0)
			{
				$last_contact = 'update '.$DB_TABLE_PREFIX.'prm_contact set last_contact = curdate() where contact_id = '.$contact_id;
				$mysqli->query($last_contact);

				$message .= $current_email.'<br/>';
			}
		}

		$index = $index + 1;
	}

	include 'database_use_stop.php';

	return $message;
}

function remove_attribute_to_emails($post)
{
	if (IsReadOnly())
		return 'Read Only';

	include 'database_use_start.php';

	$message = "";

	$requete = "select * from ".$DB_TABLE_PREFIX."prm_attribute where attribute = '".FormatStringForSqlQuery($_POST["attribute"])."'";
	$resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.mysql_error());
	if ($resultat->num_rows > 0)
	{
		$ligne = $resultat->fetch_assoc();
		$attribute_id = $ligne["attribute_id"];
		$attribute = $ligne["attribute"];
	}
	else
		die('No attribute');
	mysql_free_result($resultat);


	$emails_list = $post["emails"];
	$emails_list = str_replace(" ", "\n", $emails_list );
	$emails_list = str_replace(",", "\n", $emails_list );
	$emails_list = str_replace("\r\n", "\n", $emails_list );
	$emails_list = str_replace("\n\n", "\n", $emails_list );

	$emails = explode("\n", $emails_list);

	$index = 0;
	$total = sizeof($emails);

	while ($index < $total)
	{
		$current_email = $emails[$index];
		$current_email = trim($current_email);

		$in_here = false;

		if (strlen($current_email) > 0)
		{
			$contact_id = -1;

			$requete = "select contact_id from ".$DB_TABLE_PREFIX."prm_contact where (".
					"personal_email_1 like '%".FormatStringForSqlQuery($current_email)."%' or ".
					"personal_email_2 like '%".FormatStringForSqlQuery($current_email)."%' or ".
					"personal_msn like '%".FormatStringForSqlQuery($current_email)."%' or ".
					"professional_email like '%".FormatStringForSqlQuery($current_email)."%' or ".
					"professional_email_2 like '%".FormatStringForSqlQuery($current_email)."%' )";
			$resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.mysql_error());
			if ($resultat->num_rows > 0)
			{
				$ligne = $resultat->fetch_assoc();
				$contact_id = $ligne["contact_id"];
			}
			mysql_free_result($resultat);

			if ($contact_id >= 0)
			{
				$requete = "select contact_id from ".$DB_TABLE_PREFIX."prm_contact_attribute where contact_id = ".$contact_id." and attribute_id = ".$attribute_id;
				$resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.mysql_error());
				if ($resultat->num_rows > 0)
				{
					$note_comment  = sprintf("delete from ".$DB_TABLE_PREFIX."prm_contact_attribute where contact_id = %s and attribute_id = %s", $contact_id, $attribute_id);
					$mysqli->query($note_comment);

					$last_update = 'update '.$DB_TABLE_PREFIX.'prm_contact set last_update = curdate() where contact_id = '.$contact_id;
					$mysqli->query($last_update);

					$message .= '(-1)';
				}
				$message .= $current_email.'<br/>';
			}
			else
				$message .= $current_email.' => ???<br/>';
		}

		$index = $index + 1;
	}

	include 'database_use_stop.php';

	return $message;
}

function export_emails($post)
{
	if (IsReadOnly())
		return '';

	include 'database_use_start.php';

	$where = '';
	$userLimitationWhere = '';
	for ($i = 1; $i <= 3; $i++)
	{
		if ($post['attribute_include_'.$i] != '')
		{
			$requete = "select attribute_id from ".$DB_TABLE_PREFIX."prm_attribute where attribute = '".FormatStringForSqlQuery($_POST['attribute_include_'.$i])."'";
			$resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.mysql_error());
			if ($resultat->num_rows > 0)
			{
				$ligne = $resultat->fetch_assoc();
				$attribute_id = $ligne["attribute_id"];

				$where .= ($where == '' ? ' where ' : ' and ').' contact_id in (select contact_id from '.$DB_TABLE_PREFIX.'prm_contact_attribute where attribute_id = '.$attribute_id.') ';
			}
			mysql_free_result($resultat);
		}
	}

	for ($i = 1; $i <= 3; $i++)
	{
		if ($post['attribute_exclude_'.$i] != '')
		{
			$requete = "select attribute_id from ".$DB_TABLE_PREFIX."prm_attribute where attribute = '".FormatStringForSqlQuery($_POST['attribute_exclude_'.$i])."'";
				$resultat = $mysqli->query($requete) or die ('Erreur '.$requete.' '.mysql_error());
			if ($resultat->num_rows > 0)
			{
				$ligne = $resultat->fetch_assoc();
				$attribute_id = $ligne["attribute_id"];

				$where .= ($where == '' ? ' where ' : ' and ').' contact_id not in (select contact_id from '.$DB_TABLE_PREFIX.'prm_contact_attribute where attribute_id = '.$attribute_id.') ';
			}
			mysql_free_result($resultat);
		}
	}

	$extraWhere = '';
	$sqlQuery = '';
	$extraWhere .= ($where == '' ? ' where ' : ' and ').' professional_email is not null';
	$userLimitationWhere .= '';
	$sqlQuery .= 'select professional_email as email from '.$DB_TABLE_PREFIX.'prm_contact '.$where.$extraWhere.$userLimitationWhere;
	$sqlQuery .= ' union ';
	$extraWhere = str_replace('is not null', 'is null', $extraWhere);
	$extraWhere .= ' and professional_email_2 is not null';
	$sqlQuery .= 'select professional_email_2 as email from '.$DB_TABLE_PREFIX.'prm_contact '.$where.$extraWhere.$userLimitationWhere;
	$sqlQuery .= ' union ';
	$extraWhere = str_replace('is not null', 'is null', $extraWhere);
	$extraWhere .= ' and personal_email_1 is not null';
	$sqlQuery .= 'select personal_email_1 as email from '.$DB_TABLE_PREFIX.'prm_contact '.$where.$extraWhere.$userLimitationWhere;
	$sqlQuery .= ' union ';
	$extraWhere = str_replace('is not null', 'is null', $extraWhere);
	$extraWhere .= ' and personal_email_2 is not null';
	$sqlQuery .= 'select personal_email_2 as email from '.$DB_TABLE_PREFIX.'prm_contact '.$where.$extraWhere.$userLimitationWhere;
	$sqlQuery .= ' union ';
	$extraWhere = str_replace('is not null', 'is null', $extraWhere);
	$extraWhere .= ' and personal_msn is not null';
	$sqlQuery .= 'select personal_msn as email from '.$DB_TABLE_PREFIX.'prm_contact '.$where.$extraWhere.$userLimitationWhere;

	$resultat = $mysqli->query($sqlQuery) or die ('Erreur '.$sqlQuery.' '.mysql_error());
	
	$message = '';
	while ($ligne = $resultat->fetch_assoc())
	{
		$message .= $ligne["email"].'<br />';
	}

	mysql_free_result($resultat);

	include 'database_use_stop.php';

	return $message;
}
?>