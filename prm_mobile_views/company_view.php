<?php include 'mobile_view_top.php'; ?>
<script type="text/javascript" charset="utf-8">
</script>
</head>
<body>
<?php
if (isset($_GET['company_id']))
	$CompanyId = $_GET['company_id'];
?>
<div data-role="page" id="home">

<div data-role="header" data-position="inline">
<a href="index.php" data-icon="back">Home</a>
<h1>Company view</h1>
<div data-role="navbar">
<ul>
<li><a href="#home" class="ui-btn-active" data-icon="home">Info</a></li>
</ul>
</div>
</div>

<div data-role="content">
<?php
$result = GetCompanyResource($CompanyId);
$row = mysql_fetch_assoc($result);

$i = 0;
$fields_to_ignore = array("company_id", "user_id", "picture_file_id");
while ($i < mysql_num_fields($result))
{
	$meta = mysql_fetch_field($result, $i);
	if (!in_array($meta->name, $fields_to_ignore))
	{
		if ($row[$meta->name] != null && $row[$meta->name] != "0")
		{
			echo $company_fields[$meta->name].' : '.$row[$meta->name].'<br />';
		}
	}
	$i++;
}
?>
</div>
</body>
</html>