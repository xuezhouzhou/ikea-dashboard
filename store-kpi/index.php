<?php
//屏蔽notice错误
error_reporting(0);

//函数库文件
include '../includes/functions.php'; 

//Excel读取类
include '../includes/excel_reader.php';

//创建对象 
$ExcelReader = new Spreadsheet_Excel_Reader(); 

//设置文本输出编码 
$ExcelReader->setOutputEncoding('UTF-8'); 

//读取Excel文件 store_kpi_data.xls
$ExcelReader->read('excel/store_kpi_data.xls'); 

//表头
$excel_head = array();



//商场列表
$store_list = array();

for($i=1;$i<=$ExcelReader->sheets[0]['numCols'];$i++){
  $excel_head[] = $ExcelReader->sheets[0]['cells'][1][$i];
}

for ($i = 2; $i <= 18; $i++) { 
  $store_list[] = $ExcelReader->sheets[0]['cells'][$i][1];
}

array_splice($excel_head,0,3);
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Store Kpi</title>
<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
<!-- top start -->  
<div class="container-fluid" id="top">
  <div class="row">
    <div class="col-lg-12">
      <img src="../static/images/top.jpg">
    </div>
  </div>
</div>
<!-- top end -->

<!-- nav start -->
<div class="container-fluid" id="nav">
  <ul>
    <li><a href="../">Global KPI</a></li>
    <li><a class="cur" href="javascript:void(0)">Store KPI</a></li>
  </ul>
</div>
<!-- nav end -->

