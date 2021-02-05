
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach($_POST as $key => $value){
        echo $key." : ".test_input($value)."<br>";
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
$sql = "CREATE TABLE form4 (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30),
    email VARCHAR(30),
    subject VARCHAR(50),
    message VARCHAR(200)
    )";

//checking table exists or not
if ($mysqli_link->query($sql) === TRUE) {
    echo "Table form4 created successfully<br>";
}else {
    echo $mysqli_link->error."<br>";
}

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];


//sql query
$sql = "INSERT INTO form4 (name, email, subject, message)
        VALUES ('$name', '$email', '$subject', '$message')";

//insert query
if(mysqli_query($mysqli_link, $sql)){
    echo "record added.";
}else {
    echo "error.";
}

?>
