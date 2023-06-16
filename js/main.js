function validateName1() {
    let name = $('#name1');
    let nameInput = name.val();
    let nameRegex = "^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$";

    if (nameInput.match(nameRegex) && nameInput !== '') {
        // name is valid
        name.removeClass('is-invalid');
        name.addClass('is-valid');
        return true;
    } else {
        // name is invalid
        name.removeClass('is-valid');
        name.addClass('is-invalid');
        return false;
    }
}

function submitForm1() {
    $('.form-1').submit(function (event) {
        let form = event.target
        if (validateName1()) {
            form.submit()
            return true;
        }
        else {
            event.preventDefault()
        }
    })
}
$(document).ready(function() {
    $('#name1').keyup(function () {
        validateName1();
    });
    submitForm1()
});

$(document).ready(function() {
    display_board();
    display_names();
    // als je op de start button klikt en even wacht worden de slots weer wit maar de button
    // zelf werkt niet
    $('#start-button').click(function () {
        display_turn();
        window.setInterval(function () {
            display_turn();
        }, 5000);
    })
    window.setInterval(function () {
        display_board();
        display_names();
        get_winner();
    }, 5000);
    $('#start-button').click(function () {
        $.post('clear_board.php', {call_now: "True"});
    })

});

function display_board() {
    let board_html = $.post('readboard.php', {call_now: "True"});
    let board_container = $('#game-container');
    board_html.done(function (data) {
        board_container.empty();
        board_container.append(data.html);

    });
}

function display_names() {
    let names_html = $.post('readnames.php', {call_now: "True"});
    let name_container = $('.name-container');
    names_html.done(function (data) {
        name_container.empty();
        name_container.append(data.html);
    });
}

function display_turn() {
    let names_html = $.post('readturn.php', {call_now: "True"});
    let currentPlayer = $('.player-turn');
    names_html.done(function (data) {
        currentPlayer.empty();
        currentPlayer.append(data.html);
    });
}

function get_winner() {
    // deze functie werkt niet, omdat winner niet het 'red' of 'yellow' retunt
    // als die dat wel doet dan kunnen we deze gebruiken voor de popups
    let winner = $.get('check_winner.php', {call_now: "True"});
}









