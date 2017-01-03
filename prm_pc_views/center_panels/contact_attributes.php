<?php
include 'form_management.php';
begin_form();
?>
<table>
<tr>
<td>Date</td>
<td><input type="text" name="set_date" value="<?php echo date("Y-m-d"); ?>" size=10 /></td>
</tr>
<tr>
<td>Attribut</td>
<td><input type="text" id="new_attribute" name="new_attribute" value="" size=50 /></td>
</tr>
</table>
<input type="hidden" name="contact_id" value="<?php echo $row["contact_id"]; ?>">
<?php end_form('Ajouter', '../prm_controllers/contact_controller.php?type=set_attribute', true); ?>

<br />

<table class="standardTable" id="attributes">
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
  <span class="ui-icon ui-icon-trash" onclick="var confirmation = confirm('Supprimer ?'); if (confirmation) { dojo.xhrPost({url: '../prm_controllers/contact_controller.php?type=remove_attribute&contact_id=<?php echo $ligneAttribute["contact_id"]; ?>&contact_attribute_id=<?php echo $ligneAttribute["contact_attribute_id"]; ?>', load: function(data, ioArgs) { RefreshCenterPanel(); }}); }"></span>
  </td>
  </tr>
  <?php
}
?>

</tbody>
</table>

<script type="text/javascript">
var availableTagsAttributes = [
	<?php
		$resultat = GetAllAttributesForContact();
		$first_record = true;
		while ($ligne = $resultat->fetch_assoc())
		{
		  if (!$first_record)
		  	echo ',';
		  echo '"'.str_replace('"','\"', $ligne["attribute"]).'"';
		  $first_record = false;
		}
	?>
];

$( "#new_attribute" ).autocomplete({
	source: availableTagsAttributes
});

$("#new_attribute").focus(function () {
	$("#new_attribute").select();
});
</script>