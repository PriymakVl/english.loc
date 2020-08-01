$(document).ready(function() {

	$('.card__content span').on('click', function() {
		let text = $(this).attr('title');
		let title = $(this).text();
		$(this).text(text).attr('title', title).toggleClass('green');
	});

	$('.card__hide').click(function() {
		$(this).parent().parent().hide();
		countPhrases();
	});

	// $('.card__learned').click(function() {
	// 	let word_id = $(this).attr('word_id');
	// 	$.get( "/phrase/set-state", { id: word_id } ).done((data) => { $(this).parents('.card').hide(); });
	// 	countPhrases();
	// });

	$('#turn_lang').click(function() {
		let text = $(this).text();
		text = (text == 'English') ? 'Russian' : 'English';
		$(this).text(text);
		let cards = document.querySelectorAll('.card__content span');
		cards.forEach(changeLanguage);
	});
});

function changeLanguage(item) {
	let title = item.innerText;
	let text = item.getAttribute('title');
	$(item).text(text).attr('title', title).toggleClass('green');
}

function countPhrases()
{
	let cards = $('.card:visible');
	document.getElementById('count_phrases').innerText = 'Количество фраз: ' + cards.length;
}