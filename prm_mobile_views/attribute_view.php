<?php include 'mobile_view_top.php'; ?>
<script type="text/javascript" charset="utf-8">
</script>
</head>
<body>
<?php
if (isset($_GET['attribute_id']))
	$AttributeId = $_GET['attribute_id'];
?>
<div data-role="page" id="home">

<div data-role="header" data-position="inline">
<a href="index.php" data-icon="back">Home</a>
<h1>Attribute view</h1>
<div data-role="navbar">
<ul>
<li><a href="#home" class="ui-btn-active" data-icon="home">Info</a></li>
</ul>
</div>
</div>

<div data-role="content">
<?php
$result = GetAttributeResource($AttributeId);
$row = mysql_fetch_assoc($result);

$i = 0;
$fields_to_ignore = array("attribute_id");
while ($i < mysql_num_fields($result))
{
	$meta = mysql_fetch_field($result, $i);
	if (!in_array($meta->name, $fields_to_ignore))
	{
		if ($row[$meta->name] != null && $row[$meta->name] != "0")
		{
			if ($meta->name == 'for_company')
			{
				if ($row[$meta->name] == 1)
					echo $attribute_fields[$meta->name].'<br />';
			}
			else if ($meta->name == 'for_contact')
			{
				if ($row[$meta->name] == 1)
					echo $attribute_fields[$meta->name].'<br />';
			}
			else
			{
				echo $attribute_fields[$meta->name].' : '.$row[$meta->name].'<br />';
			}
		}
	}
	$i++;
}
?>
</div>
</body>
</html>