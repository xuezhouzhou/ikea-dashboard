<?php
  session_start();
	if(empty($_SESSION['check'])){
		header('Location:check.html');
		exit;
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>IKEA DASHBOARD</title>
<!--[if lt IE 8]><script>window.location.href = 'unsupport.html';</script><![endif]-->
<link href="static/bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="static/css/index.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrap">
	<div class="container-fluid" id="top">
    <div class="row">
    	<div class="col-lg-12">
      	<img src="static/images/top.jpg" />
      </div>
    </div>
  </div>
  
  <div class="container-fluid" id="nav">
    
    <ul>
      <li><a class="cur" href="javascript:void(0)">Global KPI</a></li>
      <li><a href="./store-kpi">Store KPI</a></li>
    </ul>

  </div>

  <div class="container-fluid">
    <div id="main">
      <div id="global-kpi-bar"><iframe src="global_kpi_bar.php"  frameborder="0"></iframe></div>
      <div id="global-kpi-line-title">Store trend & comparison</div>
      <div id="global-kpi-line"><iframe src="global_kpi_line.php" frameborder="0"></iframe></div>
    </div>
  </div>
</div>
</body>
</html>