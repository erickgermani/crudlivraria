<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
function conectar(){
	$hostdb = '127.0.0.1';
	$userdb = 'root';
	$passdb = '';
	$namedb = 'livrariaonline';
	
	if ($con = mysqli_connect($hostdb,$userdb,$passdb, $namedb) or die()){
		return $con;
	}
	
	else{
		return 0;
	}
}

$con = conectar();
mysqli_set_charset($con, 'utf8');
?>