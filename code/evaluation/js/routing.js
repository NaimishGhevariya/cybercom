
function redirect(formid, pageName) {
    console.log("redirect called");
    form = document.getElementById(formid);

    if (pageName == 'login') {
        form.action = 'login.html';
        console.log(document.getElementById(formid).action);
        console.log("redirected to login");
    }
    if (pageName == 'register') {
        if (localStorage.getItem('adminDetails')) {
            alert("admin exists.");
            redirect('registerationForm', 'login');
        } else {
            form.action = 'registration.html';
            console.log(document.getElementById(formid).action);
            console.log("redirected to registration");
        }
    }
    if (pageName == 'dashbord') {
        form.action = 'dashbord.html';
        console.log(document.getElementById(formid).action);
        console.log("redirected to dashbord");
    }
}
//localStorage.clear();
function registerAdmin() {

    var adminDetails = {};
    var name, email, password, confirmPassword, city, state, terms;
    name = document.getElementById('name').value;
    email = document.getElementById('email').value;
    password = document.getElementById('password').value;
    confirmPassword = document.getElementById('confirmPassword').value;
    city = document.getElementById('city').value;
    state = document.getElementById('state').value;

    if ((password == confirmPassword)) {
        adminDetails.name = name;
        adminDetails.email = email;
        adminDetails.password = password
        adminDetails.city = city;
        adminDetails.state = state;

        console.log(adminDetails);

        localStorage.setItem("adminDetails", JSON.stringify(adminDetails));
        alert("admin added !!");
        redirect('registerationForm', 'login');
    } else {
        alert("enter valid input");
    }

}

function login() {
    var email, password, admin;
    email = document.getElementById('email').value;
    password = document.getElementById('password').value;

    admin = JSON.parse(localStorage.getItem('adminDetails'));

    console.log(admin.email);
    console.log(admin.password);
    console.log(email);
    console.log(password);
    if ((email == admin.email) && (password == admin.password)) {
        redirect('loginForm', 'dashbord');
    } else if (x) {
        //
    }
    else {
        alert("user does not exist");
    }
}

userDetails = [
    {
        name: 'abc',
        email: 'abc@bc.a',
        password: '0123456',
        dob: '2020-12-1',
        age: '25'
    },
    {
        name: 'def',
        email: 'def@bc.a',
        password: '5623456',
        dob: '2000-1-1',
        age: '29'
    }, {
        name: 'ghi',
        email: 'ghi@bc.a',
        password: '5632456',
        dob: '1999-5-31',
        age: '22'
    }

]

localStorage.setItem("userDetails", JSON.stringify(userDetails));

function _calculateAge(birthday) { // birthday is a date
    console.log("calculat function");
    var ageDifMs = Date.now() - birthday.getTime();
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    return Math.abs(ageDate.getUTCFullYear() - 1970);
}

window.onload = () => {
    createTable("userListTable");
}

function createTable(tableId) {
    console.log("table function");
    var table = document.getElementById(tableId);
    console.log(tableId)
    var id, name, email, dob, mobileno;


    for (i in userDetails) {
        row = table.insertRow(i);

        name = row.insertCell(0);
        email = row.insertCell(1);
        password = row.insertCell(2);
        dob = row.insertCell(3);
        age = row.insertCell(4);
        action = row.insertCell(5);

        name.innerHTML = userDetails[i].name;
        email.innerHTML = userDetails[i].email;
        password.innerHTML = userDetails[i].password;
        dob.innerHTML = userDetails[i].dob;
        age.innerHTML = _calculateAge(userDetails[i].dob);
        action.innerHTML = '<a href="" id="edit">Edit</a> <a href="" id="delete">Delete</a>';

    }
}


