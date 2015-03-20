<?php
if(empty($_GET['report']) || empty($_GET['index'])) exit('Not Access!');

$index = $_GET['index'];
$report = $_GET['report'];

include_once './includes/init.php';

$data = array();

//通过store和index筛选符合的数据
foreach($arr_all as $value){
	if($value['Report']==$report){
		$arr_temp = array();
		$arr_temp['store'] = $value['Store'];
		$arr_temp['num'] = $value[$index];
		$data[] = $arr_temp;
	}
}

//最终数据
$dataFinal = array();
/*
//颜色库
$arr_allColor = array('#FF8F84','#ffe86c','#fd9149','#84fc90','#fbfe73','#9ddefe','#75a4f4','#937ff8','#cf77ff','#ff84c7','#b79dff','#d6fd6c','#fdc1da','#fde32e','#FF8F84');
//随机颜色
shuffle($arr_allColor);
*/

foreach($data as $k=>$v){
	//$v['color'] = $arr_allColor[$k];
	$v['num'] = format_value($v['num']);
	$dataFinal[] = $v;
}

//dump($dataFinal);
echo json_encode($dataFinal);