
function redirect(formid, pageName) {
    console.log("redirect called");
    form = document.getElementById(formid);

    if (pageName == 'login') {
        form.action = 'login.html';
        console.log(document.getElementById(formid).action);
        console.log("redirected to login");
    }
    if (pageName == 'register') {
        form.action = 'registration.html';
        console.log(document.getElementById(formid).action);
        console.log("redirected to registration");
    }
}
//localStorage.clear();
function registerAdmin() {
    if (localStorage.getItem('adminDetails')) {
        alert("admin exists.");
        redirect('registerationForm', 'login');
    } else {
        var adminDetails = {};
        var name, email, password, confirmPassword, city, state, terms;
        name = document.getElementById('name').value;
        email = document.getElementById('email').value;
        password = document.getElementById('password').value;
        confirmPassword = document.getElementById('confirmPassword').value;
        city = document.getElementById('city').value;
        state = document.getElementById('state').value;


        if (password == confirmPassword) {
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
}
