<form id="form_picture" enctype="multipart/form-data" action="../prm_controllers/file_controller.php?type=add_file_to_company&company_id=<?php echo $row["company_id"]; ?>" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
<input type="file" name="filePicture" size=50 /><br />
<button data-dojo-type="dijit.form.Button" type="submit">Envoyer</button><span id="response"></span>
</form>
<br />

<script type="text/javascript">
function sendFormPicture() {
	var form = dojo.byId("form_picture");

	dojo.connect(form, "onsubmit", function(event) {
		// Stop the submit event since we want to control form submission.
	    dojo.stopEvent(event);

		dojo.byId("response").innerHTML = "Mise à jour en cours...";

	    dojo.io.iframe.send({
	        // The target URL on your webserver:
	        url: "../prm_controllers/file_controller.php?type=add_file_to_company&company_id=<?php echo $row['company_id']; ?>",

	        // The HTTP method to use, form specified POST:
	        method: "POST",

	        // The form node, which contains the
	        // to be transferred form elements:
	        form: "form_picture",

	        // The used data format:
	        handleAs: "text",

	        // Callback on successful call:
	        load: function(response, ioArgs){
	        	var message = 'Mise à jour effectuée';
			      if (response != '')
				      message += '. Message : ' + response;
		        dojo.byId("response").innerHTML = message;
		        RefreshCenterPanel();
	            return response;
	        },

	        // Callback on errors:
	        error: function(response, ioArgs){
	            dojo.byId("response").innerHTML = "Erreur " + response;
	            return response;
	        }
	    });
	});
}
dojo.ready(sendFormPicture);
</script>

<br />

<?php

$result = GetFilesFromCompany($row["company_id"]);
$n = mysql_num_rows($result);

for ($i = 0; $i < $n; $i++)
{
	if ($i > 0)
		echo "<br /><br />";
	$rowFile = mysql_fetch_assoc($result);

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
	<button data-dojo-type="dijit.form.Button" onclick="dojo.xhrPost({url: '../prm_controllers/file_controller.php?type=set_company_picture_file&company_id=<?php echo $row["company_id"]; ?>&file_id=<?php echo $rowFile["file_id"]; ?>', load: function(data, ioArgs) { RefreshLeftPanel(); RefreshCenterPanel(); }});">Définir comme image principale</button>
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