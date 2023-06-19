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
		/*alert('=!!=');*/
		var context = this.textContent.substring(1, this.textContent.length-1);
		if (context !== this.abbr) {		
			alert(this.textContent.charCodeAt(0));
			alert(this.textContent.charCodeAt(this.textContent.length-1));
			alert(this.textContent.charCodeAt(this.textContent.length-2));
			alert(this.id + '\\n' + '|' + context + '|' + '\\n' + '|' + this.abbr + '|');
			/*alert('=!!=');
			alert('=2=');*/
		}
	";

	function tag($tag, $block, $params = [])
	{	$open_tag = $tag;
		foreach ($params as $key => $value) {$open_tag = $open_tag . ' ' . $key . '="' . $value . '"'; };
		return '<' . $open_tag . '>' . PHP_EOL  . $block . PHP_EOL . '</' . $tag . '>';
	};

	function list_query($result, $cols, $a_ops = []) {
		$options = ['border'=>1, 'style'=>'table-layout: fixed; width:100%;' ];
		foreach ($a_ops as $key => $value) { $options[$key] = $value; };

		$thead = '';
		foreach ($cols as $value) { $thead = $thead . PHP_EOL . tag('th', $value); };
		$thead = tag('tr', $thead);
		$thead = tag('thead', $thead);
		$thead = tag('table', $thead, $options);
		$thead = tag('div', $thead, ['style'=>'margin-right: 20px']);

		$tbody = '';
		foreach($result as $row) {
			$td = '';
			foreach ($cols as $value) { $td = $td . PHP_EOL . tag('td', $row[$value],
				['contenteditable'=>'true', 'id'=>$row["Номер"], 'abbr'=>$row[$value], 'onblur'=>$GLOBALS['upd_script']]
			); };
			$tbody = $tbody . PHP_EOL . tag('tr', $td);
		}
		$tbody = tag('tbody', $tbody);
		$tbody = tag('table', $tbody, $options);
		$tbody = tag('div', $tbody, ['style'=>'overflow-x: auto; height: 100%;']);
		echo $thead . PHP_EOL . $tbody;
		return;
		
		/*
		echo '<div style="margin-right: 20px"><table ';
		foreach ($options as $key => $value) {echo $key . '="' . $value . '" ';};
		echo '><thead><tr><th>' . implode('</th><th>', $cols) . '</th></tr></thead></table></div><div contenteditable style="overflow-x: auto; height: 100%;"><table ';		
		foreach ($options as $key => $value) {echo $key . '="' . $value . '" ';};
		echo '><tbody>';
		foreach($result as $row) {
			echo "<tr>";
			foreach($cols as $col)
				//echo sprintf('<td id="%s" abbr="%s" contenteditable onblur="alert(this.id + \'\\n\' + this.textContent + \'\\n\' + this.abbr)">%s</td>', $row["Номер"], $row[$col], $row[$col]);
				echo sprintf('<td id="%s" abbr="%s" contenteditable onblur="%s">%s</td>', $row["Номер"], $row[$col], $GLOBALS['upd_script'], $row[$col]);
				//echo sprintf('<td id="%s" abbr="%s" contenteditable onblur="alert(\'==\')"> %s </td>', $row["Номер"], $row[$col], $row[$col]);
			echo "</tr>";
		}
		echo '</table></tbody></div></div>';*/
	}
	
	// var s; for (var key in document.activeElement) { s += key + \'\\n\'; };  document.write(s+\'\\n\');
	// for (var key in document.activeElement) { if (document.activeElement[key] !== undefined) document.write(key + \' - (\' + document.activeElement[key]) + document.writeln(\'\n)    ---    \'); alert(document.activeElement.text())};
	// alert(document.activeElement.textContent)
	// alert(this.id + \'\\n\' + this.textContent)
?>