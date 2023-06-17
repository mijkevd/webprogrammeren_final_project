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
    $('#start-button').click(function () {
        display_turn();
        let restart_game = $.post('clear_board.php', {call_now: "True"});
    })
    window.setInterval(function () {
        display_board();
        display_names();
    }, 5000);
});


function display_board(callback) {
    let board_html = $.post('readboard.php', {call_now: "True"});
    let board_container = $('#game-container');
    board_html.done(function (data) {
        board_container.empty();
        board_container.append(data.html);
        check_winner();
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

function check_winner() {
    let slots = document.querySelectorAll('.throw');
    for (let slot of slots) {
        slot.addEventListener('click', function () {
            $.post('check_winner.php', {call_now: "True"})
                .done(function (data) {
                    let winner = data['winner'];
                    if (winner === "yellow") {
                        confirm("Player 1 has already won!");
                        $.post('clear_board.php', {call_now: "True"});
                        return true;
                    } else if (winner === "red") {
                        confirm("Player 2 has already won!");
                        $.post('clear_board.php', {call_now: "True"});
                        return true;
                    }
                    return false;
                });
        });
    }
}










