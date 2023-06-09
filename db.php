<?php
	function connect() {

		$link = mysqli_connect("localhost", "root", "root");

		if ($link == false){
			print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
		}
		else {
			$link->query("SET NAMES utf8");
		}
		return $link;
	}
	
	$upd_script = "
		if (this.textContent != this.abbr) {
			alert(this.id + '\\n' + this.textContent + '\\n' + this.abbr);
			alert('=!!=');
			alert('=2=');
		}
	";

	function list_query($result, $cols, $a_ops = []) {
		$options = ['border'=>1, 'cellpadding'=>1, 'cellspacing'=>1];				
		foreach ($a_ops as $key => $value) {$options[$key] = $value;};				
		echo '<div style="margin-right: 20px"><div><table ';
		foreach ($options as $key => $value) {echo $key . '="' . $value . '" ';};
		echo '><tr><th>' . implode('</th><th>', $cols) . '</th></tr></table></div><div contenteditable style="overflow-x: auto; height: 100%;"><table ';		
		foreach ($options as $key => $value) {echo $key . '="' . $value . '" ';};
		echo '>';
		foreach($result as $row) {
			echo "<tr>";
			foreach($cols as $col)
				//echo sprintf('<td id="%s" abbr="%s" contenteditable onblur="alert(this.id + \'\\n\' + this.textContent + \'\\n\' + this.abbr)">%s</td>', $row["Номер"], $row[$col], $row[$col]);
				echo sprintf('<td id="%s" abbr="%s" contenteditable onblur="%s">%s</td>', $row["Номер"], $row[$col], $GLOBALS['upd_script'], $row[$col]);
				//echo sprintf('<td id="%s" abbr="%s" contenteditable onblur="alert(\'==\')"> %s </td>', $row["Номер"], $row[$col], $row[$col]);
			echo "</tr>";
		}
		echo '</table></div></div>';
	}
	// var s; for (var key in document.activeElement) { s += key + \'\\n\'; };  document.write(s+\'\\n\');
	// for (var key in document.activeElement) { if (document.activeElement[key] !== undefined) document.write(key + \' - (\' + document.activeElement[key]) + document.writeln(\'\n)    ---    \'); alert(document.activeElement.text())};
	// alert(document.activeElement.textContent)
	// alert(this.id + \'\\n\' + this.textContent)
?>
