
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
            document.getElementById('registerbtn').disabled = true;
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
    if (pageName == 'subuser') {
        form.action = 'subuser.html';
        console.log(document.getElementById(formid).action);
        console.log("redirected to subuser");
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
    users = JSON.parse(localStorage.getItem('usertDetails'));
    console.log(user);
    if ((email == admin.email) && (password == admin.password)) {
        redirect('loginForm', 'dashbord');
    } else {
        for (user of users) {
            if ((email == user.email)) {
                console.log("email mached");
                if (password == user.password) {
                    redirect('loginForm', 'subuser');
                    break;
                }
                else alert("invalid password !!");
            }
            else {
                alert("user does not exist");
            }
        }
    }
}

/*
userDetails = [
    {
        name: 'abc',
        email: 'abc@bc.a',
        password: '0123456',
        dob: '2020-12-01',
        age: '25'
    },
    {
        name: 'def',
        email: 'def@bc.a',
        password: '5623456',
        dob: '2000-01-01',
        age: '29'
    }, {
        name: 'ghi',
        email: 'ghi@bc.a',
        password: '5632456',
        dob: '1999-05-31',
        age: '22'
    }

]

localStorage.setItem("userDetails", JSON.stringify(userDetails));

*/

var userDetails = [];
userDetails = JSON.parse(localStorage.getItem("userDetails"));
console.log(userDetails);



function getAge(date) {
    var d = new Date(date)
    var dt = new Date();
    return dt.getFullYear() - d.getFullYear();
}

function createTable(tableId) {

    var table = document.getElementById(tableId);
    var name, email, password, dob, age, action;


    for (i in userDetails) {
        row = table.insertRow(i);
        row.id = "data" + i;
        name = row.insertCell(0);
        email = row.insertCell(1);
        password = row.insertCell(2);
        dob = row.insertCell(3);
        age = row.insertCell(4);
        action = row.insertCell(5);
        action.id = "cell" + i;

        name.innerHTML = userDetails[i].name;
        email.innerHTML = userDetails[i].email;
        password.innerHTML = userDetails[i].password;
        dob.innerHTML = userDetails[i].dob;
        age.innerHTML = getAge(userDetails[i].dob);
        action.innerHTML = '<button id="edit' + i + '" onclick="editUser(this.id)">Edit</button> <button  id="delete' + i + '" onclick="deleteUser(this.id)">Delete</button>';
    }
}



var userStorage = [];
var user = {};
if (localStorage.getItem('userDetails')) {
    userStorage = JSON.parse(localStorage.getItem('userDetails'));
}

function addUser() {
    user.name = document.getElementById('name').value;
    user.email = document.getElementById('email').value;
    user.password = document.getElementById('password').value;
    user.dob = document.getElementById('dob').value;
    user.age = 20;

    if (localStorage.getItem('userDetails')) {
        userStorage = JSON.parse(localStorage.getItem('userDetails'));
        console.log(userDetails);
        userStorage.push(user);
        localStorage.setItem("userDetails", JSON.stringify(userStorage));
    }
    else {
        userStorage.push(user);
        localStorage.setItem("userDetails", JSON.stringify(userStorage));
    }

}


function deleteUser(id) {
    var rowIndx = document.getElementById(id).parentElement.parentNode.rowIndex;
    console.log(rowIndx);
    document.getElementById("userListTable").deleteRow(rowIndx - 1);
    var data = [];
    data = localStorage.getItem('userDetails');
    console.log(data);
    data.splice(rowIndx, 1);
    localStorage.setItem('userDetails', data);
}