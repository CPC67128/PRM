<div id="divContactFiles">

<form id="formContactFiles" action="../prm_controllers/file_controller.php?type=add_file_to_contact&contact_id=<?= $row["contact_id"] ?>" method="post" enctype="multipart/form-data">

<input type="hidden" name="MAX_FILE_SIZE" value="30000000" />

<label class="custom-file">
  <input type="file" name="filePicture" id="filePicture" class="custom-file-input">
  <span class="custom-file-control"></span>
</label>
<br/>
<label id="formContactFilesResult"></label>
<button type="submit" class="btn btn-primary" id="submit<?= $idForm ?>">Enregistrer</button>
<button type="reset" class="btn btn-default" id="reset<?= $idForm ?>" >Annuler</button>

</form>
</div>

<script type="text/javascript" charset="utf-8">
$("#formContactFiles").submit(function () {
	var $form = $(this);

    var formdata = (window.FormData) ? new FormData($form[0]) : null;
    var data = (formdata !== null) ? formdata : $form.serialize();

    $.ajax({
        type:  $form.attr('method'), 
        url: $form.attr('action'),

        contentType: false, // obligatoire pour de l'upload
        processData: false, // obligatoire pour de l'upload

        data: data,
        success: function( dataResult )  
        {
             alert( dataResult );
        }
   });

	return false;   
});
</script>

<br />

<div id="divContactFilesDetail" />

<script type="text/javascript" charset="utf-8">
function LoadContactFilesDetail() {
	console.log("LoadContactFilesDetail() called");

	$.post("contact_files_detail.php",
			{
				id: <?= $row["contact_id"] ?>
		    },
		    function(data, status){
		    	$("#divContactFilesDetail").html(data);
		    });
}

LoadContactFilesDetail();
</script>