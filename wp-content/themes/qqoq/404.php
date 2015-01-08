<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <title> 404错误页 </title>
  <meta name="Keywords" content="404错误页">
  <meta name="Description" content="404错误页,页面没有找到">
  <link type="text/css" rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css">
  <style type="text/css">
html,body{width:100%;height:100%;padding:0;margin:0;overflow:auto;}
.wrap{
       height:100%;
       text-align:center;
}
.container {
       text-align:left;
       display:inline-block;
       vertical-align:middle;
}
.edge {
     width:1px;
     *width:0;
      height:100%;
      display:inline-block;
      vertical-align:middle;
}
</style>
</head>
<body style="width:100%;height:100%;padding:0;margin:0;overflow:auto;">
   <div class="wrap">
	<span class="edge"></span>
	<span class="container">
<div id="a"></div>
<div id="b">
  <div id="n">
  <img alt="logo" src="<?php bloginfo('template_directory'); ?>/img/l.png">
   <div style="border:1px #ddd solid;height:300px;margin-top: 20px;text-align: center;background:#F5F5F5;">
    <div style="width:976px;height:298px;border:1px #fff solid;">
	 <h2 style="font-size:80px;margin-top:70px;">404</h2>
     <h3 style="font-size:20px;">页面没有找到，<span id="secondsDisplay">3</span> 秒钟之后返回首页。</h3>
	</div>
   </div>
  </div>
</div>
<div id="c"></div>
	</span>
	</div>
<script type="text/javascript">  
  var i = 3;  
  var intervalid;  
    intervalid = setInterval("fun()", 1000);  
    function fun() {  
          if (i == 0) {  
                  window.location.href = "<?php bloginfo('url'); ?>";  
                        clearInterval(intervalid);  
                      }  
  document.getElementById("secondsDisplay").innerHTML = i;  
  i--;   
    }  
</script>
 </body>
</html>