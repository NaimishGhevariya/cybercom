<?php
    include 'connection.php';

    $id = $_GET["id"];
    $sql = "SELECT * FROM categorydata WHERE catid = $id";
    $result = $dbcon->query($sql) or die('died');
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
    }else{
        echo "0 rows";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>see your Blog.</title>
</head>
<body>
<table>
<?php

foreach($row as $key => $value){

    echo "<tr><td> $key </td> <td> $value</td><tr>";
}

?>
</table>    
</body>
</html>