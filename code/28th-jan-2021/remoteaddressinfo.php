<?php
/*
    require 'conf.inc.php';
    echo $ip_address."<br>";

    foreach ($ip_blocked as $ip){
        echo $ip."<br>";
        if($ip == $ip_address){
           // die("<br>You are blocked.<br>"); 
        }

    }*/
?>


<h1>Welcome!</h1>


<?php
$http_client_ip = $_SERVER['HTTP_CLIENT_IP'];
$http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'];
$remote_add = $_SERVER['REMOTE_ADDR'];

if(!empty($http_client_ip)){
    $ip_address = $http_client_ip;
}elseif(!empty($http_x_forwarded_for )){
    $ip_address = $http_x_forwarded_for;
}else{
    $ip_address = $remote_add;
}

echo $ip_address;
?>