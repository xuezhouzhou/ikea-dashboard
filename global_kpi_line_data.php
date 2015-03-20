<?php
//$_GET['index'] = 'Member Quantity';
//$_GET['report'] = 'FY14 RP1';
//$_GET['storeChecked'] = '058TJ,164WX';

if(empty($_GET['report']) || empty($_GET['index']) || empty($_GET['storeChecked'])) exit('Not Access!');

$index = $_GET['index'];
$report = $_GET['report'];
$storeChecked = $_GET['storeChecked'];

include_once './includes/init.php'; 

$report_arr = array();
foreach($report_list as  $value){
	$report_arr[] = $value['report'];
}

$key = array_search($report,$report_arr);

$arr_range = array();
if($key>=12){
	$j = $key-12;	
}else{
	$j = 0;	
}

for($i=$key;$i>=$j;$i--){
	$arr_range[$i] = $report_arr[$i];	
}




$data = array();

$store_range = explode(',',$storeChecked);
//$store_range = array('058TJ','164WX');





//根据index筛选
foreach($store_range as $value1){
	foreach($arr_all as $value2){
		if($value2['Store']==$value1){
			$arr_temp = array();
			$arr_temp['num'] = format_value($value2[$index]);
			$arr_temp['report'] = $value2['Report'];
			$arr_temp['store'] = $value2['Store'];
			$data[] = $arr_temp;
		}
	}
}

$dataFinal = array();

//根据report筛选
foreach($data as $k=>$v){
	if(in_array($v['report'],$arr_range)){
		$dataFinal[] = $v;	
	}
}
//dump($dataFinal);
echo json_encode($dataFinal);