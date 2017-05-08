<?php include_once '../dal/dal_prm.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>PRM</title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<link rel="shortcut icon" type="image/ico" href="handshake.ico" />
<link href="prm.css" rel="stylesheet">
<style>
.panel > .panel-heading {
    //background-color: #ff7777;
}
</style>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="index.js"></script>
</head>
<body>

<!-- 
<nav class="navbar  navbar-default navbar-fixed-top">
  <div class="container-fluid">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="#" onclick="Reset();">PRM</a>
	  <form class="navbar-form pull-left col-sm-3 col-md-3 ">
		<input type="text" id="searchArea" class="form-control" placeholder="Search...">
	  </form>
	</div>
	<div id="navbar" class="navbar-collapse collapse">
	  <ul class="nav navbar-nav navbar-right">
		<li><a href="#">Dashboard</a></li>
		<li><a href="#">Settings</a></li>
		<li><a href="#">Profile</a></li>
		<li><a href="#">Help</a></li>
	  </ul>
	</div>
  </div>
</nav>

-->

<div class="navbar navbar-inverse navbar-fixed-top">
   <div class="container">
      <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand hidden-xs" href="#">PRM</a>
         <a class="navbar-brand visible-xs" href="#"></a>
         <form class="navbar-form pull-left" role="search">
            <div class="input-group">
               <input type="text" id="searchArea" class="form-control" placeholder="Search">
               <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
               </div>
            </div>
         </form>
      </div>
      <div class="navbar-collapse collapse">
         <ul class="nav navbar-nav navbar-right">
            <li><a href="#">+ Contact</a></li>
            <li><a href="#about">+ Entreprise</a></li>
            <li><a href="#contact">+ Attribut</a></li>
         </ul>
      </div>
      <!--/.navbar-collapse -->
   </div>
</div>

<script>
$("#searchArea").focus(function() { this.select(); });

$("#searchArea").keyup(function(e) {
	var search = $("#searchArea").val();
	console.log(search);
	//$("#searchResult").html(search);

	$.post("search.php",
		    {
				search_string: search
		    },
		    function(data, status){
		    	$("#searchResult").html("Data: " + data + "\nStatus: " + status);
		    });
});

</script>


<div id="searchResult" class="container" />


</body>
</html>
