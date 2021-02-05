<?php
$mysql_host = 'localhost';
$mysql_user = 'admin';
$mysql_pass = 'admin';
$mysql_db = 'form_db';

$con = @mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
$con_to_db = @mysqli_select_db($con, $mysql_db) ;
class DatabaseException extends Exception{

    public function show(){
        echo 'DatabaseException<br>';
        return 'Error in line '.$this ->getLine().' in '.$this ->getFile()."<br>";
    }
}
class ServerException extends Exception{
    public function show(){
        echo 'ServerException<br>';
        return 'Error in line '.$this ->getLine().' in '.$this ->getFile()."<br>";
    }
}

try{

    if(!$con){
        throw new ServerException ();
    }elseif(!$con_to_db){
        throw new DatabaseException();
    }else echo "connceted";

}catch(ServerException $ex){
    echo $ex -> show();
}catch(DatabaseException $ex){
    echo $ex -> show();
}

?>