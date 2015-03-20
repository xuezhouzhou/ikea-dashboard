<?php 
include_once './includes/init.php'; 
?>
<!DOCTYPE HTML>
<!--[if IE 8 ]><html class="ie ie8"><![endif]-->
<!--[if IE 9 ]><html class="ie ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html><!--<![endif]-->
<head>
<meta charset="utf-8">
<title>IKEA DASHBOARD</title>
<link href="static/bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<style type="text/css">
body{
	background:#e8e6d5;
	font-size: 12px;	
}
#x-toolbar{
	margin-top:15px;
	height:32px;	
}
#x-content{
	margin-top:15px;
	height:498px;	
}
.padding-right-0{
	padding-right:0;	
}
.panel{
	background:#ebdfd4;
	border-radius:5px;
	border-top:1px solid #fff;
	border-bottom:1px solid #847d76;
	box-shadow: 0px 1px 2px 0px #333;
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
.xzz-select-wrap{
	height:32px;	
	width:100%;
	position:relative;
	background-color:#826e55;
	background:linear-gradient(#8b785e,#62523e);
	border-radius:5px;
	border-bottom:none;
}
.border-radius-none{
	border-radius:5px 5px 0 0;
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


html,body,div {
  scrollbar-base-color:#E1BC92;
  /* scrollbar-base-color: #E1BC92; 滚动条的基本颜色 */
  /* scrollbar-face-color:#E1BC92;滚动条凸出部分的颜色,就是我们拖动那个条主色 */
  /*scrollbar-track-color:#EBDFD4; 滚动条的背景颜色,滚动条不在的区域 */
  /*crollbar-arrow-color: #E1BC92; 上下按钮上三角箭头的颜色 */
  /*scrollbar-3dlight-color:#E1BC92; 滚动条亮边的颜色,最左细边的颜色 */
  /*scrollbar-highlight-color:#E1BC92; 滚动条空白部分的颜色,条子左边的细条,不是最左边 */
  /*scrollbar-shadow-color: #E1BC92; 立体滚动条右边的颜色,小细边的颜色,是中间夹层 */
  /*scrollbar-darkshadow-color: #E1BC92; 滚动条强阴影的颜色,最右细边,开始黑色的 */
}

.container{
	padding:0 1px;
	height:473px;
}
.table-wrap{
	float:left;
	width:19%;
	margin-right:1%;
	height:100%;
}
.chart-wrap{
	position:relative;
	height:100%;
	overflow-x:scroll;
	padding-top:10px;
	padding-left:20px;
	/*border:1px solid red;*/
}
.table-inner{
	padding:20px;
}
#chart-table{
	width:100%;
}
#chart-table td,#chart-table th{
	text-align:center;
	height:26px;
	line-height:26px;
}
#chart-table td{
	background:#e0bb92;
	border-bottom:1px solid #ece1d6;
	color:#6d5840;
}
#chart-table tr:hover td{
	background:#806d54;
	color:#fff;
}
#chart-table th{
	background:#806d54;
	background: linear-gradient(#8b785e,#62523e);
	color:#fff;
}
#chartdiv{
	width:99.9%;
	min-width:1300px;
	height:400px;
}
#btn{
	width:23px;
	height:26px;
	cursor:pointer;
	position:absolute;
	left:0;
	top:50%;
	margin-top:-13px;	
}
.left{
	background:url(static/images/btn-left.jpg) no-repeat;	
}
.right{
	background:url(static/images/btn-right.jpg) no-repeat;
}

/*CN 刻度条*/
#cn-chart-wrap{
	width: 99.9%;
  min-width: 1040px;
	padding-left: 79px;
	padding-right: 78px;
}
#cn-chart{
	height: 40px;
	width:100%;
	position: relative;
}
#cn-chart .label{
	position:absolute;
	left:-40px;
	font-size:14px;
	color:#6d5840;
	top:2px;
}
.bar-total{
	position:absolute;
	height:20px;
	width:100%;
	background:#f9f9f9;
	border:1px solid #c1c1c1;
	border-radius:10px;
	box-shadow:1px 1px 1px 0 #c1c1c1;
}
.bar-cur{
	position:absolute;
	left:0;
	top:1px;
	height:20px;
	width:5%;
	background:#FF7F50;
	background: linear-gradient(#FF7F50,#FF6347);
	border-radius:10px;
	box-shadow:1px 1px 1px 0 #333;
}
.bar-cur span{
	position:absolute;
	right:10px;
	color:#fff;
	font-size:12px;
	line-height:20px;
}
.kedu{
	position:absolute;
	top:20px;
	font-size:12px;
	color:#6d5840;
	line-height:20px;
	width:99.9%;
	height:20px;
}
.kedu span{
	position:absolute;
}
.kedu .span-1{
	left:1%;	
}
.kedu .span-2{
	left:25%;
}
.kedu .span-3{
	left:50%;
}
.kedu .span-4{
	left:75%;
}
.kedu .span-5{
	right:1%;
}

.ie8 #cn-chart-wrap{
  min-width: 700px;
}
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
  	<div class="col-xs-2 padding-right-0" id="x-table">
    	<div class="panel" style="overflow-y:scroll;max-height:498px;">
        <div class="table-inner">
          <table id="chart-table" cellpadding="0" cellspacing="0"></table>
        </div>
      </div>
    </div>
   
    <div class="col-xs-10" style="height:100%" id="x-chart">
    	<div class="chart-wrap panel">
        <div id="btn" class="left"></div>
        <div id="chartdiv"></div>
       	<div id="cn-chart-wrap">
          <div id="cn-chart">
            <div class="bar-total"><div class="label">CN</div></div>
            <div class="bar-cur"><span>456,123</span></div>
            <div class="kedu">
              <span class="span-1">0</span>
              <span class="span-2">2000</span>
              <span class="span-3">4000</span>
              <span class="span-4">6000</span>
              <span class="span-5">8000</span>
            </div>
          </div>
  			</div> 
      </div>
    </div>
	</div>
</div>
<script src="static/js/jquery.min.js"></script>
<script src="static/js/echarts-plain.js"></script>
<script src="static/js/common.js"></script>
<script src="static/js/global_kpi_bar.js"></script>
</body>
</html>