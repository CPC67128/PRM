<?php
include_once '../dal/dal_prm.php';

$id = -1;
if (isset($_POST['id']))
	$id = $_POST['id'];

$row = GetCompanyRow($id);

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
$resultat = GetCompanyAttributes($row["company_id"]);
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
  <span class="glyphicon glyphicon-trash" onclick="DeleteCompanyAttribute(<?= $ligneAttribute["company_id"] ?>, <?= $ligneAttribute["company_attribute_id"] ?>);"></span>
  </td>
  </tr>
  <?php
}
?>

</tbody>
</table>

<script type="text/javascript" charset="utf-8">
function DeleteCompanyAttribute(companyId, attributeId) {
	console.log("DeleteCompanyAttribute() called");

	var confirmation = confirm('Confirmer ?');
	if (confirmation) {
		$.post('../controllers/company_controller.php?type=remove_attribute&company_id='+companyId+'&company_attribute_id='+attributeId,
			{ },
			function(data, status){
				LoadCompanyAttributesDetail();
			});
	}
}
</script>