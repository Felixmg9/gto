<?php
	//print_r($_SESSION);
	//print_r($_SERVER['PHP_AUTH_USER']);
	$ini_file = fopen(end(explode('\\', getcwd())) . '.ini', "w") or die("отсутствует файл инициализации");
	
?>	