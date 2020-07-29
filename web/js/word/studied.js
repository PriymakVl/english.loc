$(document).ready(function() {
	$('#studied').click(function() {

		let selectedCheckBoxes = $('input[name="state"]:checked');

		if (selectedCheckBoxes.length == 0) return alert('Не выделены слова');

  		let checkedValues = Array.from(selectedCheckBoxes).map(item => item.value);

  		location.href = '/word/studied?ids=' + checkedValues.join();

	});
});