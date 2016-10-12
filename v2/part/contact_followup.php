<?php BeginForm(); ?>

<div class="form-group">
	<label for="new_note_date">Date</label>
	<input type="text" class="form-control" id="new_note_date" value="<?php echo date("Y-m-d"); ?>" autocomplete="off" >
</div>

<div class="form-group">
	<label for="new_note">Note</label>
	<textarea class="form-control" id="new_note" rows="3"></textarea>
</div>



<?php EndForm(); ?>



<br />

<table class="table " id="notes">
<thead>
<tr>
<th>Date</th>
<th>Note</th>
<th></th>
</tr>
<tbody>

<?php
$resultat = GetNotesFromContact($row["contact_id"]);
$n = mysqli_num_rows($resultat);

for ($i = 0; $i < $n; $i++)
{
  $ligneNote = mysqli_fetch_assoc($resultat);
  ?>
  <tr>
  <td>
  <?php echo $ligneNote["creation_date"]; ?>
  </td>
  <td>
  <?php echo nl2br($ligneNote["comment"]); ?>
  </td>
  <td>
  <span class="glyphicon glyphicon-trash" onclick="var confirmation = confirm('Supprimer ?'); if (confirmation) { dojo.xhrPost({url: '../prm_controllers/contact_controller.php?type=remove_note&contact_id=<?php echo $ligneNote["contact_id"]; echo "&"; ?>note_id=<?php echo $ligneNote["note_id"]; ?>', load: function(data, ioArgs) { RefreshCenterPanel(); }}); }"></span>
  </td>
  </tr>
  <?php
}
?>
</tbody>
</table>