<?php
include 'controller_top.php';

if (isset($_GET["type"]))
{
	if ($_GET["type"] == "delete")
	{
		DeleteCompany($_POST["company_id"]);
	}
	else if ($_GET["type"] == "set_attribute")
	{
		SetAttributeToCompany($_POST["company_id"], $_POST["new_attribute"], $_POST["set_date"]);
	}
	else if ($_GET["type"] == "update")
	{
		UpdateCompany($_POST["company_id"], $_POST);
	}
	else if ($_GET["type"] == "insert")
	{
		$newCompanyId = CreateCompany($_POST["name"]);
		echo $newCompanyId;
	}
	else if ($_GET["type"] == "add_note")
	{
		AddNoteToCompany($_POST["company_id"], $_POST["new_note"]);
	}
	elseif ($_GET["type"] == "remove_note")
	{
		RemoveNoteFromCompany($CompanyId, $_GET["note_id"]);
	}
	elseif ($_GET["type"] == "remove_attribute")
	{
		RemoveAttributeFromCompany($_GET["company_id"], $_GET["company_attribute_id"]);
	}
	else if ($_GET["type"] == "archive")
	{
		DeleteCompany($_POST["company_id"]);
	}
	return;
}

die("NO TYPE");   
?>
