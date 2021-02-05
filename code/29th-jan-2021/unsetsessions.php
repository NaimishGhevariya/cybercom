<?php
session_start();
unset($_SESSION['username']);

session_destroy(); // destroy all sessions betwwen client and server 
?>