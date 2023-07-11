<?php
	$fd = fopen("hello.txt", 'w+') or die("не удалось создать файл");
		fwrite($fd, "Привет мир");
		fclose($fd);
?>