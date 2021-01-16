var studentDetails = [
    {
        id: 1,
        firstName: 'James',
        lastName: 'Frosty',
        age: 25,
        hobby: 'Swimming',
        imageUrl: "img1.jpg"
    },
    {
        id: 2,
        firstName: 'Anna',
        lastName: 'Bayo',
        age: 23,
        hobby: 'Cooking',
        imageUrl: "img2.jpg"
    },
    {
        id: 3,
        firstName: 'James',
        lastName: 'Lartey',
        age: 22,
        hobby: 'Rapping',
        imageUrl: "img3.jpg"
    }
]

console.log(studentDetails);
/*
for ( i in studentDetails){
    document.getElementById("studentInfo").innnerHTML = "<tr><td>" + studentDetails[i].id +"</td><td><img src=" + studentDetails[i].imageUrl + " alt=" + studentDetails[i].firstName +"'s image></td><td>" +studentDetails[i].firstName +"</td><td>" +studentDetails[i].lastName +"</td><td>" + studentDetails[i].age +"</td><td><a>"+studentDetails[i].hobby+"</a></td></tr>";
}
*/

function myCreateFunction(tableId) {
    var table = document.getElementsByTagName(table);
    console.log(tableId)
    var row;
    var id, img, fname, lname, age, hby;


    for (i in studentDetails) {
        console.log(i);
        row = table.insertRow(i);
        console.log(row);

        id = row.insertCell(0);
        img = row.insertCell(1);
        fname = row.insertCell(2);
        lname = row.insertCell(3);
        age = row.insertCell(4);
        hby = row.insertCell(5);

        id.innerHTML = studentDetails[i].id;
        img.innerHTML = studentDetails[i].id;
        fname.innerHTML = studentDetails[i].firstName;
        lname.innerHTML = studentDetails[i].lastName;
        age.innerHTML = studentDetails[i].age;
        hby.innerHTML = studentDetails[i].hobby;
    }
}

myCreateFunction("mytable");
