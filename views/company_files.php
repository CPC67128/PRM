<div id="divFiles">

<form id="formFiles" action="../controllers/file_controller.php?type=add_file_to_company&company_id=<?= $row["company_id"] ?>" method="post" enctype="multipart/form-data">

<style type="text/css">
    .custom-file-control.selected:lang(en)::after {
  content: "" !important;
}
    </style>

<div class="form-group">
<label class="custom-file">
  <input type="file" name="filePicture" id="filePicture" class="custom-file-input">
  <span class="custom-file-control form-control-file"></span>
</label>

</div>

<label id="formFilesResult"></label>
<button type="submit" class="btn btn-primary" id="submit<?= $idForm ?>">Enregistrer</button>
<button type="reset" class="btn btn-default" id="reset<?= $idForm ?>" >Annuler</button>
</form>
</div>


<script type="text/javascript" charset="utf-8">
$("#formFiles").submit(function () {
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
        	LoadFilesDetail();
        }
   });

	return false;   
});

$('.custom-file-input').on('change',function(){
    var fileName = $(this).val();
    $(this).next('.form-control-file').addClass("selected").html(fileName);
})
</script>

<br />

<div id="divFilesDetail" />

<script type="text/javascript" charset="utf-8">
function LoadFilesDetail() {
	console.log("LoadFilesDetail() called");

	$.post("company_files_detail.php",
			{
				id: <?= $row["company_id"] ?>
		    },
		    function(data, status){
		    	$("#divFilesDetail").html(data);
		    });
}

LoadFilesDetail();
</script>