<?php include_once '../dal/dal_prm.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/handshake.ico">

    <title>PRM</title>

    <link rel="stylesheet" href="../3rd_party_jqueryui/jquery-ui.min.css">

    <!-- Bootstrap core CSS -->
    <link href="../3rd_party_bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="index.css" rel="stylesheet">

	<link rel="stylesheet" href="../3rd_party_font-awesome/css/font-awesome.min.css">    
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../3rd_party_jquery/jquery-3.2.1.min.js"></script>
    <script src="../3rd_party_jqueryui/jquery-ui.min.js"></script>
    
    <script src="../3rd_party_tether/dist/js/tether.min.js"></script>

    <script src="../3rd_party_bootstrap/js/bootstrap.min.js"></script>

    <script src="index.js"></script>
    
  </head>

  <body>
    <nav class="navbar navbar-toggleable-sm navbar-inverse fixed-top bg-inverse">
      <button class="navbar-toggler navbar-toggler-right hidden-md-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#" onclick="Reset(); event.preventDefault();">PRM</a>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="DisplayRecord(TYPE_CONTACT, -1); event.preventDefault();">+ Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="DisplayRecord(TYPE_COMPANY, -1); event.preventDefault();">+ Entreprise</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="DisplayRecord(TYPE_ATTRIBUTE, -1); event.preventDefault();">+ Attribut</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="DisplayRecord(TYPE_TOOLS, -1); event.preventDefault();">Outils</a>
          </li>
                  </ul>
        <form class="form-inline mt-2 mt-md-0" id="formSearch">
          <input class="form-control mr-sm-2" id="searchText" type="text" placeholder="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

<script type="text/javascript" charset="utf-8">
$("#formSearch").submit(function () {
	var search = $("#searchText").val();
	console.log("Search submited for "+search);

	$.post(
		"search.php",
	    {
			search_string: search
	    },
		function(response, status) {
	    	$("#searchResult").html(response);
	    });

	return false;   
});
</script>

<div id="searchResult" class="container" />

  </body>
</html>
