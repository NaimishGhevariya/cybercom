<?php

class DatabaseConnect{
    public function __construct($db_host, $db_user, $db_pass){ 
        echo "Attempting to connect..."; 
        if(!@$this->Connect($db_host, $db_user, $db_pass)){
            echo 'Connection failed !<br>';
        }else{
            echo 'connected to '.$db_host.'.<br>';
        }
    }

    public function Connect($db_host, $db_user, $db_pass){
        if(!mysqli_connect($db_host, $db_user, $db_pass)){
            return false;
        }
        else { 
            return true;
        }
    }

}

$db_host = 'localhost';
$db_user = 'admin';
$db_pass = 'admin'; 

$connect = new DatabaseConnect($db_host, $db_user, $db_pass);

?>

