<?php
/*
Template Name: Codehighlight
*/
?>

<?php include("codehighlight-header.php"); ?>
	<style type="text/css" >
		#wrap{width:95%;margin:5px auto;min-width:580px;}
		.highlight pre{}		
		.cm-s-default,
		.highlight_page{margin:15px 0;font:monaco,andale mono,courier new;padding:10px 12px;border:#ccc 1px 
		solid;border-left-width:4px;background-color:#fefefe;box-shadow:0 0 4px #eee;word-break:break-all;word-wrap:break-word;color:#444;}
		#output{background:#fff;border:1px solid #D1D7DC;margin:0;}
		.tarea{width:99%;height:150px;border:#d4d4d4 1px solid;margin-bottom:12px;padding:4px;font-size:12px;line-height:18px}
		.tarea:focus{background:#fdfdfd;border:#ccc 1px solid}
		.sbtn{padding:0 12px;height:28px;line-height:27px;display:inline-block;margin-right:6px;border:#ccc 1px 
		solid;border-radius:2px;background-color:#f9f9f9;color:#333;cursor:pointer}
		.sbtn:hover,.sbtn:focus,.select:hover{border:#aaa 1px solid;color:#000}
		.select{padding:4px;border:#ccc 1px solid;border-radius:2px;margin-right:6px}
		.subbtn{margin-bottom:12px;}		
		.subbtn .cm-s-night{background-color:#000;}
		.highlight_page{white-space:pre-wrap;word-break:break-all;word-wrap:break-word;}
	</style>


	<div id="highlight">
		<h3 class="sitetip" style="font-size:160%;margin:10px 0;">贴入要高亮代码：<!--[if IE]>（本功能暂不支持IE浏览器）<![endif]--></h3>
		<textarea name="code" cols="100" rows="15" class="tarea" id="code" onmouseover="this.focus();this.select();"></textarea>

		<div class="subbtn">
			<input class="sbtn" type="button" value="Html" onclick="doHighlight('text/html');">
			<input class="sbtn" type="button" value="CSS" onclick="doHighlight('text/css');">
			<input class="sbtn" type="button" value="Javscript" onclick="doHighlight('text/javascript');">
			<input class="sbtn" type="button" value="XML" onclick="doHighlight('application/xml');">
			<input class="sbtn" type="button" value="PHP" onclick="doHighlight('application/x-httpd-php');">
			<input class="sbtn" type="button" value="SHELL" onclick="doHighlight('text/x-sh');">
			选择一种主题: <select onchange="selectTheme()" id=select>
				<option selected>default</option>
				<option>eclipse</option>
			</select>
			<input id="highlightType" value='' hidden='hidden'>

			<h3 class="sitetip" style="font-size:160%;margin:10px 0;">复制以下代码到编辑器（Html模式）：</h3>
			<textarea class="tarea" id="getcode" cols="100" rows="15" onmouseover="this.focus();this.select();"></textarea>
			<h3 class="sitetip" style="font-size:160%;margin:10px 0;">高亮预览：</h3>
			<pre id="output" class = "cm-s-default"></pre>

			<link rel="stylesheet" href="<?php bloginfo('template_url')?>/js/CodeMirror/lib/codemirror.css">
			<script src="<?php bloginfo('template_url')?>/js/CodeMirror/lib/codemirror.js"></script>
			<script src="<?php bloginfo('template_url')?>/js/CodeMirror/lib/runmode.js"></script>
			<script src="<?php bloginfo('template_url')?>/js/CodeMirror/mode/xml/xml.js"></script>
			<script src="<?php bloginfo('template_url')?>/js/CodeMirror/mode/javascript/javascript.js"></script>
			<script src="<?php bloginfo('template_url')?>/js/CodeMirror/mode/css/css.js"></script>
			<script src="<?php bloginfo('template_url')?>/js/CodeMirror/mode/clike/clike.js"></script>
			<script src="<?php bloginfo('template_url')?>/js/CodeMirror/mode/php/php.js"></script>
			<script src="<?php bloginfo('template_url')?>/js/CodeMirror/mode/shell/shell.js"></script>

			<script>
				function doHighlight(type){
					if(document.getElementById("code").value != ''){
						CodeMirror.doHighlight(type,  document.getElementById("select"));
						document.getElementById("highlightType").value = type;
					}
				}

				function changeHighlight(){
					if(document.getElementById("highlightType").value != ''){
						CodeMirror.doHighlight(document.getElementById("highlightType").value, document.getElementById("select"));
					}
				}

				var input = document.getElementById("select");
				function selectTheme() {
					var editor = document.getElementById("output");
					changeHighlight();
					var theme = input.options[input.selectedIndex].innerHTML;
					editor.setOption("theme", theme);
				}
				var choice = document.location.search && document.location.search.slice(1);
				if (choice) {
					input.value = choice;
					var editor = document.getElementById("output").value;
					editor.setOption("theme", choice);
				}
			</script>

			
			<link rel="stylesheet" href="<?php bloginfo('template_url')?>/js/CodeMirror/theme/neat.css">
			<link rel="stylesheet" href="<?php bloginfo('template_url')?>/js/CodeMirror/theme/elegant.css">
			<link rel="stylesheet" href="<?php bloginfo('template_url')?>/js/CodeMirror/theme/erlang-dark.css">
			<link rel="stylesheet" href="<?php bloginfo('template_url')?>/js/CodeMirror/theme/night.css">
			<link rel="stylesheet" href="<?php bloginfo('template_url')?>/js/CodeMirror/theme/monokai.css">
			<link rel="stylesheet" href="<?php bloginfo('template_url')?>/js/CodeMirror/theme/cobalt.css">
			<link rel="stylesheet" href="<?php bloginfo('template_url')?>/js/CodeMirror/theme/eclipse.css">
			<link rel="stylesheet" href="<?php bloginfo('template_url')?>/js/CodeMirror/theme/rubyblue.css">
			<link rel="stylesheet" href="<?php bloginfo('template_url')?>/js/CodeMirror/theme/lesser-dark.css">
			<link rel="stylesheet" href="<?php bloginfo('template_url')?>/js/CodeMirror/theme/xq-dark.css">
			<link rel="stylesheet" href="<?php bloginfo('template_url')?>/js/CodeMirror/theme/ambiance.css">
			<link rel="stylesheet" href="<?php bloginfo('template_url')?>/js/CodeMirror/theme/blackboard.css">
			<link rel="stylesheet" href="<?php bloginfo('template_url')?>/js/CodeMirror/theme/vibrant-ink.css">
		</div>
	</div>
<?php get_footer();?>