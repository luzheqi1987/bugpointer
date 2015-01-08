CodeMirror.runMode = function(string, modespec, callback) {
  var mode = CodeMirror.getMode(CodeMirror.defaults, modespec);
  var isNode = callback.nodeType == 1;
  var tabSize = CodeMirror.defaults.tabSize;
  if (isNode) {
    var node = callback, accum = [], col = 0;
    callback = function(text, style) {
      if (text == "\n") {
        accum.push("<br>");
        col = 0;
        return;
      }
      var escaped = "";
      // HTML-escape and replace tabs
      for (var pos = 0;;) {
        var idx = text.indexOf("\t", pos);
        if (idx == -1) {
          escaped += CodeMirror.htmlEscape(text.slice(pos));
          col += text.length - pos;
          break;
        } else {
          col += idx - pos;
          escaped += CodeMirror.htmlEscape(text.slice(pos, idx));
          var size = tabSize - col % tabSize;
          col += size;
          for (var i = 0; i < size; ++i) escaped += " ";
          pos = idx + 1;
        }
      }

      if (style) 
        accum.push("<span class=\"cm-" + CodeMirror.htmlEscape(style) + "\">" + escaped + "</span>");
      else
        accum.push(escaped);
    }
  }
  var lines = CodeMirror.splitLines(string), state = CodeMirror.startState(mode);
  for (var i = 0, e = lines.length; i < e; ++i) {
    if (i) callback("\n");
    var stream = new CodeMirror.StringStream(lines[i]);
    while (!stream.eol()) {
      var style = mode.token(stream, state);
      callback(stream.current(), style, i, stream.start);
      stream.start = stream.pos;
    }
  }
  if (isNode)
    node.innerHTML = accum.join("");
};

CodeMirror.replaceCode = function(text, selected){
		var str;
		if(selected.selectedIndex == 0){
			str = text
			.replace(/class=\"cm-/g,'style="color:#cm-')
			.replace(/cm-keyword/g,	    '708')
			.replace(/cm-atom/g,		'219')
			.replace(/cm-number/g,		'164')
			.replace(/cm-def/g,		    '00f')
			.replace(/cm-variable-2/g,	'05a')
			.replace(/cm-variable-3/g,	'085')
			.replace(/cm-variable/g,	'000')
			.replace(/cm-property/g,	'000')
			.replace(/cm-operator/g,	'000')
			.replace(/cm-comment/g,	    'a50')
			.replace(/cm-string-2/g,	'f50')
			.replace(/cm-string/g,		'a11')
			.replace(/cm-meta/g,		'555')
			.replace(/cm-error/g,		'f00')
			.replace(/cm-qualifier/g,	'555')
			.replace(/cm-builtin/g,	    '30a')
			.replace(/cm-bracket/g,  	'cc7')
			.replace(/cm-tag/g,		    '170')
			.replace(/cm-attribute/g,	'00c')
			.replace(/cm-header/g,  	'00f')
			.replace(/cm-quote/g,		'090')
			.replace(/cm-hr/g,		    '999')
			.replace(/cm-link/g,		'00c');
		}else if(selected.selectedIndex == 1){
			str = text
			.replace(/class=\"cm-/g,'style="color:#cm-')
			.replace(/cm-meta/g,		'FF1717')
			.replace(/cm-keyword/g,	    '7F0055;line-height: 1em; font-weight: bold;')
			.replace(/cm-atom/g,		'219')
			.replace(/cm-number/g,		'164')
			.replace(/cm-def/g,		    '00f')
			.replace(/cm-variable-2/g,	'#0000C0')
			.replace(/cm-variable-3/g,	'#0000C0')
			.replace(/cm-variable/g,	'000')
			.replace(/cm-property/g,	'000')
			.replace(/cm-operator/g,	'000')
			.replace(/cm-comment/g,	    '3F7F5F')
			.replace(/cm-string-2/g,	'f50')
			.replace(/cm-string/g,		'2A00FF')
			.replace(/cm-meta/g,		'555')
			.replace(/cm-error/g,		'f00')
			.replace(/cm-qualifier/g,	'555')
			.replace(/cm-builtin/g,	    '30a')
			.replace(/cm-bracket/g,  	'cc7')
			.replace(/cm-tag/g,		    '170')
			.replace(/cm-attribute/g,	'00c')
			.replace(/cm-header/g,  	'00f')
			.replace(/cm-quote/g,		'090')
			.replace(/cm-hr/g,		    '999')
			.replace(/cm-link/g,		'219');
	}
		return str;
};

function changLine(text){
	var str = text.replace(/<br>/g,		'<br>\n');
	return str;
}

//runcode
function $(id){ 
  return document.getElementById(id);
}


CodeMirror.doHighlight = function doHighlight(type, selected) {
	CodeMirror.runMode($("code").value, type, $("output"));
	
	var str = $("output").innerHTML;
	base = CodeMirror.replaceCode(str, selected);
	var theme_default_style = '',
		theme_default_code = base;
	
	$("output").innerHTML = theme_default_code;
	$("output").setAttribute('style',theme_default_style);
	$("getcode").value = '<pre style="margin: 15px 0; font: 100 12px/18px monaco, andale mono, courier new; padding: 10px 12px; border: #ccc 1px solid; border-left-width: 4px; background-color: #fefefe; box-shadow: 0 0 4px #eee; word-break: break-all; word-wrap: break-word; color: #444;">' + changLine(theme_default_code) + '</pre>';
}


