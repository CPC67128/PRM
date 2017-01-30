var TYPE_UNDEFINED = "";
var TYPE_CONTACT = "contact";
var TYPE_COMPANY = "company";
var TYPE_ATTRIBUTE = "attribute";
var TYPE_CONFIGURATION = "configuration";
var TYPE_TOOLS = "tools";

var PAGE_UNDEFINED = '';

var ID_UNDEFINED = -1

function Context(type, id, page) {
	this.type = type;
	this.id = id;
	this.page = page;
}

var currentContext = new Context(TYPE_UNDEFINED, ID_UNDEFINED, PAGE_UNDEFINED);

function ManageHash() {
	console.log("ManageHash() called");
	var hash = document.location.hash.replace("#", "");
	console.log("ManageHash() called" + hash);
	var hashSplit = hash.split("/");

	if (hashSplit.length == 3) {
		currentContext.type = hashSplit[0];
		currentContext.id = hashSplit[1];
		currentContext.page = hashSplit[2];
		return true;
	}

	currentContext.type = TYPE_UNDEFINED;
	currentContext.id = -1;
	currentContext.page = PAGE_UNDEFINED;
	return true;
}

/*if (!ManageHash()) {
	UpdateUrl();
}*/

function SetPage(page){
	currentContext.page = page;
	RefreshCenterPanel();
	UpdateUrl();
}

function GetContextStringRepresentationForCall() {
	stringRepresentation = '?type=' + currentContext.type;
	stringRepresentation += '&id=' + currentContext.id;
	stringRepresentation += '&page=' + currentContext.page;
	return stringRepresentation;
}

function Refresh() {
	console.log("Refresh() called: " + currentContext.type + "/" + currentContext.id + "/" + currentContext.page);

	$.post("page.php",
		    {
				type: currentContext.type,
				id: currentContext.id,
				page: currentContext.page
		    },
		    function(data, status){
		    	$("#searchResult").html(data);
		    });

	UpdateUrl();
}

function CreateRecord($type) {
	currentContext.type = $type;
	currentContext.id = -1;
	currentContext.page = PAGE_UNDEFINED;

	Refresh();
}

function DisplayRecord($type, $id) {
	console.log("DisplayRecord(" + $type + ", " + $id + ") called");
	currentContext.type = $type;
	currentContext.id = $id;
	currentContext.page = PAGE_UNDEFINED;

	Refresh();
}

function Reset() {
	console.log("Reset() called");
	currentContext.type = TYPE_UNDEFINED;
	currentContext.id = -1;
	currentContext.page = PAGE_UNDEFINED;

	Refresh();
}

function NotImplemented() {
	alert('not implemented yet...');
}

function ExtendLeftPanel() {
	//dojo.style('leftPanel', "width", "500px");
	//dojo.byId('leftPanel').resize();
}

function UpdateUrl() {
	console.log("UpdateUrl()");

	var hash = currentContext.type;
	hash += "/" + currentContext.id;
	hash += "/" + currentContext.page;

	console.log(hash);

	document.location.hash = hash;

	setFavicon(); // Bug firefox: favicon disappears http://kilianvalkhof.com/2010/javascript/the-case-of-the-disappearing-favicon/
}

function setFavicon() {
	  var link = $('link[type="image/ico"]').remove().attr("href");
	  $('<link href="' + link + '" rel="shortcut icon" type="image/ico" />').appendTo('head');
}

$(window).bind('hashchange', function() {
	console.log("hashchange detected");
	if (ManageHash())
	{
		Refresh();
	}
});

function SetTitle(title) {
	var currentTitle = 'Gestionnaire de relations personnelles ou privées';
	if (title != '') {
		currentTitle = title + ' - Gestionnaire de relations personnelles ou privées';
	}

	document.title = currentTitle;
}

$(function() {
	Refresh();
});