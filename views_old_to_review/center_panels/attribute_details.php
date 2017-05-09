<form action="/" id="updateForm">
<input type="hidden" name="attribute_id" value="<?php echo $row["attribute_id"]; ?>">
<table>
<tbody>
<tr>
<td><?php echo GetString('Attribut'); ?></td>
<td><input type="text" name="attribute" size=30 value="<?php echo $row["attribute"]; ?>" /></td>
</tr>
<tr>
<td><?php echo GetString('Attribut entreprise'); ?></td>
<td><input type=checkbox name="for_company" <?php echo (strcasecmp($row["for_company"], '1') == 0 ? 'checked' : ''); ?>></td>
</tr>
<tr>
<td><?php echo GetString('Attribut contact'); ?></td>
<td><input type=checkbox name="for_contact" <?php echo (strcasecmp($row["for_contact"], '1') == 0 ? 'checked' : ''); ?>></td>
</tbody>
</table>
<button data-dojo-type="dijit.form.Button" type="submit" name="submit" id="submit">Mettre à jour</button>
<div id="updateFormResult"></div>
</form>

<script type="text/javascript" charset="utf-8">
$("#updateForm").submit(function () {
	document.getElementById("submit").disabled = true;
    $.post(
      '../prm_controllers/attribute_controller.php?type=update',
      $(this).serialize(),
      function(response, status){
    	  document.getElementById("submit").disabled = false;
          if (status == 'success')
          {
              if (response.indexOf("<!-- ERROR -->") != 0)
              {
              }
              else
              {
            	  $("#updateFormResult").html(response);
              }
          }
          else
          {
              $("#updateFormResult").html(status);
          }
      }
    );
    return false;   
});
</script>
