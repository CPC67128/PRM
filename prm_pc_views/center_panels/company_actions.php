<form action="/" id="archiveActionForm">
<input type="hidden" name="company_id" value="<?php echo $row["company_id"] ?>">
<button data-dojo-type="dijit.form.Button" type="submit" name="submit" id="submit"><?php echo GetString('Archiver'); ?></button>
&nbsp;
<?php echo GetString('L\'archivage permet de cacher la fiche de la visualisation par défaut'); ?>
<div id="archiveActionFormResult"></div>
</form>

<script type="text/javascript" charset="utf-8">
$("#archiveActionForm").submit(function () {
	confirmation = confirm('<?php echo GetString('Etes vous sûr de vouloir archiver cette entreprise ?'); ?>');
	if (!confirmation)
		return false;

	document.getElementById("submit").disabled = true;
	$.post(
      '../prm_controllers/contact_controller.php?type=archive',
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
            	  $("#archiveActionFormResult").html(response);
              }
          }
          else
          {
              $("#archiveActionFormResult").html(status);
          }
      }
    );
    return false;   
});
</script>

<br />

<form action="/" id="deleteActionForm">
<input type="hidden" name="company_id" value="<?php echo $row["company_id"] ?>">
<button data-dojo-type="dijit.form.Button" type="submit" name="submit" id="submit"><?php echo GetString('Supprimer'); ?></button>
&nbsp;
<?php echo GetString('La suppression détruit définitivement les informations de cette entreprise, mais sans supprimer les contacts liés.'); ?>
<div id="deleteActionFormResult"></div>
</form>

<script type="text/javascript" charset="utf-8">
$("#deleteActionForm").submit(function () {
	confirmation = confirm('<?php echo GetString('Etes vous sûr de vouloir supprimer cette entreprise ?'); ?>');
	if (!confirmation)
		return false;

	document.getElementById("submit").disabled = true;
	$.post(
      '../prm_controllers/contact_controller.php?type=delete',
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
