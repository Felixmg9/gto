<?php
echo 11111;
$fd = fopen("hello.txt", 'w+') or die("не удалось создать файл");
//fwrite($fd, "Привет мир");
fwrite($fd, $_POST['id'] . ' | ' . $_POST['value']);
//fwrite($fd, count($_POST) . PHP_EOL);
//foreach($_POST as $key => $row)
	//fwrite($fd, $key + '=>' + $row);
	//fwrite($fd, $key . '=>' . $row);
fclose($fd);
//$text = $_POST['text'];
//$output = wordwrap($text, 60, "<br>");
//echo $output;
$link = connect();
$link->query("UPDATE my.my_dict SET `Предмет договора` = `Предмет договора` + ' @ ' WHERE `Номер` = '94' ")
?>