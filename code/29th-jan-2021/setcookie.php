<?php
//set cookie
setcookie('username','naimish',time() + 60);

//unsetting cookie
setcookie('username','naimish',time() - 60);
?>