<?php
function mb_str_pad($str, $len, $delimiter = ' ') {
	while (mb_strlen($str)<30) {
		$str .= $delimiter;
	}
	return $str;
}	


	include 'db.php';
/*	connect();
	die();
*/	
	$tags = ['',''];
	read_ini();	
	foreach ($tags as $n=>$s) {
		foreach ($db_params->columns as $field=>$type) {
			//$p = [['text', $field], ['input', '']];
			
			//$tags[$n] .= tag($p[$n][0], $p[$n][1], ['style'=>'margin-left: 10px; margin-right: 10px']) . '<br>' . '<br>';
			$tags[$n] .= tag($n==0 ? 'text' : 'input', $n==0 ? $field : '', ['style'=>'margin-left: 10px; margin-right: 10px']) . '<br>' . '<br>';
		}
		//echo $n . $s;
	}
	
	/*
			foreach ($db_params->columns as $field=>$type) {		
			$tag = $tag . tag('text', $field, ['style'=>'margin-left: 10px; margin-right: 10px']) . '<br>' . '<br>';
		}		
		$tag = tag('div', $tag, ['style'=>'float:left']);
		foreach ($db_params->columns as $field=>$type) {		
			$tag_i = $tag_i . tag('input', '') . '<br>' . '<br>';
		}		
		$tag_i = tag('div', $tag_i, ['style'=>'float:left']);
	*/
	
	print_r($tags);
	$field = "Пре";
	while (mb_strlen($field)<30) $field .= '@';
	//echo mb_strlen($field) . '--' . mb_strpad($field, 33, "@") . PHP_EOL;
	$field = "sasasasasaasasas";
	//echo mb_str_pad($field, 30, '~') . PHP_EOL;
	
	//echo str_pad('---', 30, "@", STR_PAD_RIGHT);
	die();
	//$ini_file_name = end(explode('\\', getcwd())) . '.ini';
	$ini_file = fopen('test.ini', 'w');
	$s = array('a' => 'a', 'b' => array('b' => 'awdas', 'ds'));
	//$db_params = json_decode(fread($ini_file, filesize($ini_file_name)));
	//fread($ini_file,$s);
	print_r($s);
	fwrite($ini_file, json_encode($s));
	fclose($ini_file);

?>	