<?php
include '../configuration/configuration.php';
?>
<!DOCTYPE HTML>
<html lang="fr">
<head>
<title>Gestionnaire de relations personnelles ou privées</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="Description" content="Gestionnaire de relations personnelles ou privées par Steve Fuchs : base de contacts, anniversaires, qualification des contacts, entreprises et recrutement, ...">
<link rel="shortcut icon" type="image/ico" href="handshake.ico" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" media="screen" />	
<link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/dojo/1.8.1/dijit/themes/claro/claro.css" media="screen" />
<link rel="stylesheet" type="text/css" href="prm.css" media="screen" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/dojo/1.8.1/dojo/dojo.js" data-dojo-config="parseOnLoad: true"></script>
<script type="text/javascript" src="prm.js"></script>
</head>

<body class="claro">
<div id="appLayout" class="demoLayout" data-dojo-type="dijit.layout.BorderContainer" data-dojo-props="design: 'headline'">

	<div class="headerPanel" data-dojo-type="dijit.layout.ContentPane" data-dojo-props="region: 'top'">
		<table class="headerTable">
		<tr>
		<td>
		<button data-dojo-type="dijit.form.Button" type="button" class="headerButton" onclick="ResetScreen();">Accueil</button>
		</td>
		<td><span class="ui-widget"><input id="search" title="Search..."/></span>
	    </td>
	    <td>
	    <span id="AddActions">
	    <button data-dojo-type="dijit.form.Button" type="button" class="headerButton" onclick="CreateRecord(TYPE_CONTACT);">+ contact</button>
	    <button data-dojo-type="dijit.form.Button" type="button" class="headerButton" onclick="CreateRecord(TYPE_COMPANY);">+ entreprise</button>
	    <button data-dojo-type="dijit.form.Button" type="button" class="headerButton" onclick="CreateRecord(TYPE_ATTRIBUTE);">+ attribut</button>
	    <button data-dojo-type="dijit.form.Button" type="button" class="headerButton" onclick="DisplayRecord(TYPE_CONFIGURATION, ID_UNDEFINED);">Configuration</button>
	    <button data-dojo-type="dijit.form.Button" type="button" class="headerButton" onclick="DisplayRecord(TYPE_TOOLS, ID_UNDEFINED);">Outils</button>
	    </span>
	    </td>
	    </tr>
	    </table>
   	</div>

	<div id="centerPanel" class="centerPanel" data-dojo-type="dijit.layout.ContentPane" data-dojo-props="region: 'center'"></div>

	<div id="leftPanel" class="edgePanel" data-dojo-type="dijit.layout.ContentPane" data-dojo-props="region: 'left', splitter: true"></div>

	<div id="bottomPanel" data-dojo-type="dijit.layout.ContentPane" data-dojo-props="region: 'bottom'"></div>
</div>
</body>
</html>