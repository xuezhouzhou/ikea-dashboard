<?php
	header('content-type:text/html;charset=utf-8;');
	session_start();
	if(empty($_POST['pass'])){
		exit('请输入密码!<br><a href="check.html">返回</a>');	
	}else{
		if($_POST['pass']=='ikea2014'){
			$_SESSION['check'] = 'yes';
		}else{
			exit('密码错误!<br><a href="check.html">返回</a>');	
		}
	}
	header('Location:index.php');