<?php

include 'server1.php';
    echo $_SERVER['SCRIPT_NAME']."<br><br>";

        if(isset($_POST['submit'])){
            echo 'server';
        }
?>