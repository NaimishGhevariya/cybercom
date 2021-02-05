function validate(actionsrc) {
    var form = document.getElementById('form');
    if (textValidate('name')
        && passwordValidate('password')
        && textareaValidate('address')
        && groupValidate('games[]')
        && groupValidate('gender')
        && fileValidate('file')) {

        form.action = actionsrc;
    }
    else {
        alert("enter valid input.");
    }
}
