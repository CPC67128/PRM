<?php
include_once '../dal/dal_prm.php';
?>
<div id="centerPanelDynamic">
<?php
$type = '';
if (isset($_GET['type']))
	$type = $_GET['type'];

$id = -1;
if (isset($_GET['id']))
	$id = $_GET['id'];

$page = '';
if (isset($_GET['page']))
	$page = $_GET['page'];

$windowTitle = '';

// ====================================== CONTACT ====================================== 

// ----- existing record

if ($type == 'contact' && $id >= 0)
{
	if ($page == '')
		$page = 'identity';

	UpdateLastViewDate($id);
	$row = GetContactRow($id);
	if (isset($row["company_id"]))
	{
		$rowCompany = GetCompanyRow($row["company_id"]);
	}

	$windowTitle .= $row["first_name"].' '.$row["last_name"];
	
	function add_new_row_to_detail($description, $id, $size = 50)
	{
		global $row;
		global $rowCompany;
		global $detail;
		global $ligne;
		$value = '';
		if (isset($row[$id]))
			$value = $row[$id];
		$detail .= '<tr><td>';
		$detail .= $description;
		$detail .= '</td><td>';
		if ($id == 'company_name')
		{
			$detail .= '<input type="text" id="'.$id.'" name="'.$id.'" value="'.(isset($rowCompany["name"]) ? $rowCompany["name"] : '').'" size=50 />';
			if (isset($rowCompany["name"]))
			{
				$detail .= '</td></tr>';
				$detail .= '<tr><td>';
				$detail .= '</td><td>';
				$detail .= '<button data-dojo-type="dijit.form.Button" type="button" onclick="DisplayRecord(TYPE_COMPANY, '.$row["company_id"].');">Voir '.$rowCompany["name"].'</button>';
			}
		}
		else if ($id == 'next_action' || $id == "comment")
		{
			$detail .= '<textarea name="'.$id.'" cols=70 rows=6>'.$value.'</textarea>';
		}
		elseif ($id == 'last_contact')
		{
			$detail .= '<input type="text" name="'.$id.'" value="'.$value.'" size=50 />';
			$detail .= '<input type="button" value="Aujourd\'hui" onclick="document.location.href=\'../pc_controllers/contact_controller.php?type=last_contact&contact_id='.$ligne["contact_id"].'\'">';
		}
		elseif ($id == 'last_update')
		{
			$detail .= '<input type="text" name="'.$id.'" value="'.$value.'" size=50 />';
			$detail .= '<input type="button" value="Aujourd\'hui" onclick="document.location.href=\'../pc_controllers/contact_controller.php?type=last_update&contact_id='.$ligne["contact_id"].'\'">';
		}
		elseif ($id == 'regular_contact')
		{
			$detail .= '<input type="checkbox" name="'.$id.'" '.($value == 1 ? 'checked' : ''). ' />';
		}
		else
			$detail .= '<input type="text" name="'.$id.'" value="'.$value.'" size='.$size.' />';
		$detail .= '</td>';
		$detail .= '</tr>';
	}

	include 'center_panels/contact_'.$page.'.php';
	$windowTitle .= '/'.$pages['contact/'.$page];
}

// ----- record creation

else if ($type == 'contact' && $id == -1)
{
	$windowTitle .= "nouveau contact";

	include 'center_panels/contact_creation.php';
}

// ====================================== COMPANY ======================================

// ----- existing record

else if ($type == 'company' && $id >= 0)
{
	if ($page == '')
		$page = 'details';

	$row = GetCompanyRow($id);

	$windowTitle .= $row["name"];

	function add_new_row_to_detail($description, $id, $size = 50)
	{
		global $row;
		global $rowCompany;
		global $detail;
		global $ligne;
		$value = '';
		if (isset($row[$id]))
			$value = $row[$id];
		$detail .= '<tr><td>';
		$detail .= $description;
		$detail .= '</td><td>';
		if ($id == 'activities' || $id == "opening_hours")
		{
			$detail .= '<textarea name="'.$id.'" cols=50 rows=4>'.$value.'</textarea>';
		}
		else if ($id == 'recruitment')
		{
			$detail .= '<textarea name="'.$id.'" cols=70 rows=15>'.$value.'</textarea>';
		}
		else if ($id == 'next_action' || $id == "comment")
		{
			$detail .= '<textarea name="'.$id.'" cols=70 rows=6>'.$value.'</textarea>';
		}
		else
			$detail .= '<input type="text" name="'.$id.'" value="'.$value.'" size='.$size.' />';
		$detail .= '</td></tr>';
	}

	include 'center_panels/company_'.$page.'.php';
	$windowTitle .= '/'.$pages[$type.'/'.$page];
}

// ----- record creation

else if ($type == 'company' && $id == -1)
{
	$windowTitle .= "nouvelle entreprise";

	include 'center_panels/company_creation.php';
}

// ====================================== ATTRIBUTE ======================================

// ----- existing record

else if ($type == 'attribute' && $id >= 0)
{
	if ($page == '')
		$page = 'details';

	$row = GetAttributeRow($id);

	$windowTitle .= $row["attribute"];

	include 'center_panels/attribute_'.$page.'.php';
	$windowTitle .= '/'.$pages[$type.'/'.$page];
}

// ----- record creation

else if ($type == 'attribute' && $id == -1)
{
	$windowTitle .= "nouveau attribut";

	include 'center_panels/attribute_creation.php';
}

// ====================================== CONFIGURATION ======================================

else if ($type == 'configuration')
{
	$row = GetConfigurationRow();

	$windowTitle .= "configuration";

	include 'center_panels/configuration.php';
}

// ====================================== TOOLS ======================================

else if ($type == 'tools' && $page != '')
{
	$windowTitle .= "Outils";

	include 'center_panels/tools_'.$page.'.php';
	$windowTitle .= '/'.$pages[$type.'/'.$page];
}

else if ($type == 'tools')
{
	$windowTitle .= "Outils";

	include 'center_panels/blank.php';
}

// ====================================== DEFAULT ======================================

else
{
	$windowTitle .= "";

	include 'center_panels/default.php';
}

?>

<script type="text/javascript">
SetTitle('<?php echo $windowTitle; ?>');
</script>
</div>