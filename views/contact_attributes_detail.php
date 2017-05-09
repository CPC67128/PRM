<?php
include_once '../dal/dal_prm.php';

$id = -1;
if (isset($_POST['id']))
	$id = $_POST['id'];

$row = GetContactRow($id);

?>

<table class="table" id="attributes">
<thead>
<tr>
<th>Attribut</th>
<th>Date</th>
<th></th>
</tr>
<tbody>

<?php
$resultat = GetContactAttributes($row["contact_id"]);
$n = $resultat->num_rows;
for ($i = 0; $i < $n; $i++)
{
  $ligneAttribute = $resultat->fetch_assoc();
  ?>

  <tr>
  <td>
  <?php echo $ligneAttribute["attribute"]; ?>
  </td>
  <td>
  <?php echo $ligneAttribute["creation_date"]; ?>
  </td>
  <td>
  <span class="glyphicon glyphicon-trash" onclick="DeleteContactAttribute(<?= $ligneAttribute["contact_id"] ?>, <?= $ligneAttribute["contact_attribute_id"] ?>);"></span>
  </td>
  </tr>
  <?php
}
?>

</tbody>
</table>

<script type="text/javascript" charset="utf-8">
function DeleteContactAttribute(contactId, attributeId) {
	console.log("DeleteContactAttribute() called");

	var confirmation = confirm('Confirmer ?');
	if (confirmation) {
		$.post('../controllers/contact_controller.php?type=remove_attribute&contact_id='+contactId+'&contact_attribute_id='+attributeId,
			{ },
			function(data, status){
				LoadContactAttributesDetail();
			});
	}
}
</script>
