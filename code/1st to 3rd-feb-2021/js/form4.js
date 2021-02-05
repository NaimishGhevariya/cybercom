function validate(actionsrc) {
    console.log("called" + actionsrc)
    var form = document.getElementById('form');
    if (textValidate('name')
        && emailValidate('email')
        && textValidate('subject')
        && textareaValidate('message')
    ) {
        form.action = actionsrc;
    }
    else {
        alert("enter valid input.");
    }
}
