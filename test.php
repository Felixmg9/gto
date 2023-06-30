<?php
	/*include 'db.php';
	connect();
	die();
*/
	//$ini_file_name = end(explode('\\', getcwd())) . '.ini';
	$ini_file = fopen('test.ini', 'w');
	$s = array('a' => 'a', 'b' => array('b' => 'awdas', 'ds'));
	//$db_params = json_decode(fread($ini_file, filesize($ini_file_name)));
	//fread($ini_file,$s);
	print_r($s);
	fwrite($ini_file, json_encode($s));
	fclose($ini_file);

?>	