<div class="container-fluid" >
  <!-- main start -->
  <div id="main">
    <!-- Store,时间 下拉框 start -->
    <div class="container-fluid m-t-15">
      <div class="row">
        <div class="col-xs-2 padding-right-0">
          <div class="xzz-select-wrap" id="store-select1">
            <div class="cur-item"><?=$store_list[0] ?></div>
            <div class="xzz-list">
              <?php foreach($store_list as $value) { ?>
                <div class="item"><?php echo $value ?></div>
              <?php } ?>
            </div>
          </div>
        </div> 
        <div class="col-xs-2 padding-right-0">
          <div class="xzz-select-wrap" id="time-select">
            <div class="cur-item">2014-12</div>
            <div class="xzz-list">
              <div class="item">2015-03</div>
              <div class="item">2015-02</div>
              <div class="item">2015-01</div>
              <div class="item">2014-12</div>
              <div class="item">2014-11</div>
              <div class="item">2014-10</div>
              <div class="item">2014-09</div>
              <div class="item">2014-08</div>
              <div class="item">2014-07</div>
              <div class="item">2014-06</div>
              <div class="item">2014-05</div>
              <div class="item">2014-04</div>
              <div class="item">2014-03</div>
              <div class="item">2014-02</div>
              <div class="item">2014-01</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Store,时间 下拉框 end -->

    <!-- 指标数值展示 start -->
    <div class="container-fluid m-t-15">
      <div class="row" id="partA">
        <div class="col-xs-3 padding-right-0">
          <div class="xzz-panel">
            <ul class="u1">
              <li class="xzz-label">Member T/O</li>
              <li class="xzz-value" id="indexD">Loading...</li>
            </ul>
          </div>
        </div>
        <div class="col-xs-3 padding-right-0">
          <div class="xzz-panel">
            <div class="u2">
              <li>
                <div class="xzz-label fl">Active Member</div>
                <div class="xzz-value fr" id="indexE">Loading...</div>
              </li>
              <li>
                <div class="xzz-label fl">Individual Spending</div>
                <div class="xzz-value fr" id="indexF">Loading...</div>
              </li>
              <li>
                <div class="xzz-label fl">Avg. Ticket</div>
                <div class="xzz-value fr" id="indexG">Loading...</div>
              </li>
              <li>
                <div class="xzz-label fl">Share Of Receipts</div>
                <div class="xzz-value fr" id="indexH">Loading...</div>
              </li>
              <li style="border-bottom:none;">
                <div class="xzz-label fl">Share Of T/O</div>
                <div class="xzz-value fr" id="indexI">Loading...</div>
              </li>
            </div>
          </div>
        </div>
        <div class="col-xs-3 padding-right-0">
          <div class="xzz-panel">
            <div class="u2">
              <li style="border-bottom:none;">
                <h2>Individual Spending</h2>
              </li>
              <li>
                <div class="xzz-label fl">New</div>
                <div class="xzz-value fr" id="indexJ">Loading...</div>
              </li>
              <li>
                <div class="xzz-label fl">New Repeat</div>
                <div class="xzz-value fr" id="indexK">Loading...</div>
              </li>
              <li>
                <div class="xzz-label fl">Continue</div>
                <div class="xzz-value fr" id="indexL">Loading...</div>
              </li>
              <li style="border-bottom:none;">
                <div class="xzz-label fl">Reactive</div>
                <div class="xzz-value fr" id="indexM">Loading...</div>
              </li>
            </div>
          </div>
        </div>
        <div class="col-xs-3">
          <div class="xzz-panel">
            <div class="u2">
              <li style="border-bottom:none;">
                <h2>Member Quantity</h2>
              </li>
              <li>
                <div class="xzz-label fl">New</div>
                <div class="xzz-value fr" id="indexN">Loading...</div>
              </li>
              <li>
                <div class="xzz-label fl">New Repeat</div>
                <div class="xzz-value fr" id="indexO">Loading...</div>
              </li>
              <li>
                <div class="xzz-label fl">Continue</div>
                <div class="xzz-value fr" id="indexP">Loading...</div>
              </li>
              <li style="border-bottom:none;">
                <div class="xzz-label fl">Reactive</div>
                <div class="xzz-value fr" id="indexQ">Loading...</div>
              </li>
            </div>
          </div>
        </div>  
      </div>
    </div>
    <!-- 指标数值展示 end -->

    <!-- 指标饼图展示 start -->
    <div class="container-fluid m-t-15">
      <div class="row" id="partB">
        <!-- 左侧饼图 start -->
        <div class="col-xs-6 padding-right-0">
          <div class="xzz-panel">
            <div class="pie-wrap">
              <div id="share-of-receipts" class="pie-left"></div>
              <div class="pie-right">
                <ul>
                  <li class="li1"><i></i><p>New<br><span id="indexR">Loading...</span>%</p></li>
                  <li class="li2"><i></i><p>New Repeat<br><span id="indexS">Loading...</span>%</p></li>
                  <li class="li3"><i></i><p>Continue<br><span id="indexT">Loading...</span>%</p></li>
                  <li class="li4"><i></i><p>Reactive<br><span id="indexU">Loading...</span>%</p></li>
                  <li class="li5"><i></i><p>Non member<br><span id="indexV">Loading...</span>%</p></li>
                </ul>
              </div>
              <div class="pie-hover">
                <p>Share OF<br>Receipts</p>
              </div>
            </div>
          </div>
        </div>
        <!-- 左侧饼图 end -->
        <!-- 右侧饼图 start -->
        <div class="col-xs-6">
          <div class="xzz-panel">
            <div class="pie-wrap">
              <div id="share-of-to" class="pie-left"></div>
              <div class="pie-right">
                <ul>
                  <li class="li1"><i></i><p>New<br><span id="indexW">Loading...</span>%</p></li>
                  <li class="li2"><i></i><p>New Repeat<br><span id="indexX">Loading...</span>%</p></li>
                  <li class="li3"><i></i><p>Continue<br><span id="indexY">Loading...</span>%</p></li>
                  <li class="li4"><i></i><p>Reactive<br><span id="indexZ">Loading...</span>%</p></li>
                  <li class="li5"><i></i><p>Non member<br><span id="indexAa">Loading...</span>%</p></li>
                </ul>
              </div>
              <div class="pie-hover">
                <p>Share OF<br>T/O</p>
              </div>
            </div>
          </div>
        </div>
        <!-- 右侧饼图 start -->
      </div>
    </div>
    <!-- 指标饼图展示 end -->

    <!-- 指标条状展示 start -->
    <div class="container-fluid m-t-15">
      <div class="row" id="partC">
        <!-- 左侧条状展示 start -->
        <div class="col-xs-6 padding-right-0">
          <div class="xzz-panel">
            <div class="bar-container">
              <div class="bar-container-inner">
                <div class="bar-text">Receipts Index to Goal</div>
                <div class="bar-wrap">
                  <div class="bar-inner bar-type1">
                    <div class="bar-value"><span id="indexAb">Loading...</span>%</div>
                  </div>
                </div>  
              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-6">
          <div class="xzz-panel">
            <div class="bar-container">
              <div class="bar-container-inner">
                <div class="bar-text">T/O Index to Goal</div>
                <div class="bar-wrap">
                  <div class="bar-inner bar-type2">
                    <div class="bar-value"><span id="indexAc">Loading...</span>%</div>
                  </div>
                </div>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- 指标条状展示 end -->

    <!-- Store,指标 下拉框 start -->
    <div class="container-fluid m-t-15">
      <div class="row">
        <div class="col-xs-2 padding-right-0">
          <div class="xzz-select-wrap" id="store-select2">
            <div class="cur-item"><?=$store_list[0] ?></div>
            <div class="xzz-list">
              <?php foreach($store_list as $value) { ?>
                <div class="item"><?php echo $value ?></div>
              <?php } ?>
            </div>
          </div>
        </div> 
        <div class="col-xs-2 padding-right-0">
          <div class="xzz-select-wrap" id="index-select">
            <div class="cur-item"><?=$excel_head[0] ?></div>
            <div class="xzz-list">
              <?php foreach($excel_head as $value) { ?>
                <div class="item"><?=$value ?></div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Store,指标 下拉框 end -->
  </div>
  <!-- main end -->
</div>
<script src="../vendor/echarts/echarts-all.js"></script>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>