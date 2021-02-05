
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach($_POST as $key => $value){
        if($key == 'games'){
            echo $key." : ";
            foreach($_POST['games'] as $checked){
                echo test_input($checked).", ";
            }
            echo "<br>";
        }elseif($key == 'gender'){
            echo $key.": ";
            echo test_input($_POST['gender'])."<br>";
        }elseif($key == 'maritalstaus'){
            echo $key.": ";
            echo test_input($_POST['maritalstaus'])."<br>";
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
$sql = "CREATE TABLE form2 (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30),
    password VARCHAR(32),
    gender VARCHAR(50),
    address VARCHAR(100),
    dob DATE,
    games VARCHAR(50),
    maritalStatus VARCHAR(10)
    )";

//checking table exists or not
if ($mysqli_link->query($sql) === TRUE) {
    echo "Table form2 created successfully<br>";
}else {
    echo $mysqli_link->error."<br>";
}

$name = $_POST['firstname'];
$password = md5($_POST['password']);
$gender = $_POST['gender'];
$address = $_POST['address'];
$dob = $_POST['dob'];
$games ="";
$maritalStatus = $_POST['maritalstatus'];


foreach($_POST['games'] as $checked => $value){
    $games = $games.$value.", ";
}   

//sql query
$sql = "INSERT INTO form2 (name, password, gender, address, dob, games, maritalStatus)
        VALUES ('$name', '$password', '$gender', '$address', '$dob', '$games', '$maritalStatus')";

//insert query
if(mysqli_query($mysqli_link, $sql)){
    echo "record added.";
}else {
    echo "error.";
}

?>
