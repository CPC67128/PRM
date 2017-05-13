<?php
include_once '../dal/dal_prm.php';

$searchString = '';
if (isset($_GET['search_string']))
	$searchString = $_GET['search_string'];

include_once '../dal/database_use_start.php';
// ENTREPRISE

$aColumns = array('company_id', 'name');
$sIndexColumn = "company_id";
$sTable = $DB_TABLE_PREFIX."prm_company";
$sLimit = "LIMIT 20";

$sWhere = "";
if ($searchString != "" )
{
	$sWhere = "WHERE (";
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		$sWhere .= $aColumns[$i]." LIKE '%".String2StringForSprintfQueryBuilder($searchString)."%' OR ";
	}
	$sWhere = substr_replace( $sWhere, "", -3 );
	$sWhere .= ')';
}

$requete_cnf = "select view_archived from ".$DB_TABLE_PREFIX."prm_configuration";
$resultat_cnf = ExecuteQuery_toremove($requete_cnf);
$ligne_cnf = $resultat_cnf->fetch_assoc();
if (!$ligne_cnf["view_archived"])
{
	if ( $sWhere == "" )
	{
		$sWhere = "WHERE ";
	}
	else
	{
		$sWhere .= " AND ";
	}
	$sWhere .= 'ifnull(archived, 0) != 1';
}

$sQuery = "
	SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
	FROM   $sTable
	$sWhere
	$sLimit
";
$rResult = ExecuteQuery_toremove($sQuery);

$companies = array();
while ( $aRow = $rResult->fetch_array() )
{
	$row = array();
	$id = -1;
	$fullName = "";
	$type = "company";
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( $aColumns[$i] == "company_id" )
			$id = $aRow[ $aColumns[$i] ];
		elseif ( $aColumns[$i] == "name" )
			$fullName .= $aRow[ $aColumns[$i] ];
	}
	$row['id'] = $id;
	$row['type'] = $type;
	$row['fullName'] = $fullName;
	$companies[]= $row;
}

/*
 * Output
 */

$output = array(
	"identifier" => "id",
	"label" => "fullName",
	"items" => array()
);

for ($i=0 ; $i < count($companies) ; $i++ )
{
	$output['items'][] = $companies[$i];
}

echo json_encode( $output );
?>
