
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach($_POST as $key => $value){
        if($key == 'gender'){
            echo $key.": ";
            echo test_input($_POST['gender'])."<br>";
        }elseif($key == 'confpassword'){
            continue;
        }elseif($key == 'tnc'){
            continue;
        }else{
            echo $key." : ".test_input($value)."<br>";
        }
    }
}

function test_input($data) {
    if(isset($data) && !empty($data)){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }else{
        die("data is epmty");
    } 
}


//inserting to db
$connection_err = 'could not connect !!';
$mysql_host = 'localhost';
$mysql_user = 'admin';
$mysql_pass = 'admin';
$mysqli_db = 'form_db';
//db connection
$mysqli_link = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysqli_db) or die($connection_err);

if($mysqli_link) echo "<br>Connected to db.<br>";
else echo 'not connected.';

// sql to create table
$sql = "CREATE TABLE form3 (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(30),
    lastName VARCHAR(30),
    dob DATE,
    gender VARCHAR(50),
    country VARCHAR(20),
    email VARCHAR(50),
    phone INT(10),
    password VARCHAR(32)
    )";

//checking table exists or not
if ($mysqli_link->query($sql) === TRUE) {
    echo "Table form3 created successfully<br>";
}else {
    echo $mysqli_link->error."<br>";
}

$firstName = $_POST['fname'];
$lastName = $_POST['lname'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$country = $_POST['country'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = md5($_POST['password']);


//sql query
$sql = "INSERT INTO form3 (firstName, lastName, dob, gender, country, email, phone, password)
        VALUES ('$firstName', '$lastName', '$dob', '$gender', '$country', '$email', '$phone','$password')";

//insert query
if(mysqli_query($mysqli_link, $sql)){
    echo "added.";
}else {
    echo "error.";
}


?>
