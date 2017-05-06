<?php
include_once '../dal/dal_prm.php';

$id = -1;
if (isset($_POST['id']))
	$id = $_POST['id'];

$row = GetContactRow($id);

?>

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
  <span class="glyphicon glyphicon-trash" onclick="DeleteContactNote(<?= $ligneNote["contact_id"] ?>, <?= $ligneNote["note_id"] ?>);"></span>
  </td>
  </tr>
  <?php
}
?>
</tbody>
</table>

<script type="text/javascript" charset="utf-8">
function DeleteContactNote(contactId, noteId) {
	console.log("DeleteContactNote() called");

	var confirmation = confirm('Confirmer ?');
	if (confirmation) {
		$.post('../prm_controllers/contact_controller.php?type=remove_note&contact_id='+contactId+'&note_id='+noteId,
			{ },
			function(data, status){
				LoadContactFollowUpDetail();
			});
	}
}
</script>
