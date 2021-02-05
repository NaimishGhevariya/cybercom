
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
$sql = "CREATE TABLE form5 (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(30),
    password VARCHAR(32)
    )";

//checking table exists or not
if ($mysqli_link->query($sql) === TRUE) {
    echo "Table form5 created successfully.<br>";
}else {
    echo $mysqli_link->error."<br>";
}

$email = $_POST['email'];
$password = md5($_POST['password']);

//sql query
$sql = "INSERT INTO form5 (email, password)
        VALUES ('$email', '$password')";

//insert query
if(mysqli_query($mysqli_link, $sql)){
    echo "record added.";
}else {
    echo $mysqli_link->error;
}

?>
