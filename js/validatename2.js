function validateName2() {
    let name = $('#name2');
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

function submitForm2() {
    $('.form-2').submit(function (event) {
        let form = event.target
        if (validateName2()) {
            form.submit()
            return true;
        }
        else {
            event.preventDefault()
        }
    })
}

$(document).ready(function() {
    $('#name2').keyup(function () {
        validateName2();
    });
    submitForm2()
});