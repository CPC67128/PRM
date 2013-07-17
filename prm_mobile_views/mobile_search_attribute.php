<?php
include_once '../security/security_manager.php';
include_once '../dal/dal_prm.php';

$name = '%';
if (isset($_POST['name']))
	$name = '%'.$_POST['name'].'%';

$query = "select attribute_id, attribute from ".$DB_TABLE_PREFIX."sf_prm_attribute ";
$query .= "where (attribute like '".$name."') ";
$query .= "and user_id = ".USER_ID." ";
$query .= "limit 0, 10 ";
$result = ExecuteQuery_toremove($query);

$rows = array();
while ($r = mysql_fetch_assoc($result))
{
    $rows[] = $r;
}

echo json_encode($rows);

?>