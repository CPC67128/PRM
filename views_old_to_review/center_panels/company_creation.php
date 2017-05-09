<form action="/" id="recordCreationForm">
<table>
<tbody>
<tr>
<td>Nom</td>
<td><input type="text" name="name" size=30 /></td>
</tr>
</tbody>
</table>
<button data-dojo-type="dijit.form.Button" type="submit" name="submit" value="Créer">Créer</button>
<div id="recordCreationFormResult"></div>
</form>

<script type="text/javascript" charset="utf-8">
$("#recordCreationForm").submit(function () {    
    $.post(
      '../prm_controllers/company_controller.php?type=insert',
      $(this).serialize(),
      function(response, status){
          if (status == 'success')
          {
              if (response.indexOf("<!-- ERROR -->") != 0)
              {
                  $newRecordId = response;
                  if ($newRecordId > 0)
            	  	DisplayRecord(TYPE_COMPANY, $newRecordId);
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