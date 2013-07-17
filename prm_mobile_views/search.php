<?php include 'mobile_view_top.php'; ?>
</head>
<body>

<!-- --------------- Search page --------------- -->

<div data-role="page" id="search">
<script type="text/javascript" charset="utf-8">

var topic = '<?php echo $_GET["topic"]; ?>';

function create_list_display(data)
{
	var liste = '<ul data-role="listview" data-theme="g">';
	for (var i = 0, il = data.length; i < il; i++)
	{
		if (topic == 'contact')
		{
			liste += '<li><a rel=external href="contact_view.php?contact_id=' + data[i]['contact_id'] + '">' + data[i]['first_name'] + ' ' + data[i]['last_name'] + '</a></li>';
		}
		else if (topic == 'company')
		{
			liste += '<li><a rel=external href="company_view.php?company_id=' + data[i]['company_id'] + '">' + data[i]['name'] + '</a></li>';
		}
		else if (topic == 'attribute')
		{
			liste += '<li><a rel=external href="attribute_view.php?attribute_id=' + data[i]['attribute_id'] + '">' + data[i]['attribute'] + '</a></li>';
		}
	}
	liste += '</ul>';
	return liste;
}

$(function() {

    $("#search").live('keyup',function() {
        value=$(this).val();
        username_length = value.length;
        if (username_length >= 1)
        {
			$("#result").html("<b>Searching...</b>");

			if (topic == 'contact')
				var data_processor = "mobile_search_contact.php";
			else if (topic == 'company')
				data_processor = "mobile_search_company.php";
			else if (topic = 'attribute')
				data_processor = "mobile_search_attribute.php";
            $.post(data_processor, { name: value },  
		    function success(data)
		    {
    		    if (data.length > 0)
    		    {
    		    	var liste = create_list_display(data);
					$("#result").html(liste);
					$("#result").find("ul").listview();
    		    }
    		    else
    		    {
    		    	$("#result").html('Aucun enregistrement trouvé');
    		    }
		    },"json");
		}
        else
        {
        	$("#result").html('');
        }
    });
});
</script>

<div data-role="header">
<h1>Search</h1>
</div>

<div data-role="content">
<div data-role="fieldcontain">
    <input type=search id="search" />
</div>
<div id="result" />
</div>

</div>

</body>
</html>