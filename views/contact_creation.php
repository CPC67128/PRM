<form action="/" id="recordCreationForm">
<table>
<tbody>
<tr>
<td>
Sexe
</td>
<td>
<select name="gender">
<option value="M">M</option>
<option value="F">F</option>
</select>
</td>
</tr>
<tr>
<td>
Prénom
</td>
<td>
<input type="text" name="first_name" size=30 />
</td>
</tr>
<tr>
<td>
Nom
</td>
<td>
<input type="text" name="last_name" size=30 />
</td>
</tr>
</tbody>
</table>
<button data-dojo-type="dijit.form.Button" type="submit" name="submit">Créer</button>
<div id="recordCreationFormResult"></div>
</form>


<script type="text/javascript" charset="utf-8">
$("#recordCreationForm").submit(function () {    
    $.post(
      '../controllers/contact_controller.php?type=insert',
      $(this).serialize(),
      function(response, status){
          if (status == 'success')
          {
              if (response.indexOf("<!-- ERROR -->") != 0)
              {
                  $newRecordId = response;
                  if ($newRecordId > 0)
            	  	DisplayRecord(TYPE_CONTACT, $newRecordId);
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