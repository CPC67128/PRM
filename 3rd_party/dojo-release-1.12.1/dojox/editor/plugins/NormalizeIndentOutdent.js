//>>built
define("dojox/editor/plugins/NormalizeIndentOutdent",["dojo","dijit","dojox","dijit/_editor/_Plugin","dojo/_base/declare"],function(g,k,n,m){var l=g.declare("dojox.editor.plugins.NormalizeIndentOutdent",m,{indentBy:40,indentUnits:"px",setEditor:function(a){this.editor=a;a._indentImpl=g.hitch(this,this._indentImpl);a._outdentImpl=g.hitch(this,this._outdentImpl);a._indentoutdent_queryCommandEnabled||(a._indentoutdent_queryCommandEnabled=a.queryCommandEnabled);a.queryCommandEnabled=g.hitch(this,this._queryCommandEnabled);
a.customUndo=!0},_queryCommandEnabled:function(a){var d=a.toLowerCase(),b,e,c,f="marginLeft";this._isLtr()||(f="marginRight");if("indent"===d){if(d=this.editor,(b=k.range.getSelection(d.window))&&0<b.rangeCount){b=b.getRangeAt(0);for(e=b.startContainer;e&&e!==d.document&&e!==d.editNode;){c=this._getTagName(e);if("li"===c){for(a=e.previousSibling;a&&1!==a.nodeType;)a=a.previousSibling;return a&&"li"===this._getTagName(a)?!0:!1}if(this._isIndentableElement(c))return!0;e=e.parentNode}if(this._isRootInline(b.startContainer))return!0}}else if("outdent"===
d){if(d=this.editor,(b=k.range.getSelection(d.window))&&0<b.rangeCount){b=b.getRangeAt(0);for(e=b.startContainer;e&&e!==d.document&&e!==d.editNode;){c=this._getTagName(e);if("li"===c)return this.editor._indentoutdent_queryCommandEnabled(a);if(this._isIndentableElement(c)){if(a=e.style?e.style[f]:"")if(a=this._convertIndent(a),1<=a/this.indentBy)return!0;return!1}e=e.parentNode}this._isRootInline(b.startContainer)}}else return this.editor._indentoutdent_queryCommandEnabled(a);return!1},_indentImpl:function(a){a=
this.editor;var d=k.range.getSelection(a.window);if(d&&0<d.rangeCount){var d=d.getRangeAt(0),b=d.startContainer,e,c;if(d.startContainer===d.endContainer)if(this._isRootInline(d.startContainer)){for(b=d.startContainer;b&&b.parentNode!==a.editNode;)b=b.parentNode;for(;b&&b.previousSibling&&(this._isTextElement(b)||1===b.nodeType&&this._isInlineFormat(this._getTagName(b)));)b=b.previousSibling;b&&1===b.nodeType&&!this._isInlineFormat(this._getTagName(b))&&(b=b.nextSibling);if(b){c=a.document.createElement("div");
g.place(c,b,"after");c.appendChild(b);for(e=c.nextSibling;e&&(this._isTextElement(e)||1===e.nodeType&&this._isInlineFormat(this._getTagName(e)));)c.appendChild(e),e=c.nextSibling;this._indentElement(c);a._sCall("selectElementChildren",[c]);a._sCall("collapse",[!0])}}else for(;b&&b!==a.document&&b!==a.editNode;){d=this._getTagName(b);if("li"===d){this._indentList(b);break}else if(this._isIndentableElement(d)){this._indentElement(b);break}b=b.parentNode}else{var f,b=d.startContainer;for(e=d.endContainer;b&&
this._isTextElement(b)&&b.parentNode!==a.editNode;)b=b.parentNode;for(;e&&this._isTextElement(e)&&e.parentNode!==a.editNode;)e=e.parentNode;if(e===a.editNode||e===a.document.body){for(f=b;f.nextSibling&&a._sCall("inSelection",[f]);)f=f.nextSibling;e=f;if(e===a.editNode||e===a.document.body){d=this._getTagName(b);if("li"===d)this._indentList(b);else if(this._isIndentableElement(d))this._indentElement(b);else if(this._isTextElement(b)||this._isInlineFormat(d)){c=a.document.createElement("div");g.place(c,
b,"after");for(a=b;a&&(this._isTextElement(a)||1===a.nodeType&&this._isInlineFormat(this._getTagName(a)));)c.appendChild(a),a=c.nextSibling;this._indentElement(c)}return}}e=e.nextSibling;for(f=b;f&&f!==e;){if(1===f.nodeType){d=this._getTagName(f);if(g.isIE&&"p"===d&&this._isEmpty(f)){f=f.nextSibling;continue}"li"===d?(c&&(this._isEmpty(c)?c.parentNode.removeChild(c):this._indentElement(c),c=null),this._indentList(f)):!this._isInlineFormat(d)&&this._isIndentableElement(d)?(c&&(this._isEmpty(c)?c.parentNode.removeChild(c):
this._indentElement(c),c=null),f=this._indentElement(f)):this._isInlineFormat(d)&&(c||(c=a.document.createElement("div"),g.place(c,f,"after")),c.appendChild(f),f=c)}else this._isTextElement(f)&&(c||(c=a.document.createElement("div"),g.place(c,f,"after")),c.appendChild(f),f=c);f=f.nextSibling}c&&(this._isEmpty(c)?c.parentNode.removeChild(c):this._indentElement(c),c=null)}}},_indentElement:function(a){var d="marginLeft";this._isLtr()||(d="marginRight");var b=this._getTagName(a);if("ul"===b||"ol"===
b)b=this.editor.document.createElement("div"),g.place(b,a,"after"),b.appendChild(a),a=b;(b=a.style?a.style[d]:"")?(b=this._convertIndent(b),b=parseInt(b,10)+this.indentBy+this.indentUnits):b=this.indentBy+this.indentUnits;g.style(a,d,b);return a},_outdentElement:function(a){var d="marginLeft";this._isLtr()||(d="marginRight");var b=a.style?a.style[d]:"";b&&(b=this._convertIndent(b),b=0<b-this.indentBy?parseInt(b,10)-this.indentBy+this.indentUnits:"",g.style(a,d,b))},_outdentImpl:function(a){var d=
this.editor,b=k.range.getSelection(d.window);if(b&&0<b.rangeCount){var b=b.getRangeAt(0),e=b.startContainer;if(b.startContainer===b.endContainer){for(;e&&e!==d.document&&e!==d.editNode;){b=this._getTagName(e);if("li"===b)return this._outdentList(e);if(this._isIndentableElement(b))return this._outdentElement(e);e=e.parentNode}d.document.execCommand("outdent",!1,a)}else{d=b.startContainer;for(a=b.endContainer;d&&3===d.nodeType;)d=d.parentNode;for(;a&&3===a.nodeType;)a=a.parentNode;for(a=a.nextSibling;d&&
d!==a;)1===d.nodeType&&(b=this._getTagName(d),"li"===b?this._outdentList(d):this._isIndentableElement(b)&&this._outdentElement(d)),d=d.nextSibling}}return null},_indentList:function(a){for(var d=this.editor,b,e,c=a.parentNode,f=a.previousSibling;f&&1!==f.nodeType;)f=f.previousSibling;b=null;c=this._getTagName(c);"ol"===c?b="ol":"ul"===c&&(b="ul");if(b&&f&&"li"==f.tagName.toLowerCase()){if(f.childNodes)for(c=0;c<f.childNodes.length;c++){var h=f.childNodes[c];if(3===h.nodeType){if(g.trim(h.nodeValue)&&
e)break}else if(1!==h.nodeType||e)break;else b===h.tagName.toLowerCase()&&(e=h)}e?e.appendChild(a):(b=d.document.createElement(b),g.style(b,{paddingTop:"0px",paddingBottom:"0px"}),e=d.document.createElement("li"),g.style(e,{listStyleImage:"none",listStyleType:"none"}),f.appendChild(b),b.appendChild(a));d._sCall("selectElementChildren",[a]);d._sCall("collapse",[!0])}},_outdentList:function(a){var d=this.editor,b=a.parentNode,e=null,c=b.tagName?b.tagName.toLowerCase():"";"ol"===c?e="ol":"ul"===c&&(e=
"ul");var c=b.parentNode,f=this._getTagName(c);if("li"===f||"ol"===f||"ul"===f){if("ol"===f||"ul"===f){for(c=b.previousSibling;c&&(1!==c.nodeType||1===c.nodeType&&"li"!==this._getTagName(c));)c=c.previousSibling;if(c)c.appendChild(b);else{for(f=c=a;c.previousSibling;)c=c.previousSibling,1===c.nodeType&&"li"===this._getTagName(c)&&(f=c);f!==a?(g.place(f,b,"before"),f.appendChild(b),c=f):(c=d.document.createElement("li"),g.place(c,b,"before"),c.appendChild(b));g.style(b,{paddingTop:"0px",paddingBottom:"0px"})}}for(f=
a.previousSibling;f&&1!==f.nodeType;)f=f.previousSibling;for(var h=a.nextSibling;h&&1!==h.nodeType;)h=h.nextSibling;if(f){if(h)for(e=d.document.createElement(e),g.style(e,{paddingTop:"0px",paddingBottom:"0px"}),a.appendChild(e);a.nextSibling;)e.appendChild(a.nextSibling);g.place(a,c,"after")}else g.place(a,c,"after"),a.appendChild(b);b&&this._isEmpty(b)&&b.parentNode.removeChild(b);c&&this._isEmpty(c)&&c.parentNode.removeChild(c);d._sCall("selectElementChildren",[a]);d._sCall("collapse",[!0])}else d.document.execCommand("outdent",
!1,null)},_isEmpty:function(a){if(a.childNodes){var d=!0,b;for(b=0;b<a.childNodes.length;b++){var e=a.childNodes[b];if(1===e.nodeType){if("p"!==this._getTagName(e)||g.trim(e.innerHTML)){d=!1;break}}else if(this._isTextElement(e)){if((e=g.trim(e.nodeValue))&&"\x26nbsp;"!==e&&"\u00a0"!==e){d=!1;break}}else{d=!1;break}}return d}return!0},_isIndentableElement:function(a){switch(a){case "p":case "div":case "h1":case "h2":case "h3":case "center":case "table":case "ul":case "ol":return!0;default:return!1}},
_convertIndent:function(a){a=(a+"").toLowerCase();var d=0<a.indexOf("px")?"px":0<a.indexOf("em")?"em":"px";a=a.replace(/(px;?|em;?)/gi,"");"px"===d?"em"===this.indentUnits&&(a=Math.ceil(a/12)):"px"===this.indentUnits&&(a*=12);return a},_isLtr:function(){var a=g.getComputedStyle(this.editor.document.body);return a?"ltr"==a.direction:!0},_isInlineFormat:function(a){switch(a){case "a":case "b":case "strong":case "s":case "strike":case "i":case "u":case "em":case "sup":case "sub":case "span":case "font":case "big":case "cite":case "q":case "img":case "small":return!0;
default:return!1}},_getTagName:function(a){var d="";a&&1===a.nodeType&&(d=a.tagName?a.tagName.toLowerCase():"");return d},_isRootInline:function(a){var d=this.editor;if(this._isTextElement(a)&&a.parentNode===d.editNode||1===a.nodeType&&this._isInlineFormat(a)&&a.parentNode===d.editNode)return!0;if(this._isTextElement(a)&&this._isInlineFormat(this._getTagName(a.parentNode))){for(a=a.parentNode;a&&a!==d.editNode&&this._isInlineFormat(this._getTagName(a));)a=a.parentNode;if(a===d.editNode)return!0}return!1},
_isTextElement:function(a){return a&&3===a.nodeType||4===a.nodeType?!0:!1}});g.subscribe(k._scopeName+".Editor.getPlugin",null,function(a){a.plugin||"normalizeindentoutdent"!==a.args.name.toLowerCase()||(a.plugin=new l({indentBy:"indentBy"in a.args?0<a.args.indentBy?a.args.indentBy:40:40,indentUnits:"indentUnits"in a.args?"em"==a.args.indentUnits.toLowerCase()?"em":"px":"px"}))});return l});
//# sourceMappingURL=NormalizeIndentOutdent.js.map