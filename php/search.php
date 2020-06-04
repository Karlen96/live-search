<?php

	if(!isset($_GET['value'])){
		header('location:../index.php');
		exit();
	}	

	$val = $_GET['value'];
	$conect = mysqli_connect('localhost','root','','city');
						
	if(mysqli_connect_errno()){
		echo 'error to conect database('.mysqli_connect_errno().'):'.mysqli_connect_error();
		exit();
	}

	$reg = "$val";

	$query = "SELECT `name` FROM `countries` WHERE `name` REGEXP('$reg')";
	$search_res = [];
	$result = mysqli_query($conect,$query);
	if($result){
		$rows = mysqli_num_rows($result); 
		for($i = 0;$i<$rows;$i++){
			$arr =  mysqli_fetch_row($result);
			array_push($search_res,$arr[0]);
		}
	}
	mysqli_close($conect);
	$str = json_encode($search_res);
	echo $str;
