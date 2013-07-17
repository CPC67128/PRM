<?php
include 'form_management.php';
begin_form();
?>
<form method="post" name="form_relation_to_contact" action="">
<table>
<tr>
<td>Ce contact a la relation</td>
<td>
<select name="relation_type_id" >
<?php
$resultRelationTypes = GetRelationTypes();
while ($rowRelationType = mysql_fetch_assoc($resultRelationTypes))
{
  echo '<option value='.$rowRelationType["relation_type_id"].'>'.$rowRelationType["description_left_to_right"].'</option>';
}
?>
</select>
</td>
<td>avec ce contact</td>
<td><input type="text" id="right_contact" name="right_contact" size=20 /></td>
<td><input type="hidden" name="contact_id" value="<?php echo $row["contact_id"]; ?>"><input type="hidden" name="right_contact_id" id="right_contact_id" /><input type="hidden" name="left_contact_id" value="<?php echo $row["contact_id"]; ?>" /></td>
</tr>
</table>
<?php end_form('Ajouter', '../prm_controllers/contact_controller.php?type=add_relation_to_contact', true); ?>

<br />

<table class="standardTable" id="relations_contact_to_contact">
<thead>
<tr>
<th>Contact</th>
<th>Relation</th>
<th>Contact</th>
<th></th>
</tr>
<tbody>

<?php
$resultat = GetRelationsFromContactToContact($row["contact_id"]);
$n = mysql_num_rows($resultat);

for ($i = 0; $i < $n; $i++)
{
  $ligneRelation = mysql_fetch_assoc($resultat);
  ?>

  <tr class="gradeC">
  <td>
<?php
$contactDetail = GetContactShortDescription($ligneRelation["left_contact_id"]);
if ($row["contact_id"] == $ligneRelation["left_contact_id"])
	echo $contactDetail;
else
{
?>
<span class="centerLink" onclick="DisplayRecord(TYPE_CONTACT, <?php echo $ligneRelation["left_contact_id"]; ?>);"><?php echo $contactDetail; ?></span>
<?php
}
?>
  </td>
  <td>
  <?php
if ($row["contact_id"] == $ligneRelation["left_contact_id"])
	$relation = GetRelationTypeLeftToRightDescription($ligneRelation["relation_type_id"]);
else
	$relation = GetRelationTypeRightToLeftDescription($ligneRelation["relation_type_id"]);
echo $relation;
  ?>
  </td>
  <td>
<?php
$contactDetail = GetContactShortDescription($ligneRelation["right_contact_id"]);
if ($row["contact_id"] == $ligneRelation["right_contact_id"])
	echo $contactDetail;
else
{
?>
<span class="centerLink" onclick="DisplayRecord(TYPE_CONTACT, <?php echo $ligneRelation["right_contact_id"]; ?>);"><?php echo $contactDetail; ?></span>
<?php
}
?>
  </td>
  <td>
  <span class="ui-icon ui-icon-trash" onclick="var confirmation = confirm('Supprimer ?'); if (confirmation) { dojo.xhrPost({url: '../prm_controllers/contact_controller.php?type=remove_relation_to_contact&contact_id=<?php echo $row["contact_id"]; echo "&"; ?>relation_contact_to_contact_id=<?php echo $ligneRelation["relation_contact_to_contact_id"]; ?>', load: function(data, ioArgs) { RefreshCenterPanel(); }}); }"></span>
  </td>
  </tr>
  <?php
}
?>
</tbody>
</table>
</form>

<script type="text/javascript">
var currentRightContactFullName = '';

$(function() {
	$("#right_contact").autocomplete({
		source: function( request, response ) {
			$.ajax({
				url: "../dal/pc_search_contact.php",
				dataType: "json",
				data: {
					search_string: request.term,
					current_contact_id: <?php echo $row['contact_id']; ?>
				},
				success: function( data ) {
					response( $.map( data.items, function( item ) {
						return {
							label: item.fullName,
							id: item.id
						}
					}));
				}
			});
		},
		minLength: 2,
		select: function( event, ui ) {
			$('input[name=right_contact_id]').val(ui.item.id);
			currentRightContactFullName = ui.item.label;
		}
	});
});

$('#right_contact').keyup(function(event) {
	if ($('#right_contact').val() != currentRightContactFullName) {
		currentRightContactFullName = '';
		$('input[name=right_contact_id]').val(-1);
	}
});
</script>