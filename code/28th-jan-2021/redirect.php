<?php ob_start(); //storing output in buffers ?> 

<h1>cses</h1>
This is my page. 

<?php
$redirect_page = 'server1.php';
$redirect = false;

if($redirect){
    header('Location: '.$redirect_page);
}

ob_end_flush(); //flush buffer and give output
//ob_end_clean(); //wont output anything.
?>