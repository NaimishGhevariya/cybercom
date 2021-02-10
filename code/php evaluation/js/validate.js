
var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
//email validation
if (document.getElementById('email').value.match(mailformat)) {
    console.log("valid email entered");
    document.getElementById("email").nextElementSibling.innerHTML = "";
} else {
    validInput = false;
    alert("invalid email entered.");
    console.log("invalid email entered.");
}
//phone validation
if (document.getElementById('phone').value == "") {
    console.log("Phone number not entered.");
    alert("Phone number not entered.");
    document.getElementById("phone").nextElementSibling.innerHTML = "Enter your phone number.";
} else {
    console.log("Phone number entered");
    document.getElementById("phone").nextElementSibling.innerHTML = "";
}
//title validation
if (document.getElementById('title').value == "") {
    console.log("title not entered.");
    alert("title not entered.");
    document.getElementById("title").nextElementSibling.innerHTML = "Enter your title.";
} else {
    console.log("title entered");
    document.getElementById("title").nextElementSibling.innerHTML = "";
}