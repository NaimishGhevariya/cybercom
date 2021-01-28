<?php

if(isset($_GET['day']) && isset($_GET['month']) && isset($_GET['year'])){
    $day = $_GET['day'];
    $month = $_GET['month'];
    $year = $_GET['year'];

    if(!empty($day) && !empty($month) && !empty($year)){
        echo $day.", ".$month." ".$year.".";
    }else{
        echo "fill all fields.";
    }
}
?>

<form action="get.php" method="GET">
    Day:<br><input type="text" name="day" id=""><br>
    Month:<br><input type="text" name="month" id=""><br>
    Year:<br><input type="text" name="year" id=""><br><br>
    <input type="submit" value="submit">
</form>