<?php

$pass = 'pass123';

if(isset($_POST['password']) && !empty($_POST['password'])){
    $password = $_POST['password'];
    if($password == $pass){
        echo "entered correct.";
    }else{
        echo "password does not matched";
    }
}else

?>


<form action="post.php" method="POST">
    Password:<br><input type="password" name="password" id=""><br><br>
    <input type="submit" value="submit">
</form>