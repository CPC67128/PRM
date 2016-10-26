<?php
include_once '../dal/dal_prm.php';

$searchString = '';
if (isset($_GET['search_string']))
	$searchString = $_GET['search_string'];

// CONTACTS

$aColumns = array('contact_id', 'first_name', 'last_name');
$aColumnsForSearch = array('personal_city', 'personal_phone', 'personal_mobile_phone', 'professional_phone', 'professional_mobile_phone', 'vehicle_license_plate');

$sIndexColumn = "contact_id";

$sTable = $DB_TABLE_PREFIX."prm_contact";

$sLimit = "LIMIT 10";

$sWhere = "";
if ($searchString != "" )
{
	$sWhere = "WHERE (";
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		$sWhere .= $aColumns[$i]." LIKE '%".String2StringForSprintfQueryBuilder($searchString)."%' OR ";
	}
	for ( $i=0 ; $i<count($aColumnsForSearch) ; $i++ )
	{
		$sWhere .= $aColumnsForSearch[$i]." LIKE '%".String2StringForSprintfQueryBuilder($searchString)."%' OR ";
	}
	$sWhere = substr_replace( $sWhere, "", -3 );
	$sWhere .= ')';
}

$requete_cnf = "select view_archived from ".$DB_TABLE_PREFIX."prm_configuration";
$resultat_cnf = ExecuteQuery_toremove($requete_cnf);
$ligne_cnf = mysqli_fetch_assoc($resultat_cnf);
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

$contacts = array();

$type = "contact";

/*
$row = array();
$row['id'] = -1;
$row['type'] = $type;
$row['fullName'] = "Ajouter un contact";
$contacts[]= $row;
*/

while ( $aRow = mysqli_fetch_array( $rResult ) )
{
	$row = array();
	$id = -1;
	$fullName = "";
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( $aColumns[$i] == "contact_id" )
			$id = $aRow[ $aColumns[$i] ];
		elseif ( $aColumns[$i] == "first_name" )
			$fullName .= $aRow[ $aColumns[$i] ];
		elseif ( $aColumns[$i] == "last_name" )
			$fullName .= " ".$aRow[ $aColumns[$i] ];
	}
	$row['id'] = $id;
	$row['type'] = $type;
	$row['fullName'] = $fullName.", Contact";
	$contacts[]= $row;
}

// ENTREPRISE

$aColumns = array('company_id', 'name');
$sIndexColumn = "company_id";
$sTable = $DB_TABLE_PREFIX."prm_company";
$sLimit = "LIMIT 5";

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
$ligne_cnf = mysqli_fetch_assoc($resultat_cnf);
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
while ( $aRow = mysqli_fetch_array( $rResult ) )
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
	$row['fullName'] = $fullName.", Entreprise";
	$companies[]= $row;
}

// Attributs

$aColumns = array('attribute_id', 'attribute', 'for_contact', 'for_company');
$sIndexColumn = "attribute_id";
$sTable = $DB_TABLE_PREFIX."prm_attribute";
$sLimit = "LIMIT 5";

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

/*
 * SQL queries
* Get data to display
*/
$sQuery = "
	SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
	FROM   $sTable
$sWhere
$sLimit
";
$rResult = ExecuteQuery_toremove($sQuery);

$attributes = array();
$type = 'attribute';
while ( $aRow = mysqli_fetch_array( $rResult ) )
{
	$row = array();
	$id = -1;
	$fullName = "";
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( $aColumns[$i] == "attribute_id" )
			$id = $aRow[ $aColumns[$i] ];
		elseif ( $aColumns[$i] == "attribute" )
			$fullName .= $aRow[ $aColumns[$i] ];
	}
	$row['id'] = $id;
	$row['fullName'] = $fullName.", Attribut";
	$row['type'] = $type;
	$attributes[]= $row;
}

/*
 * Output
 */

$output = array(
	"identifier" => "id",
	"label" => "fullName",
	"items" => array()
);

for ($i=0 ; $i < count($contacts) ; $i++ )
{
	$output['items'][] = $contacts[$i];
}

for ($i=0 ; $i < count($companies) ; $i++ )
{
	$output['items'][] = $companies[$i];
}

for ($i=0 ; $i < count($attributes) ; $i++ )
{
	$output['items'][] = $attributes[$i];
}

print json_encode($output);
?>
