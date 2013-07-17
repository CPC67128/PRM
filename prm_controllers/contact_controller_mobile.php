<?php
include 'controller_top.php';

if (isset($_GET["type"]))
{
	if ($_GET["type"] == "remove_note")
	{
		RemoveNoteFromContact($_GET["contact_id"], $_GET["note_id"]);

		header('Location: ../mobile/contact_view.php?contact_id='.$_GET['contact_id'].'#note');
		return;
	}
	elseif ($_GET["type"] == "add_note")
	{
		AddNoteToContact($_POST["contact_id"], $_POST["new_note"], date("Y-m-d"));

		if (isset($_POST["contact"]))
		{
			if ($_POST["contact"] == 'on')
			{
				UpdateLastContactDate($_POST["contact_id"]);
			}
		}
		header('Location: ../mobile/contact_view.php?contact_id='.$_POST["contact_id"].'#note');
		return;
	}
}
?>