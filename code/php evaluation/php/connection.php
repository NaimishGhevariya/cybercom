<?php

$host = "localhost";
$dbUser = "admin";
$password = "admin";
$dbName = "blogdb";
 
$dbcon = new mysqli($host,$dbUser,$password,$dbName);

function testInput($data) {
    if(isset($data) && !empty($data)){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }else{
        die("data is epmty");
    } 
}

// Check connection
if ($dbcon->connect_error) {
  die("Connection failed: " . $dbcon->connect_error);
}else{
    echo "connected !!";
}

?>