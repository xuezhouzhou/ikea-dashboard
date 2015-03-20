<?php
//屏蔽notice错误
error_reporting(0);

//定义包含文件目录
define('INCLUDE_PATH', str_replace('\\', '/',dirname(__FILE__))."/");

//定义项目目录
define('ROOT_PATH', str_replace('includes/', '',INCLUDE_PATH));

//密码验证
session_start();

if(empty($_SESSION['check'])){
	header('Location:check.html');
	exit;
}


//函数库文件
include INCLUDE_PATH.'functions.php'; 

//Excel读取类
include INCLUDE_PATH.'excel_reader.php'; 

//创建对象 
$ExcelReader = new Spreadsheet_Excel_Reader(); 

//设置文本输出编码 
$ExcelReader->setOutputEncoding('UTF-8'); 

//读取Excel文件 
$ExcelReader->read(ROOT_PATH.'/excel/global_kpi_data.xls'); 

//存放global_kpi_data.xls中的全部数据
$arr_all = array();

//指标列表
$index_list = array();

//考察区间列表
$report_list = array();

//商场列表
$store_list = array();

//表头
$excel_head = array();

//dump($ExcelReader->sheets[0]['cells'][1][1]);

for($i=1;$i<=$ExcelReader->sheets[0]['numCols'];$i++){
	$excel_head[] = $ExcelReader->sheets[0]['cells'][1][$i];
}

$index_list = array_slice($excel_head,3);

//$ExcelReader->sheets[0]['numRows']为Excel行数 
for ($i = 2; $i <= $ExcelReader->sheets[0]['numRows']; $i++) { 
	$arr_allay = array();
	
	//$ExcelReader->sheets[0]['numCols']为Excel列数 
	for ($j = 1; $j <= $ExcelReader->sheets[0]['numCols']; $j++) { 
		//每个单元格内容 
		$value = $ExcelReader->sheets[0]['cells'][$i][$j];
		
		if($value==null || empty($value) || $value=="") $value = '0';
		
		$index_name = $excel_head[$j-1];
		
		$arr_allay[$index_name] = $value;
	}
	
	if($ExcelReader->sheets[0]['cells'][$i][2]=="FY07"){
		$store_list[] = $ExcelReader->sheets[0]['cells'][$i][1];	
	}
	
	if($ExcelReader->sheets[0]['cells'][$i][1]=="058TJ"){
		$arr_temp = array(
			'report' => $ExcelReader->sheets[0]['cells'][$i][2],
			'mark' => $ExcelReader->sheets[0]['cells'][$i][3],
		);
		array_push($report_list,$arr_temp);
	}
	
	$arr_all[] = $arr_allay; 
} 

//dump($index_list);
//dump($report_list);
//dump($store_list);
//dump($excel_head);
//dump($arr_all);