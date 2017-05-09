<?php
include 'controller_top.php';

if (isset($_GET["type"]))
{
	if ($_GET["type"] == "remove_file")
	{
		DeleteFile($_GET["file_id"]);
	}
	elseif ($_GET["type"] == "add_file_to_contact")
	{
		$ligne = GetContactRow($_GET["contact_id"]);

		$target_path = "../uploads/";
		$extension = substr($_FILES['filePicture']['name'], strrpos($_FILES['filePicture']['name'], '.') +1);
		$file_name = $ligne["first_name"].' '.$ligne["last_name"].', '.$_GET["contact_id"].', '.date('Y-m-d-H-i-s').'.'.$extension;
		$target_path = $target_path.$file_name;
		
		if (move_uploaded_file($_FILES['filePicture']['tmp_name'], $target_path))
		{
			InsertFileToContact($_GET["contact_id"], $file_name, $_FILES['filePicture']['name']);
		}
		else
		{
			echo '<html><body><textarea>There was an error uploading the file, please try again! '.$target_path.'</textarea></body></html>';
			exit();
		}

		echo '<html><body><textarea></textarea></body></html>';
		exit();
	}
	elseif ($_GET["type"] == "add_file_to_company")
	{
		$ligne = GetCompanyRow($_GET["company_id"]);
	
		$target_path = "../uploads/";
		$extension = substr($_FILES['filePicture']['name'], strrpos($_FILES['filePicture']['name'], '.') +1);
		$file_name = $ligne["name"].', '.$_GET["company_id"].', '.date('Y-m-d-H-i-s').'.'.$extension;
		$target_path = $target_path.$file_name;
	
		if (move_uploaded_file($_FILES['filePicture']['tmp_name'], $target_path))
		{
			InsertFileToCompany($_GET["company_id"], $file_name, $_FILES['filePicture']['name']);
		}
		else
		{
			echo '<html><body><textarea>There was an error uploading the file, please try again!</textarea></body></html>';
			return;
		}
	
		echo '<html><body><textarea></textarea></body></html>';
	}
	elseif ($_GET["type"] == "set_company_picture_file")
	{
		SetCompanyPictureFile($_GET["company_id"], $_GET["file_id"]);
	}
	return;
}

die("NO TYPE");
?>
