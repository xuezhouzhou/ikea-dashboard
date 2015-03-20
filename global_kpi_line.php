<?php include_once './includes/init.php'; ?>
<!DOCTYPE HTML>
<!--[if IE 8 ]> <html class="ie ie8"> <![endif]-->
<!--[if IE 9 ]> <html class="ie ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]> <html> <![endif]-->
<head>
<meta charset="utf-8">
<title>IKEA DASHBOARD</title>
<link href="static/bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<style type="text/css">
body{
	background:#e8e6d5;
	font-size: 12px;	
}

/*== 工具条Start ==*/
#x-toolbar{
	margin-top:15px;
	height:32px;	
}
.padding-right-0{
	padding-right:0;	
}
.xzz-select-wrap{
	height:32px;	
	width:100%;
	position:relative;
	background-color:#826e55;
	background:linear-gradient(#8b785e,#62523e);
	border-radius:5px;
	border-bottom:none;
}
.xzz-select-wrap .cur-item{
	position:absolute;
	width:100%;
	line-height:32px;
	height:32px;
	font-size:12px;
	color:#fff;
	background:url(static/images/jt.png) right top no-repeat;	
	cursor:pointer;
	text-align:center;
}

.xzz-select-wrap .xzz-list{
	position:absolute;
	top:32px;
	right:0;
	left:0;
	border:1px solid #705a42;
	border-top:none;
	background:#fff;
	height:385px;
	overflow-y:scroll;
	display:none;
	z-index:999999;
}
.xzz-select-wrap .xzz-list .item{
	line-height:32px;
	height:32px;
	font-size:12px;
	color:#333;	
	text-align:center;
	overflow: hidden;
}
.xzz-select-wrap .xzz-list .item:hover{
	background:#705a42;
	color:#fff;
	cursor:pointer;
}
#report-mark{
	line-height: 32px;
	height: 32px;
	font-size: 12px;
	cursor: pointer;
	text-align: center;
	padding:0 10px;
	background-color:#deb584;
	border-radius:5px;
	display:inline-block;
	color:#fff;
}

/*== 工具条end ==*/








/*== 图表内容 start ==*/
#x-content{
	margin-top:15px;
	height:544px;
}
.panel{
	background:#ebdfd4;
	border-radius:5px;
	border-top:1px solid #fff;
	border-bottom:1px solid #847d76;
	box-shadow: 0px 1px 2px 0px #333;
}
.border-radius-none{
	border-radius:5px 5px 0 0;
}

#store-tag,#store-chart{
	width:100%;
	height:100%;
	position:relative;	
}
#hover{
	height:80px;
	width:99.9%;
	position:absolute;
	left:0;
	top:0;
	z-index:999;
	background:#fff;
	opacity:0;
	filter: progid:DXImageTransform.Microsoft.Alpha(opacity=0);
  
}
#store-chart{
	overflow-x:scroll !important;
  padding-top: 15px;
}
#store-tag-inner{
	padding:20px;
}
#store-tag ul{
	width:100%;
	height:100%;
	padding:0;
	margin:0;
}
#store-tag li{
	padding:0;
	margin:0;
	padding-left:12px;
	list-style: none;
	display: block;
	background: #fdfdfd;
	background: linear-gradient(#fff, #f4f4f4);
	border-left: 1px solid #6baa6b;
	color: #6d5840;
	font-size: 12px;
	font-weight: 800;
	height: 30px;
	line-height: 30px;
	margin: 1px 0;
	position:relative;
	cursor:pointer;
	width:90%;
}
#store-tag li i{
	position:absolute;
	width:8px;
	height:11px;
	right:10px;
	top:9px;
	background:url(static/images/jt-r.png) no-repeat;
}
#store-tag li.checked{
	background:#7c6a52;
	background: linear-gradient(#8c785e, #665542);
	border-left:none;
	width:100%;
	color:#fff;
}
#store-tag li.checked i{
	background:url(static/images/jt-l.png) no-repeat;
}



#chartdiv{
	height: 510px;
	width:99.9%;
	min-width:1300px;
}
/*== 图表内容 end ==*/



/*== Chrom 滚动条样式修饰 start  ==*/
::-webkit-scrollbar {
	background-color:#EBDFD4;
	border-radius:6px;
}
::-webkit-scrollbar:vertical {
	width:12px;
	z-index:999;
}
::-webkit-scrollbar:horizontal {
	height:12px;
	z-index:999;
}
::-webkit-scrollbar-thumb{
	background-color:#E1BC92;
	border-radius:6px;
}
::-webkit-scrollbar-thumb:hover {
	background-color:#FF6347;
}
/*== Chrom 滚动条样式修饰 end ==*/


/*IE 滚动条修饰 start*/
html,body,div {
  scrollbar-base-color:#E1BC92;
}
/*IE 滚动条修饰 end*/


/*== IE hack start==*/
.ie #store-chart{
  padding-top: 10px !important;
}
/*==IE hack end==*/
</style>
</head>
<body>
<div class="container-fluid" style="overflow:hidden">
	<div class="row" id="x-toolbar">
  	<div class="col-xs-2 padding-right-0">
    	<div class="xzz-select-wrap" id="index-select">
        <div class="cur-item">Member Quantity</div>
        <div class="xzz-list">
          <?php foreach($index_list as $value) {?>
            <div class="item"><?=$value?></div>
          <?php }?> 
        </div>
      </div>
    </div>
    <div class="col-xs-2 padding-right-0">
    	<div class="xzz-select-wrap fl" id="report-select">
        <div class="cur-item" data="<?=$report_list[count($report_list)-1]['mark']?>"><?=$report_list[count($report_list)-1]['report']?></div>
        <div class="xzz-list">
          <?php for($i=count($report_list)-1;$i>=0;$i--) {?>
            <div class="item" data="<?=$report_list[$i]['mark']?>"><?=$report_list[$i]['report']?></div>
          <?php }?>
        </div>
      </div>
    </div>
    <div class="col-xs-8">
    	<div id="report-mark" class="fl">Loading...</div>
    </div>
  </div>

	<div class="row" id="x-content">
  	<div class="col-xs-2 padding-right-0">
    	<div id="store-tag" class="panel" style="overflow-y:scroll;max-height:539px;">
      	<div id="store-tag-inner">
          <ul>
            <?php for($i=0;$i<count($store_list);$i++) {?>
              <li <?php if($i<2){?>class="checked"<?php }?>><?=$store_list[$i] ?><i></i></li>
            <?php } ?>    
          </ul>
        </div>
      </div>
    </div>
    <div class="col-xs-10">
    	<div id="store-chart" class="panel">
        <div id="hover"></div>
        <div id="chartdiv"></div>
        <table id="chart-table" cellpadding="0" cellspacing="0"></table>
      </div>
    </div>
	</div>
</div>
<script src="static/js/jquery.min.js"></script>
<script src="static/js/echarts-plain.js"></script>
<script src="static/js/common.js"></script>
<script src="static/js/global_kpi_line.js"></script>
</body>
</html>