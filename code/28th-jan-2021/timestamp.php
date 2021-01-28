<?php   
    $time2 = date_default_timezone_set('Asia/Kolkata');
    
    $time3 = date_default_timezone_get();
    echo "Current timezone is set for ".$time3.".";
    echo "<br><br> Current time:<br>";
    $time = time();
    $actual_time = date(" l, dS M Y. @ g:i a", $time);
    echo $actual_time;

    echo "<br><br> Modified time:<br>";
    $time = time();
    $actual_time = date(" l, dS M Y. @ g:i a", strtotime('+1 week 10 hours 50 seconds'));
    echo $actual_time;
?>