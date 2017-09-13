<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>
<table>
<tr>
<th>filename</th>
<th>original</th>
<th>exists</th>
<th>exists2</th>
</tr>
<?php
include 'database_use_start.php';

$result = $mysqli->query("select * from prm_file") or die('Erreur SQL ! '.$query.'<br />'.mysql_error());
$n = $result->num_rows;
for ($i = 0; $i < $n; $i++)
{
	$row = $result->fetch_assoc();
	$exists = file_exists (utf8_decode('../uploads/'.$row["filename"]));
	$exists2 = file_exists ('../uploads/'.$row["filename"]);
	if ($exists2 = 1)
		continue;
	?>
<tr>
<td>
<?= $row["filename"] ?>
</td>
<td>
<?= $row["original_filename"] ?>
</td>
<td>
<?= $exists ?>
</td>
<td>
<?= $exists2 ?>
</td>
</tr>
<?php
}

include 'database_use_stop.php';

?>
</table>
</body>
</html>