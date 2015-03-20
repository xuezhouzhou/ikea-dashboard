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

//存放store_kpi_data.xls中的全部数据
$data = array();

//表头
$excel_head = array();

//dump($ExcelReader->sheets[0]['cells'][1][1]);

for($i=1;$i<=$ExcelReader->sheets[0]['numCols'];$i++){
  $excel_head[] = $ExcelReader->sheets[0]['cells'][1][$i];
}

//$ExcelReader->sheets[0]['numRows']为Excel行数 
for ($i = 2; $i <= $ExcelReader->sheets[0]['numRows']; $i++) { 
  $arr_temp = array();
  
  //$ExcelReader->sheets[0]['numCols']为Excel列数 
  for ($j = 1; $j <= $ExcelReader->sheets[0]['numCols']; $j++) { 
    
    //单元格内容 
    $value = $ExcelReader->sheets[0]['cells'][$i][$j];
    
    if($value==null || empty($value) || $value=="") $value = '0';
    
    $index_name = $excel_head[$j-1];
    
    $arr_temp[$index_name] = $value;
  }
  
  $data[] = $arr_temp; 
}

echo json_encode($data);