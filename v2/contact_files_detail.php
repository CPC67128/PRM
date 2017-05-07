<?php
include_once '../dal/dal_prm.php';

$id = -1;
if (isset($_POST['id']))
	$id = $_POST['id'];

$row = GetContactRow($id);

$result = GetFilesFromContact($id);
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
	<button data-dojo-type="dijit.form.Button" onclick="var confirmation = confirm('Supprimer ?'); if (confirmation) { dojo.xhrPost({url: '../prm_controllers/file_controller.php?type=remove_file&file_id=<?php echo $rowFile["file_id"]; ?>', load: function(data, ioArgs) { RefreshLeftPanel(); RefreshCenterPanel(); }}); }">Supprimer</button>
<?php
		if ($row["picture_file_id"] != $rowFile["file_id"])
		{
?>
	<button data-dojo-type="dijit.form.Button" onclick="dojo.xhrPost({url: '../prm_controllers/contact_controller.php?type=set_picture_file&contact_id=<?php echo $row["contact_id"]; ?>&file_id=<?php echo $rowFile["file_id"]; ?>', load: function(data, ioArgs) { RefreshLeftPanel(); RefreshCenterPanel(); }});">Définir comme portrait</button>
<?php
		}
	}
	else
	{
?>
	<a href="download.php?file_id=<?php echo $rowFile["file_id"]; ?>" target="blank"><?php echo $rowFile["original_filename"]; ?></a> (<?php echo $rowFile["creation_date"]; ?>)
	<button data-dojo-type="dijit.form.Button" onclick="var confirmation = confirm('Supprimer ?'); if (confirmation) { dojo.xhrPost({url: '../prm_controllers/file_controller.php?type=remove_file&file_id=<?php echo $rowFile["file_id"]; ?>', load: function(data, ioArgs) { RefreshCenterPanel(); }}); }">Supprimer</button>
<?php
	}
}
?>

<script type="text/javascript" charset="utf-8">
function DeleteContactAttribute(contactId, attributeId) {
	console.log("DeleteContactAttribute() called");

	var confirmation = confirm('Confirmer ?');
	if (confirmation) {
		$.post('../prm_controllers/contact_controller.php?type=remove_attribute&contact_id='+contactId+'&contact_attribute_id='+attributeId,
			{ },
			function(data, status){
				LoadContactAttributesDetail();
			});
	}
}
</script>
