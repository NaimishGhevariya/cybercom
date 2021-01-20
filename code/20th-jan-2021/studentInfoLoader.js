/*var studentDetails = [
    {
        id: 2,
        firstName: 'James',
        lastName: 'Frosty',
        age: 25,
        hobby: 'Swimming',
        //imageUrl: "img1.jpg"
    },
    {
        id: 1,
        firstName: 'Anna',
        lastName: 'Bayo',
        age: 23,
        hobby: 'Cooking',
        //imageUrl: "img2.jpg"
    },
    {
        id: 3,
        firstName: 'James',
        lastName: 'Lartey',
        age: 22,
        hobby: 'Rapping',
        //imageUrl: "img3.jpg"
    }
]
*/
var studentDetails = [];
studentDetails = JSON.parse(localStorage.getItem("studentDetails"));
console.log(studentDetails);


window.onload = () => {
    createTable("mytable");
}


//coe for dynamically adding table and data

function createTable(tableId) {
    var table = document.getElementById('tbody');
    console.log(tableId)
    var id, name, email, dob, mobileno;


    for (i in studentDetails) {
        row = table.insertRow(i);

        id = row.insertCell(0);
        //img = row.insertCell(1);
        name = row.insertCell(1);
        email = row.insertCell(2);
        dob = row.insertCell(3);
        mobileno = row.insertCell(4);

        id.innerHTML = studentDetails[i].id;
        //img.innerHTML = '<img src="' + studentDetails[i].imageUrl + '" alt="' + studentDetails[i].firstName + '">';
        name.innerHTML = studentDetails[i].name;
        email.innerHTML = studentDetails[i].email;
        dob.innerHTML = studentDetails[i].dob;
        mobileno.innerHTML = studentDetails[i].mobileno;

    }
}


// code for sorting the table.

function sortTable() {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("mytable");
    switching = true;
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("td")[0];
            y = rows[i + 1].getElementsByTagName("td")[0];
            if (Number(x.innerHTML) > Number(y.innerHTML)) {
                shouldSwitch = true;
                break;
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}



