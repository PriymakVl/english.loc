$(document).ready(function() {

    i = 0;

    $('#start').click(function(event) {
        event.preventDefault();
        $(this).hide();
        $('#stop').show();
        let words = this.dataset.soundsStr.split(';');
        if (!words) return alert('Нет слов');

        let timerId = setInterval(play, 9000, words);

        if (i > words.length) {
            clearInterval(timerId)
            alert('Слова пройдены');
        }
    });

    $('#stop').click(function(event) {
        event.preventDefault();
        location.reload();
    });
});

function play(words) {
    document.querySelectorAll('.card').forEach(item => { $(item).fadeOut('slow'); });
    let arr = words[i].split(':');

    setTimeout(player, 1000, arr[0]);
    setTimeout(player, 6000, arr[1]);
    setTimeout(show_box_en, 3000, arr[2]);
    setTimeout(show_box_ru, 6000, arr[3]);
    i++;
    show_statistics(i, words)
}


function player(filename) {
    sound = new Audio('/web/sounds/' + filename);
    sound.play(); 
}

function show_box_en(word) {
    $('#engl').fadeIn('slow').text(word);
}

function show_box_ru(word) {
    $('#ru').fadeIn('slow').text(word);
}

function show_statistics(i, words) {
    word_all.innerText = words.length;
    word_sounded.innerText = i;
    word_rest.innerText = words.length - i;
}
