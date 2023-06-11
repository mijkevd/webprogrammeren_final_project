document.addEventListener("DOMContentLoaded", function() {

var playerTurn = document.querySelector('.player-turn');
const slots = document.querySelectorAll('.slot');

for (let i = 0; i < 7; i ++){
    slots[0].addEventListener('click', (e) => {
        slots[35].style.backgroundColor = 'red';
    });
    slots[1].addEventListener('click', (e) => {
        slots[36].style.backgroundColor = 'red';
    });
    slots[2].addEventListener('click', (e) => {
        slots[37].style.backgroundColor = 'red';
    });
    slots[3].addEventListener('click', (e) => {
        slots[38].style.backgroundColor = 'red';
    });
    slots[4].addEventListener('click', (e) => {
        slots[39].style.backgroundColor = 'red';
    });
    slots[5].addEventListener('click', (e) => {
        slots[40].style.backgroundColor = 'red';
    });
    slots[6].addEventListener('click', (e) => {
        slots[41].style.backgroundColor = 'red';
    });
}
});


