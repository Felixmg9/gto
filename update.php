<?php
$fd = fopen("hello.txt", 'w+') or die("не удалось создать файл");
	//fwrite($fd, "Привет мир");
fwrite($fd, $_POST['id'] . ' | ' . $_POST['value']);
	//fwrite($fd, count($_POST) . PHP_EOL);
	//foreach($_POST as $key => $row)
		//fwrite($fd, $key + '=>' + $row);
		//fwrite($fd, $key . '=>' . $row);
	
	//$text = $_POST['text'];
	//$output = wordwrap($text, 60, "<br>");
	//echo $output;
require 'db.php';
$link = connect();
//$sql = "UPDATE my.my_dict SET `Предмет договора` = CONCAT(`Предмет договора`, '" . $_POST['value'] . "') WHERE `Номер` = '94' ";
$sql = sprintf("UPDATE my.my_dict SET `Предмет договора` = '%s' WHERE `Номер` = '%d' ", $_POST['value'], $_POST['id']);
if ($link->query($sql)) {
	fwrite($fd, PHP_EOL . 'ERROR - ' . $sql);
}	
fclose($fd);
?>