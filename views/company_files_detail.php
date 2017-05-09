<?php
include_once '../dal/dal_prm.php';

$id = -1;
if (isset($_POST['id']))
	$id = $_POST['id'];

$row = GetCompanyRow($id);

$result = GetFilesFromCompany($row["company_id"]);
$n = $result->num_rows;

for ($i = 0; $i < $n; $i++)
{
	if ($i > 0)
		echo "<br /><br />";
	$rowFile = $result->fetch_assoc();

	if (IsFileAPicture($rowFile["filename"]))
	{
?>
	<img class="imageView" src="download.php?file_id=<?php echo $rowFile["file_id"]; ?>" border=0 /><br />
	<a href="download.php?file_id=<?php echo $rowFile["file_id"]; ?>" target="blank"><?php echo $rowFile["original_filename"]; ?></a> (<?php echo $rowFile["creation_date"]; ?>)
	<button data-dojo-type="dijit.form.Button" onclick="DeleteFile(<?= $rowFile["file_id"] ?>);">Supprimer</button>
<?php
		if ($row["picture_file_id"] != $rowFile["file_id"])
		{
?>
	<button data-dojo-type="dijit.form.Button" onclick="SetMainPictureFile(<?= $row["company_id"] ?>, <?= $rowFile["file_id"] ?>);">Définir comme portrait</button>
<?php
		}
	}
	else
	{
?>
	<a href="download.php?file_id=<?php echo $rowFile["file_id"]; ?>" target="blank"><?php echo $rowFile["original_filename"]; ?></a> (<?php echo $rowFile["creation_date"]; ?>)
	<button data-dojo-type="dijit.form.Button" onclick="DeleteFile(<?= $rowFile["file_id"] ?>);">Supprimer</button>
<?php
	}
}
?>

<script type="text/javascript" charset="utf-8">
function DeleteFile(fileId) {
	console.log("DeleteFile() called");
	var confirmation = confirm('Confirmer ?');
	if (confirmation) {
		$.post('../controllers/file_controller.php?type=remove_file&file_id='+fileId,
			{ },
			function(data, status){
				LoadFilesDetail();
			});
	}
}

function SetMainPictureFile(contactId, fileId) {
	console.log("SetMainPictureFile() called");
	var confirmation = confirm('Confirmer ?');
	if (confirmation) {
		$.post('../controllers/company_controller.php?type=set_picture_file&company_id='+contactId+'&file_id='+fileId,
			{ },
			function(data, status){
				LoadFilesDetail();
			});
	}
}
</script>