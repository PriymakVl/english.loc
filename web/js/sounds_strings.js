$(document).ready(function() {

    i = 0;

    $('#start').click(function(event) {
        event.preventDefault();
        $(this).hide();
        $('#stop').show();
        let strings = this.dataset.strings.split(';');
        if (!strings) return alert('Нет строк');
        // play_all(15000, strings);

        let timerId = setInterval(play, 15000, strings);

        if (i > strings.length) {
            clearInterval(timerId)
            alert('Слова пройдены');
        }
    });

    $('#stop').click(function(event) {
        event.preventDefault();
        location.reload();
    });

});

function play(strings) {
    document.querySelectorAll('.card').forEach(item => { $(item).fadeOut('slow'); });
    let arr = strings[i].split(':');
    console.log(arr);
    setTimeout(player, 1000, arr[0]);
    setTimeout(player, 10000, arr[1]);
    setTimeout(show_box_en, 5000, arr[2]);
    setTimeout(show_box_ru, 10000, arr[3]);
    i++;
    show_statistics(strings)
}


function player(filename) {
    sound = new Audio('/web/sounds/' + filename);
    sound.play(); 
}

function show_box_en(phrase) {
    $('#engl').fadeIn('slow').text(phrase);
}

function show_box_ru(phrase) {
    $('#ru').fadeIn('slow').text(phrase);
}

function show_statistics(strings) {
    str_all.innerText = strings.length;
    str_sounded.innerText = i;
    str_rest.innerText = strings.length - i;
}

// function play_strings(strings) 
// {
//     document.querySelectorAll('.view').forEach(item => {item.style.display = 'none'});
//     let arr = strings[index].split(':');
//     sound = new Audio('/web/sounds/' + arr[0]);
//     sound.play();
//     setTimeout(show_text_box, 5000, 'engl', arr[1]);
//     setTimeout(show_text_box, 10000, 'ru', arr[2]);
//     index++;
//     show_statistics(strings);
//     if (index == strings.length) return alert('Строки пройдены');
// }

// function show_text_box(id, value) {
//     let box = document.getElementById(id);
//     box.style.display = 'block';
//     box.innerText = value;
// }

// function show_statistics(strings) {
//     str_all.innerText = strings.length;
//     str_sounded.innerText = i;
//     str_rest.innerText = strings.length - i;
// }

