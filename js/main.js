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
    window.setInterval(function () {
        display_board();
        display_names();
        display_turn()
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
        name_container.empty();
        currentPlayer.append(data.html);
    });
}

document.addEventListener("DOMContentLoaded", function() {
const winningArrays = [ //All possible arrays to have four in a row
        [0, 1, 2, 3],
        [41, 40, 39, 38],
        [7, 8, 9, 10],
        [34, 33, 32, 31],
        [14, 15, 16, 17],
        [27, 26, 25, 24],
        [21, 22, 23, 24],
        [20, 19, 18, 17],
        [28, 29, 30, 31],
        [13, 12, 11, 10],
        [35, 36, 37, 38],
        [6, 5, 4, 3],
        [0, 7, 14, 21],
        [41, 34, 27, 20],
        [1, 8, 15, 22],
        [40, 33, 26, 19],
        [2, 9, 16, 23],
        [39, 32, 25, 18],
        [3, 10, 17, 24],
        [38, 31, 24, 17],
        [4, 11, 18, 25],
        [37, 30, 23, 16],
        [5, 12, 19, 26],
        [36, 29, 22, 15],
        [6, 13, 20, 27],
        [35, 28, 21, 14],
        [0, 8, 16, 24],
        [41, 33, 25, 17],
        [7, 15, 23, 31],
        [34, 26, 18, 10],
        [14, 22, 30, 38],
        [27, 19, 11, 3],
        [35, 29, 23, 17],
        [6, 12, 18, 24],
        [28, 22, 16, 10],
        [13, 19, 25, 31],
        [21, 15, 9, 3],
        [20, 26, 32, 38],
        [36, 30, 24, 18],
        [5, 11, 17, 23],
        [37, 31, 25, 19],
        [4, 10, 16, 22],
        [2, 10, 18, 26],
        [39, 31, 23, 15],
        [1, 9, 17, 25],
        [40, 32, 24, 16],
        [9, 17, 25, 33],
        [8, 16, 24, 32],
        [11, 17, 23, 29],
        [12, 18, 24, 30],
        [1, 2, 3, 4],
        [5, 4, 3, 2],
        [8, 9, 10, 11],
        [12, 11, 10, 9],
        [15, 16, 17, 18],
        [19, 18, 17, 16],
        [22, 23, 24, 25],
        [26, 25, 24, 23],
        [29, 30, 31, 32],
        [33, 32, 31, 30],
        [36, 37, 38, 39],
        [40, 39, 38, 37],
        [7, 14, 21, 28],
        [8, 15, 22, 29],
        [9, 16, 23, 30],
        [10, 17, 24, 31],
        [11, 18, 25, 32],
        [12, 19, 26, 33],
        [13, 20, 27, 34],
    ];

    let currentplayer = 1;

    function updateTurn(newTurn) {
        $.ajax({
            url: 'update_turn.php',
            method: 'POST',
            data: {newTurn: newTurn}
        })
    }
    function stacking() {
        for (let i = 0; i < slots.length - 7; i++) {
            slots[i].addEventListener('click', handleClick);
        }
    }

    function handleClick(e) {
        turns = turns + 1;
        const targetIndex = Array.from(slots).indexOf(e.target);
        const columnIndex = targetIndex % 7;
        let stackIndex = columnIndex + 35;

        while (stackIndex >= columnIndex && slots[stackIndex].style.backgroundColor !== '') {
            stackIndex -= 7;
        }
        if (stackIndex >= columnIndex) {
            if (currentplayer === 1) {
                slots[stackIndex].style.backgroundColor = 'yellow';
                slots[stackIndex].classList.add('yellow');
                updateTurn(2)
            } else if (currentplayer === 2) {
                slots[stackIndex].style.backgroundColor = 'red';
                slots[stackIndex].classList.add('red');
               updateTurn(1)
            }
            checkwins()
            // Disable click event for the current slot
            slots[targetIndex].removeEventListener('click', handleClick);

            // Enable click event for other slots
            for (let i = 0; i < slots.length - 7; i++) {
                slots[i].addEventListener('click', handleClick);
            }
        }
    }


    function checkwins() {
        for (let x = 0; x < winningArrays.length; x++) {
            const slot1 = slots[winningArrays[x][0]]
            const slot2 = slots[winningArrays[x][1]]
            const slot3 = slots[winningArrays[x][2]];
            const slot4 = slots[winningArrays[x][3]];
            if (
                slot1.classList.contains('red') &&
                slot2.classList.contains('red') &&
                slot3.classList.contains('red') &&
                slot4.classList.contains('red')
            ) {
                const confirmed = confirm("Player 2 has won!");
                result.textContent = "Player 2 won!";
            }
            else if (
                slot1.classList.contains('yellow') &&
                slot2.classList.contains('yellow') &&
                slot3.classList.contains('yellow') &&
                slot4.classList.contains('yellow')
            ) {
                const confirmed = confirm("Player 1 has won!");
                result.textContent = "Player 1 won!";
            }
        }
    }
    
    function startGame() {
        playerTurn.textContent = "Player 1's turn";
        var currentplayer = 1;
        slots.forEach(slot => {
            slot.style.backgroundColor = '';
            slot.classList.remove('taken');
        });
        stacking();
    }

        function stopGame() {
        const confirmed = confirm("Are you sure you want to stop?");
        if (confirmed) {
            window.location.href = "index.php";
        }
    }

    var playerTurn = document.querySelector('.player-turn').textContent;
    const slots = document.querySelectorAll('.slot');
    const startButton = document.getElementById("start-button");
    startButton.addEventListener("click", startGame);
    var result = document.querySelector('#result')
    const stopButton = document.getElementById("stop-button");
    stopButton.addEventListener("click", function() { stopGame(); });
    checkwins();
});




