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
        }elseif($key == 'submit'){
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


echo "<br><br>";

$storeToDB = false;
function file_upload($file_attr_name){  
    if(isset($_POST["submit"]) && isset($_FILES[$file_attr_name]["name"])){
        //code for file handeling
        $target_dir = '../uploads/';
        $target_file = $target_dir . basename($_FILES[$file_attr_name]["name"]);
        $FileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $file_temp = $_FILES[$file_attr_name]['tmp_name'];
        echo "file is set<br>";
    }else {
        echo "<br>file not yet set to server <br>";
        die();
    }
    
    if(isset($_POST["submit"]) && isset($_FILES[$file_attr_name]["name"])) {
        echo $file_temp."<br>";

        if ((file_exists($target_file) && $target_file != "uploads/")
        || $_FILES[$file_attr_name]["size"] > 5000000 
        || ($FileType != "jpg" 
            && $FileType != "png" 
            && $FileType != "jpeg" 
            && $FileType != "gif" 
            && $FileType != "docx" 
            && $FileType != "pdf" 
            && $FileType != "txt")){
                echo 'file is not valid or already uploaded !!<br>';
            }else{
                echo 'valid file<br>';
                if(move_uploaded_file($_FILES[$file_attr_name]["tmp_name"], $target_file)){
                    echo "file transfered<br>";
                    $storeToDB = true;
                    echo $target_file."<br>";
                    return $target_file;
                }
            }
    }else{
        echo "upload file again.<br>";
        die();
    }
}

$target_file = file_upload('file');

echo "filr path: ".$target_file."<br>";
echo "<br><br>";

if($target_file != ""){
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
    $sql = "CREATE TABLE form1 (
        id INT(6) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30),
        password VARCHAR(32),
        address VARCHAR(100),
        games VARCHAR(50),
        gender VARCHAR(50),
        age VARCHAR(20),
        file VARCHAR(100)
        )";

    //checking table exists or not
    if ($mysqli_link->query($sql) === TRUE) {
        echo "Table form1 created successfully<br>";
    }else {
        echo $mysqli_link->error."<br>";
    }

    $name = $_POST['name'];
    $password = md5($_POST['password']);
    $address = $_POST['address'];
    $games ="";
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $file = $target_file;

    foreach($_POST['games'] as $checked => $value){
        $games = $games.$value.", ";
    }   

    //sql query
    $sql = "INSERT INTO form1 (name, password, address, games, gender, age, file)
            VALUES ('$name', '$password', '$address', '$games', '$gender', '$age', '$file')";

    //insert query
    if(mysqli_query($mysqli_link, $sql)){
        echo "record added.";
    }else {
        echo "error.";
    }
}else{
    echo "record not added";
}
?>
