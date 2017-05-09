<?php
include 'form_management.php';
begin_form();
?>
<table>
<tr>
<td>Date</td>
<td><input type="text" name="new_note_date" value="<?php echo date("Y-m-d"); ?>" size=10 /></td>
</tr>
<tr>
<td>Note</td>
<td><textarea name="new_note" row="8" cols="70"></textarea></td>
</tr>
</table>
<input type="hidden" name="company_id" value="<?php echo $row["company_id"]; ?>">
<?php end_form('Ajouter', '../prm_controllers/company_controller.php?type=add_note', true); ?>

<br />

<table class="standardTable" id="notes">
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
  <span class="ui-icon ui-icon-trash" onclick="var confirmation = confirm('Supprimer ?'); if (confirmation) { dojo.xhrPost({url: '../prm_controllers/company_controller.php?type=remove_note&company_id=<?php echo $ligneNote["company_id"]; echo "&"; ?>note_id=<?php echo $ligneNote["note_id"]; ?>', load: function(data, ioArgs) { RefreshCenterPanel(); }}); }"></span>
  </td>
  </tr>
  <?php
}
?>
</tbody>
</table>