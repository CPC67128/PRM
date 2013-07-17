<?php
include 'controller_top.php';

if (isset($_GET["type"]))
{
	if ($_GET["type"] == "set_attribute")
	{
		SetAttributeToContact($_POST["contact_id"], $_POST["new_attribute"], $_POST["set_date"]);
	}
	else if ($_GET["type"] == "archive")
	{
		ArchiveContact($_POST["contact_id"]);
	}
	else if ($_GET["type"] == "delete")
	{
		DeleteContact($_POST["contact_id"]);
	}
	else if ($_GET["type"] == "insert")
	{
		$newContactId = CreateContact($_POST);
		echo $newContactId;
	}
	else if ($_GET["type"] == "delete")
	{
		DeleteContact($_POST["contact_id"]);
	}
	else if ($_GET["type"] == "update")
	{
		UpdateContact($_POST["contact_id"], $_POST);
	}
	else if ($_GET["type"] == "last_contact")
	{
		UpdateLastContactDate($_GET["contact_id"]);
	}
	elseif ($_GET["type"] == "last_update")
	{
		UpdateLastUpdateDate($_GET["contact_id"]);
	}
	elseif ($_GET["type"] == "regular_contact")
	{
		UpdateRegularContact($_GET["contact_id"], $_GET["value"]);
	}
	elseif ($_GET["type"] == "add_note")
	{
		AddNoteToContact($_POST["contact_id"], $_POST["new_note"], $_POST["new_note_date"]);
	}
	elseif ($_GET["type"] == "remove_note")
	{
		RemoveNoteFromContact($_GET["contact_id"], $_GET["note_id"]);
	}
	elseif ($_GET["type"] == "remove_attribute")
	{
		RemoveAttributeFromContact($_GET["contact_id"], $_GET["contact_attribute_id"]);
	}
	elseif ($_GET["type"] == "set_picture_file")
	{
		SetPictureFileToContact($_GET["contact_id"], $_GET["file_id"]);
	}
	elseif ($_GET["type"] == "picture")
	{
		$ligne = GetContactRow($_GET["contact_id"]);
	
		if (isset($ligne["picture_file_name"]))
		{
			unlink("../uploads/".$ligne["picture_file_name"]);
		}

		$target_path = "../uploads/";
		$extension = substr($_FILES['filePicture']['name'], strrpos($_FILES['filePicture']['name'], '.') +1);
		$file_name = $ligne["first_name"].' '.$ligne["last_name"].', '.$_GET["contact_id"].', 1.'.$extension;
		$target_path = $target_path.$file_name;

		if (move_uploaded_file($_FILES['filePicture']['tmp_name'], $target_path))
		{
			UpdatePictureFileName($_GET["contact_id"], $file_name);
		}
		else
		{
			die("There was an error uploading the file, please try again!");
		}

		echo '<html><body><textarea></textarea></body></html>';
	}
	elseif ($_GET["type"] == "add_relation_to_contact")
	{
		AddRelationFromContactToContact($_POST["left_contact_id"], $_POST["relation_type_id"], $_POST["right_contact_id"]);

		echo '<html><body><textarea></textarea></body></html>';
	}
	elseif ($_GET["type"] == "remove_relation_to_contact")
	{
		RemoveRelationFromContactToContact($_GET["relation_contact_to_contact_id"]);
	}
	return;
}

die("NO TYPE");
?>
