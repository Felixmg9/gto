<?php
	$db_params = [];

	function read_ini() {
		global $db_params;
		$ini_file_name = end(explode('\\', getcwd())) . '.ini';
		$ini_file = fopen($ini_file_name, 'r');				
		$db_params = json_decode(fread($ini_file, filesize($ini_file_name)));				
		//print_r($db_params);
	}	

	function connect() {
		global $db_params;
		read_ini();
		$link = mysqli_connect($db_params->host, $db_params->username, $db_params->pwd);

		if ($link == false){
			print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
		}
		else {
			$link->query("SET NAMES utf8");			
		}
		return $link;
	}
	
	function tag($tag, $block, $params = [])
	{	$open_tag = $tag;
		foreach ($params as $key => $value) {
			$open_tag = $open_tag . ' ' . $key;
			if ($value)	{
				$open_tag = $open_tag . '="' . $value . '"'; 
			}
		};
		return '<' . $open_tag . '>' . PHP_EOL  . $block . PHP_EOL . '</' . $tag . '>';
	};

	function list_query($result, $cols, $a_ops = []) {  //----------------------------------------------------
		$options = ['border'=>1, 'style'=>'table-layout: fixed; width:100%;' ];
		foreach ($a_ops as $key => $value) { $options[$key] = $value; };

		$thead = '';
		foreach ($cols as $value => $type) { $thead = $thead . PHP_EOL . tag('th', $value); };
		$thead = tag('tr', $thead);
		$thead = tag('thead', $thead);
		$thead = tag('table', $thead, $options);
		$thead = tag('div', $thead, ['style'=>'margin-right: 20px']);

		$tbody = '';
		foreach($result as $row) {
			$td = '';
			
			foreach ($cols as $value => $type) { 
				
				if ($type !== 'text') {
					$row[$value] = $row[$value] . '|';
					$opt = [];
				}
				else {
					//print_r($row);
					//print_r("\n\n");
					$opt = ['contenteditable'=>'', 'onblur'=>sprintf("update(this, '%s', '%s', '%s')", $row['id'], $value, $row[$value]),
						'onkeydown'=>"checkForEnter(event)"];				
				}
				$td = $td . PHP_EOL . tag('td', $row[$value], $opt);			
			}
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
		
	function new_record() {  // ---------------------------------------------		
		$tags = ['',''];
		read_ini();		
		global $db_params;
			
		foreach ($tags as $n=>$s) {
			foreach ($db_params->columns as $field=>$type) {
				$tags[$n] .= tag($n==0 ? 'text' : 'input', $n==0 ? $field : '', 
					['style'=>'margin-left: 10px; margin-right: 10px']) . '<br>' . '<br>';
			}
			$tags[$n] = tag('div', $tags[$n], ['style'=>'float:left']);
		};
		$tags[0] .= $tags[1] . '<br>' . tag('button', 'поиск', ['name'=>'поиск']);
		echo tag('dialog', $tags[0], ['id'=>'newDoc']);		
		echo tag('script', 'document.getElementById("newDoc").showModal();');
	}
	
	// var s; for (var key in document.activeElement) { s += key + \'\\n\'; };  document.write(s+\'\\n\');
	// for (var key in document.activeElement) { if (document.activeElement[key] !== undefined) document.write(key + \' - (\' + document.activeElement[key]) + document.writeln(\'\n)    ---    \'); alert(document.activeElement.text())};
	// alert(document.activeElement.textContent)
	// alert(this.id + \'\\n\' + this.textContent)
?>