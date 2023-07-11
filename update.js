function update(a_cell, a_id, a_col, a_def_value) {		
	//alert('!!! - 1');
	if (a_cell.innerText !== a_def_value) {		
		//alert('!!!');
		//alert(a_id + '|a_col=' + a_col + '|a_def_value=' + a_def_value + '|innerText=' + a_cell.innerText);		
		fetch('update.php', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
			},
			body: 'id=' + a_id + '&field=' + a_col + '&value=' + encodeURIComponent(a_cell.innerText)
		});
		//alert(d);
		//alert('//!!!');
	}	
	location.reload();
}

function checkForEnter(e) {
	if (e.keyCode == 13) { 
		e.currentTarget.blur();
	}
}

function new_doc() {
	alert('new_doc');
}