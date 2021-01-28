<?php
    if(isset($_POST['roll'])){

        $rand = rand(1,100);
        echo "Random number: ".$rand;
    }
?>

<form action="randomno.php" method="POST">
    <input type="submit" value="Roll Dice" name="roll">
</form>