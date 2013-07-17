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
	var hash = document.location.hash.replace("#", "");
	var hashSplit = hash.split("/");

	if (hashSplit.length == 3) {
		currentContext.type = hashSplit[0];
		currentContext.id = hashSplit[1];
		currentContext.page = hashSplit[2];
		return true;
	}

	return false;
}

if (!ManageHash()) {
	UpdateUrl();
}

require(["dojo/parser",
         "dijit/layout/ContentPane",
         "dijit/layout/BorderContainer",
         "dojox/data/QueryReadStore",
         "dojo/_base/lang", "dojo/_base/xhr","dojo/io/iframe",
         "dojo/domReady!"]);
require(["dojo/ready", "dijit/form/ComboBox"], function(ready, comboBox) {
	ready(function() {
		RefreshAllPanels();
	});

});

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

function RefreshAllPanels() {
	RefreshLeftPanel();
	RefreshCenterPanel();
	RefreshBottomPanel();

	UpdateUrl();
}

function RefreshCenterPanel() {
	dojo.xhrGet ( {
		url: 'get_center_panel.php' + GetContextStringRepresentationForCall(),
		timeout: 15000,
		load: function(data, ioArgs) {
			if (dijit.byId("centerPanelDynamic"))
				dijit.byId("centerPanelDynamic").destroy();
			$('#centerPanel').html(data);
			dojo.parser.parse(dojo.byId('#centerPanelDynamic'));
		},
		error: function(err, ioArgs) {
			dojo_table.innerHTML = "An unexpected error occurred: " + error;
		}
	});
}

function RefreshLeftPanel() {
	dojo.xhrGet ( {
		url: 'get_left_panel.php' + GetContextStringRepresentationForCall(),
		timeout: 15000,
		load: function(data, ioArgs) {
			if (dijit.byId("leftPanelDynamic"))
				dijit.byId("leftPanelDynamic").destroy();
			$('#leftPanel').html(data);
			dojo.parser.parse(dojo.byId('#leftPanelDynamic'));
		},
		error: function(err, ioArgs) {
			dojo_table.innerHTML = "An unexpected error occurred: " + error;
		}
	});
}

function RefreshBottomPanel() {
	dojo.xhrGet ( {
		url: 'get_bottom_panel.php' + GetContextStringRepresentationForCall(),
		timeout: 15000,
		load: function(data, ioArgs) {
			if (dijit.byId("bottomPanelDynamic"))
				dijit.byId("bottomPanelDynamic").destroy();
			$('#bottomPanel').html(data);
			dojo.parser.parse(dojo.byId('#bottomPanelDynamic'));
		},
		error: function(err, ioArgs) {
			dojo_table.innerHTML = "An unexpected error occurred: " + error;
		}
	});
}

function CreateRecord($type) {
	currentContext.type = $type;
	currentContext.id = -1;
	currentContext.page = PAGE_UNDEFINED;

	RefreshAllPanels();
}

function DisplayRecord($type, $id) {
	currentContext.type = $type;
	currentContext.id = $id;
	currentContext.page = PAGE_UNDEFINED;

	RefreshAllPanels();
}

function ResetScreen() {
	currentContext.type = TYPE_UNDEFINED;
	currentContext.id = -1;
	currentContext.page = PAGE_UNDEFINED;

	RefreshAllPanels();
}

function NotImplemented() {
	alert('not implemented yet...');
}

function ExtendLeftPanel() {
	//dojo.style('leftPanel', "width", "500px");
	//dojo.byId('leftPanel').resize();
}

function UpdateUrl() {
	var hash = currentContext.type;
	hash += "/" + currentContext.id;
	hash += "/" + currentContext.page;

	document.location.hash = hash;

	setFavicon(); // Bug firefox: favicon disappears http://kilianvalkhof.com/2010/javascript/the-case-of-the-disappearing-favicon/
}

function setFavicon() {
	  var link = $('link[type="image/ico"]').remove().attr("href");
	  $('<link href="' + link + '" rel="shortcut icon" type="image/ico" />').appendTo('head');
}

$(window).bind('hashchange', function() {
	if (ManageHash())
		RefreshAllPanels();
});

function SetTitle(title) {
	var currentTitle = 'Gestionnaire de relations personnelles ou privées';
	if (title != '') {
		currentTitle = title + ' - Gestionnaire de relations personnelles ou privées';
	}

	document.title = currentTitle;
}

$(function() {
	$("#search").val($("#search").attr('title'));
	$("#search").addClass('search-textbox-label');

	$("#search").autocomplete({
		source: function( request, response ) {
			$.ajax({
				type: 'GET',
				url: "pc_search.php",
				contentType: "application/json; charset=utf-8",
				dataType: "json",
				data: {
						'search_string': request.term
					},
				success: function( data ) {
					response( $.map( data.items, function( item ) {
						return {
							label: item.fullName,
							type: item.type,
							id: item.id
						}
					}));
				},

                            error: function(jqXHR, textStatus, errorThrown){
                                alert(errorThrown);
                            }

			});
		},
		minLength: 2,
		select: function( event, ui ) {
			DisplayRecord(ui.item.type, ui.item.id);
			$("search").blur();
		}
	});

	$("#search").focus(function(){
        if(this.value == $(this).attr('title')) {
            this.value = '';
            $(this).removeClass('search-textbox-label');
        }
    });

	$("#search").blur(function(){
		this.value = $(this).attr('title');
		$(this).addClass('search-textbox-label');
    });
});