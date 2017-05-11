<form action="/" id="deleteActionForm">
<input type="hidden" name="attribute_id" value="<?php echo $row["attribute_id"] ?>">
<button data-dojo-type="dijit.form.Button" type="submit" name="submit" id="submit">Supprimer</button>
&nbsp;
La suppression détruit définitivement les informations liées à cet attribut.
<div id="deleteActionFormResult"></div>
</form>

<script type="text/javascript" charset="utf-8">
$("#deleteActionForm").submit(function () {
	confirmation = confirm('Etes vous sûr de vouloir supprimer cet attribut ?');
	if (!confirmation)
		return false;

	document.getElementById("submit").disabled = true;
	$.post(
      '../prm_controllers/attribute_controller.php?type=delete',
      $(this).serialize(),
      function(response, status){
    	  document.getElementById("submit").disabled = false;
          if (status == 'success')
          {
              if (response.indexOf("<!-- ERROR -->") != 0)
              {
            	  ResetScreen();
              }
              else
              {
            	  $("#deleteActionFormResult").html(response);
              }
          }
          else
          {
              $("#deleteActionFormResult").html(status);
          }
      }
    );
    return false;   
});
</script>