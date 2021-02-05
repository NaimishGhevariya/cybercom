function validate(actionsrc) {

    var form = document.getElementById('form');
    if (textValidate('fname')
        && passwordValidate('password')
        && groupValidate('gender')
        && textareaValidate('address')
        && dateValidate('dob')
        && groupValidate('games[]')
        && groupValidate('maritalstatus')
        && groupValidate('tnc')) {

        form.action = actionsrc;
    }
    else {
        alert("enter valid input.");
    }
}
