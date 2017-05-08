<?php
include_once '../dal/dal_prm.php';

$id = -1;
if (isset($_POST['id']))
	$id = $_POST['id'];

$row = GetCompanyRow($id);

?>

<table class="table" id="notes">
<thead>
<tr>
<th>Date</th>
<th>Note</th>
<th></th>
</tr>
<tbody>

<?php
$resultat = GetNotesFromCompany($row["company_id"]);
$n = $resultat->num_rows;

for ($i = 0; $i < $n; $i++)
{
  $ligneNote = $resultat->fetch_assoc();
  ?>
  <tr>
  <td>
  <?php echo $ligneNote["creation_date"]; ?>
  </td>
  <td>
  <?php echo nl2br($ligneNote["comment"]); ?>
  </td>
  <td>
  <span class="glyphicon glyphicon-trash" onclick="DeleteCompanyNote(<?= $ligneNote["company_id"] ?>, <?= $ligneNote["note_id"] ?>);"></span>
  </td>
  </tr>
  <?php
}
?>
</tbody>
</table>

<script type="text/javascript" charset="utf-8">
function DeleteCompanyNote(contactId, noteId) {
	console.log("DeleteCompanyNote() called");

	var confirmation = confirm('Confirmer ?');
	if (confirmation) {
		$.post('../prm_controllers/company_controller.php?type=remove_note&company_id='+contactId+'&note_id='+noteId,
			{ },
			function(data, status){
				LoadCompanyFollowUpDetail();
			});
	}
}
</script>