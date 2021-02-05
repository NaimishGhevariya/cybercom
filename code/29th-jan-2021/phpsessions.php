<?php
//session called in htmlentities.php

session_start();

if (isset($_SESSION['username'])){
    echo "welcome ".$_SESSION['username'];
}else{
    echo "please log in.";
}
?>