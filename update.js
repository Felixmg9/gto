function update(a_td, a_id, a_col, a_def_value) {		
	if (a_td.innerText !== a_td.abbr) {
		//alert(a_td.id + '|innerText=' + a_td.innerText + '|abbr=' + a_td.abbr);
		alert(a_id + '|a_col=' + a_col + '|a_def_value=' + a_def_value + '|innerText=' + a_td.innerText);
		fetch('update.php', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
			},
			body: 'id=' + a_td.id + '&field' '&value=' + a_td.innerText
		});
	}
	location.reload();
}