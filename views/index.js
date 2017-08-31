var TYPE_UNDEFINED = "";
var TYPE_CONTACT = "contact";
var TYPE_COMPANY = "company";
var TYPE_ATTRIBUTE = "attribute";
var TYPE_CONFIGURATION = "configuration";
var TYPE_TOOLS = "tools";

var PAGE_UNDEFINED = '-1';

var ID_UNDEFINED = -1;

function Context(type, id, page) {
	this.type = type;
	this.id = id;
	this.page = page;
}

var currentContext = new Context(TYPE_UNDEFINED, ID_UNDEFINED, PAGE_UNDEFINED);

function ManageHash() {
	var hash = document.location.hash.replace("#", "");
	console.log("ManageHash() hash = " + hash);
	var hashSplit = hash.split("/");
	console.log("ManageHash() hashSplit.length = " + hashSplit.length);

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

if (!ManageHash()) {
	console.log("UpdateUrl call from flow");
	UpdateUrl();
}

function SetPage(page){
	console.log("setpage");
	currentContext.page = page;
	RefreshCenterPanel();
	UpdateUrl();
}

function GetContextStringRepresentationForCall() {
	console.log('GetContextStringRepresentationForCall');
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
	console.log("CreateRecord(" + $type + ")");
	currentContext.type = $type;
	currentContext.id = -1;
	currentContext.page = PAGE_UNDEFINED;

	Refresh();
}

function DisplayRecord($type, $id) {
	console.log("DisplayRecord(" + $type + ", " + $id + ")");
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

function UpdateUrl() {
	console.log("UpdateUrl() "+currentContext.type+"/"+currentContext.id+"/"+currentContext.page);

	var hash = currentContext.type;
	hash += "/" + currentContext.id;
	hash += "/" + currentContext.page;

	console.log("UpdateUrl() window.location.hash = "+hash);
	location.hash = hash;

	setFavicon(); // Bug firefox: favicon disappears http://kilianvalkhof.com/2010/javascript/the-case-of-the-disappearing-favicon/
}

function setFavicon() {
	console.log("setFavicon()");
	  var link = $('link[type="image/ico"]').remove().attr("href");
	  $('<link href="' + link + '" rel="shortcut icon" type="image/ico" />').appendTo('head');
}

$(window).bind('hashchange', function() {
	if (location.hash == '')
	{
		console.log("Hashchange detected: NO HASH");
		return;
	}

	console.log("Hashchange detected: "+location.hash);
	if (ManageHash())
	{
		Refresh();
	}
});

$(document).ready(function(){

	console.log("$(document).ready(function()");
	Refresh();
});




