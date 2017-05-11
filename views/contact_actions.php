<form action="/" id="archiveActionForm">
<input type="hidden" name="contact_id" value="<?php echo $row["contact_id"] ?>">
<button data-dojo-type="dijit.form.Button" type="submit" name="submit" id="submit">Archiver</button>
&nbsp;
L'archivage permet de cacher la fiche de la visualisation par défaut
<div id="archiveActionFormResult"></div>
</form>

<script type="text/javascript" charset="utf-8">
$("#archiveActionForm").submit(function () {
	confirmation = confirm('Etes vous sûr de vouloir archiver ce contact ?');
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
<input type="hidden" name="contact_id" value="<?php echo $row["contact_id"] ?>">
<button data-dojo-type="dijit.form.Button" type="submit" name="submit" id="submit">Supprimer</button>
&nbsp;
La suppression détruit définitivement les informations de ce contact.
<div id="deleteActionFormResult"></div>
</form>

<script type="text/javascript" charset="utf-8">
$("#deleteActionForm").submit(function () {
	confirmation = confirm('Etes vous sûr de vouloir supprimer ce contact ?');
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

<br />

<div class="leftLink" onclick="window.open('http://www.google.com/search?q=<?php echo GetContactGoogleItSearchString($row["contact_id"]); ?>','Google it!','toolbar=1,scrollbars=1');">Google it!</div>