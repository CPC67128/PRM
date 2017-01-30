<?php
include_once '../dal/dal_prm.php';

$searchString = '';
if (isset($_POST['search_string']))
	$searchString = $_POST['search_string'];

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
	$row['fullName'] = $fullName;
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

?>

<ul class="list-group" id="contact-list">
<?php

for ($i=0 ; $i < count($contacts) && $i < 10 ; $i++ )
{
	$picture_file_id = contact_GetContactPictureFileId($contacts[$i]['id']);
	$row = GetContactRow($contacts[$i]['id']);

	if ($picture_file_id >= 0)
		$pictureUrl = "download.php?file_id=".$picture_file_id;
	else
		$pictureUrl = "avatar-blank.jpg";
	$pictureUrl = "avatar-blank.jpg";
	
?>
<li class="list-group-item">
    <div class="col-xs-4 col-sm-3 col-ld-1">
        <img src="<?= $pictureUrl ?>" class="img-responsive img-circle img-limit" />
    </div>
    <div class="col-xs-8">
        <span class="name"><?= $row['first_name'] ?> <?= $row['last_name'] ?></span><br/>
        <button type="button" class="btn btn-primary" onclick="DisplayRecord(TYPE_CONTACT, <?= $contacts[$i]['id'] ?>);">Modifier</button>
	</div>
    <div class="col-xs-12 col-sm-9 col-ld-11">
        <span class="glyphicon glyphicon-map-marker text-muted c-info" data-toggle="tooltip" title="5842 Hillcrest Rd"></span>
        <span class="visible-xs"> <span class="text-muted">5842 Hillcrest Rd</span><br/></span>
        <span class="glyphicon glyphicon-earphone text-muted c-info" data-toggle="tooltip" title="(870) 288-4149"></span>
        <span class="visible-xs"> <span class="text-muted">(870) 288-4149</span><br/></span>
        <span class="fa fa-comments text-muted c-info" data-toggle="tooltip" title="scott.stevens@example.com"></span>
        <span class="visible-xs"> <span class="text-muted">scott.stevens@example.com</span><br/></span>
    </div>
    <div class="clearfix"></div>
</li>
<?php
}

?>
</ul>