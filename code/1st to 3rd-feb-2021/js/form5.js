function validate(actionsrc) {
    console.log("called " + actionsrc)
    var form = document.getElementById('form');
    if (emailValidate('email')
        && passwordValidate('password')
    ) {

        form.action = actionsrc;
    }
    else {
        alert("enter valid input.");
    }
}
