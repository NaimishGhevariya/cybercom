console.log("GENERAL LINKED !!");
function textValidate(id) {
    var x = document.getElementById(id).value;
    if (x == "") {
        console.log("name not entered.");
        alert(id);
        return false;
    } else return true;
}

function passwordValidate(id) {
    var x = document.getElementById(id).value;
    if (x == "") {
        console.log("password not entered.")
        alert(id);
        return false;
    } else return true;
}

function textareaValidate(id) {
    var x = document.getElementById(id).value;
    if (x == "") {
        console.log("address not added");
        alert(id);
        return false;
    }
    else return true;
}

function groupValidate(name) {
    var element = document.getElementsByName(name);
    console.log(element);
    var flag = false;
    for (i = 0; i <= element.length - 1; i++) {
        if (element[i].checked) {
            flag = true;
        }
    }
    if (flag == true) {
        console.log(name + "returned");
        return true;
    } else {
        console.log(name + " not entered");
        alert(name);
        return false;
    }
}

function selectValidate(id) {
    select = document.getElementById(id);
    if (select.value != "") {
        return true;
    } else {
        console.log(id + "select options");
        alert(id);
        return false;
    }
}

function fileValidate(id) {
    var x = document.getElementById(id).value;
    if (x == "") {
        console.log("file not added");
        alert(id);
        return false;
    }
    else return true;
}

function dateValidate(id) {
    console.log("dob date");
    var x = document.getElementById(id).value;
    if (x == "") {
        console.log("dob not selected");
        alert(id);
        return false;
    }
    else return true;
}

function emailValidate(id) {
    var x = document.getElementById(id).value;
    if (x == "") {
        console.log("email not entered.");
        alert(id);
        return false;
    } else return true;
}

function phoneValidate(id) {
    var x = document.getElementById(id).value;
    if (x == "") {
        console.log("phone number not entered.");
        alert(id);
        return false;
    } else return true;
}

function confirmPassword(pass, confpass) {
    var password = document.getElementById(pass).value;
    var confpassword = document.getElementById(confpass).value;

    if (password === confpassword) {
        return true;
    } else {
        console.log("password does not match");
        alert("password mismatched");
        return false;
    }
}