<form action="/" id="recordCreationForm">
<table>
<tbody>
<tr>
<td>Attribut</td>
<td><input type="text" name="attribute" size=30 /></td>
</tr>
<tr>
<td>Attribut entreprise</td>
<td><input type=checkbox name="for_company"></td>
</tr>
<tr>
<td>Attribut contact</td>
<td><input type=checkbox name="for_contact"></td>
</tbody>
</table>
<button data-dojo-type="dijit.form.Button" type="submit" name="submit" id="submit" value="Créer">Créer</button>
<div id="recordCreationFormResult"></div>
</form>

<script type="text/javascript" charset="utf-8">
$("#recordCreationForm").submit(function () {
	document.getElementById("submit").disabled = true;
    $.post(
      '../prm_controllers/attribute_controller.php?type=insert',
      $(this).serialize(),
      function(response, status){
    	  document.getElementById("submit").disabled = false;
          if (status == 'success')
          {
              if (response.indexOf("<!-- ERROR -->") != 0)
              {
                  $newRecordId = response;
                  if ($newRecordId > 0)
            	  	DisplayRecord(TYPE_ATTRIBUTE, $newRecordId);
                  else
                      ResetScreen();
              }
              else
              {
            	  $("#recordCreationFormResult").html(response);
              }
          }
          else
          {
              $("#recordCreationFormResult").html(status);
          }
      }
    );
    return false;   
});
</script>