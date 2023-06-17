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
    display_board();
    display_names();
    display_turn();
    // als je op de start button klikt en even wacht worden de slots weer wit maar de button
    // zelf werkt niet
    $('#start-button').click(function () {
        display_turn();
        let restart_game = $.post('clear_board.php', {call_now: "True"});
        let number_of_games = $('#games-played');
        restart_game.done(function (data) {
            number_of_games.empty();
            number_of_games.append(data.html);
        });
    })
    $('#reset-wins').click(function () {
        let reset_games = $.post('reset_games.php', {call_now: "True"});
        let number_of_games = $('#games-played');
        reset_games.done(function (data) {
            number_of_games.empty();
            number_of_games.append(data.html);
        });
        let reset_wins = $.post('reset_wins.php', {call_now: "True"});
        let number_of_wins = $('#wins-players');
        reset_wins.done(function (data) {
            number_of_wins.empty();
            number_of_wins.append(data.html);
        });

    })
    window.setInterval(function () {
        display_board();
        display_names();
        display_turn();
        get_winner();
    }, 5000);
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
    let winner = $.post('check_winner.php', {call_now: "True"});
    winner.done(function (data) {
        console.log(winner);
    });
}

function reset_board() {
    let restart_game = $.post('clear_board.php', {call_now: "True"});
    let number_of_games = $('#games-played');
    restart_game.done(function (data) {
        number_of_games.empty();
        number_of_games.append(data.html);
    });
}









