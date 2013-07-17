<?php
function begin_form()
{
?>
<form action="/" id="currentForm">
<?php
}

function end_form($submitButtonText, $controller, $refresh_center_panel = false, $refresh_left_panel = false)
{
?>
<button data-dojo-type="dijit.form.Button" type="submit" name="submit" id="submit"><?php echo $submitButtonText; ?></button>
<div id="currentFormResult"></div>
</form>

<script type="text/javascript" charset="utf-8">
$("#currentForm").submit(function () {
	document.getElementById("submit").disabled = true;
    $.post(
      '<?php echo $controller; ?>',
      $(this).serialize(),
      function(response, status){
    	  document.getElementById("submit").disabled = false;
          if (status == 'success')
          {
              if (response.indexOf("<!-- ERROR -->") != 0)
              {

                  <?php
                  if ($refresh_left_panel)
                  {
                  ?>
                  RefreshLeftPanel();
                  <?php
				  }
                    	  
                  if ($refresh_center_panel)
                  {
                  ?>
                  RefreshCenterPanel();
                  <?php
				  }
				  else
				  {
                  ?>
            	  $("#currentFormResult").html(response);
                  <?php
				  }
				  ?>
              }
              else
              {
            	  $("#currentFormResult").html(response);
              }
          }
          else
          {
              $("#currentFormResult").html(status);
          }
      }
    );
    return false;   
});
</script>
<?php
}
?>
