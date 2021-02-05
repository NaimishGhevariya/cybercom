function validate(actionsrc) {

    var form = document.getElementById('form');
    if (textValidate('fname')
        && textValidate('lname')
        && dateValidate('dob')
        && groupValidate('gender')
        && selectValidate('country')
        && emailValidate('email')
        && phoneValidate('phone')
        && passwordValidate('password')
        && passwordValidate('confpassword')
        && confirmPassword('password', 'confpassword')
        && groupValidate('tnc')) {

        form.action = actionsrc;
    }
    else {
        alert("enter valid input.");
    }
}
