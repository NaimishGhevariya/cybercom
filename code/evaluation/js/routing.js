
function redirect(formid, pageName) {
    console.log("redirect called");
    form = document.getElementById(formid);

    if (pageName == 'login') {
        /*if (formid) {
            form.action = 'login.html';
            console.log(document.getElementById(formid).action);
            console.log("redirected to login");
        } else {
            window.location.href = 'login.html';
        }*/
        window.location.href = 'login.html';
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

function registerAdmin() {

    var adminDetails = {};
    var name, email, password, confirmPassword, city, state;
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
    var email, password, admin, userExists;
    var users = [];
    email = document.getElementById('email').value;
    password = document.getElementById('password').value;

    admin = JSON.parse(localStorage.getItem('adminDetails'));
    users = JSON.parse(localStorage.getItem('userDetails'));


    if ((email == admin.email) && (password == admin.password)) {
        redirect('loginForm', 'dashbord');
    } else {
        for (i in users) {
            if ((email == users[i].email)) {
                userExists = true;
                var pwd = users[i].password;
                if (password == pwd) {
                    redirect('loginForm', 'subuser');
                    break;
                }
                else alert("invalid password !!");
            } else {
                userExists = false;
            }
        }

        if (userExists == false) {
            alert("user does noe exists");
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
localStorage.clear();
localStorage.setItem("userDetails", JSON.stringify(userDetails));

*/

var userDetails = [];
userDetails = JSON.parse(localStorage.getItem("userDetails"));
console.log(userDetails);

function formatDate(d) {
    var date = new Date(d)
    return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
}
function getAge(date) {
    var d = new Date(date)
    var dt = new Date();
    return dt.getFullYear() - d.getFullYear();
}

function createTable(tableId) {
    var table, name, email, password, dob, age, action;
    table = document.getElementById(tableId);

    for (i in userDetails) {
        row = table.insertRow(i);
        row.id = "data" + i;
        name = row.insertCell(0);
        email = row.insertCell(1);
        password = row.insertCell(2);
        dob = row.insertCell(3);
        age = row.insertCell(4);
        action = row.insertCell(5);

        name.innerHTML = userDetails[i].name;
        email.innerHTML = userDetails[i].email;
        password.innerHTML = userDetails[i].password;
        dob.innerHTML = formatDate(userDetails[i].dob);
        age.innerHTML = getAge(userDetails[i].dob);
        action.innerHTML = '<button id="edit' + i + '" onclick="editUser(this.id)">Edit</button> <button  id="delete' + i + '" onclick="deleteUser(this.id)">Delete</button>';
    }
}

function addUser() {
    var user = {};
    document.getElementById('actionTitle').innerHTML = "Add User";
    document.getElementById('addUserbtn').value = 'add user';

    user.name = document.getElementById('name').value;
    user.email = document.getElementById('email').value;
    user.password = document.getElementById('password').value;
    user.dob = document.getElementById('dob').value;
    user.age = getAge(user.dob);

    if (localStorage.getItem('userDetails')) {
        userDetails = JSON.parse(localStorage.getItem('userDetails'));
        console.log(userDetails);
        userDetails.push(user);
        localStorage.setItem("userDetails", JSON.stringify(userDetails));
    }
    else {
        userDetails.push(user);
        localStorage.setItem("userDetails", JSON.stringify(userDetails));
    }
}


function deleteUser(id) {
    var rowNo = document.getElementById(id).parentElement.parentNode.rowIndex;
    console.log(rowNo - 1);
    document.getElementById("userListTable").deleteRow(rowNo - 1);
    userDetails.splice(rowNo - 1, 1);
    localStorage.setItem('userDetails', JSON.stringify(userDetails));
}

function editUser(id) {
    document.getElementById('actionTitle').innerHTML = "Edit User";
    document.getElementById('addUserbtn').id = 'updateUserbtn';
    document.getElementById('updateUserbtn').value = 'update user';
    var rowNo = document.getElementById(id).parentElement.parentNode.rowIndex;

    document.getElementById('name').value = userDetails[rowNo - 1].name;
    document.getElementById('email').value = userDetails[rowNo - 1].email;
    document.getElementById('password').value = userDetails[rowNo - 1].password;
    document.getElementById('dob').value = userDetails[rowNo - 1].dob;

    document.getElementById('updateUserbtn').onclick = () => {
        userDetails[rowNo - 1].name = document.getElementById('name').value;
        userDetails[rowNo - 1].email = document.getElementById('email').value;
        userDetails[rowNo - 1].password = document.getElementById('password').value;
        userDetails[rowNo - 1].dob = document.getElementById('dob').value;
        localStorage.setItem('userDetails', JSON.stringify(userDetails));
    }
}



function logout() {
    redirect('', 'login');
}