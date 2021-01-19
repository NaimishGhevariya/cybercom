<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>data redirect</title>
</head>
<body>
    <h1>Data from previous form:</h1>
    <table> 
        <thead>
            <tr>
                <td>Key</td>
                <td>Value</td>
            </tr>
        </thead>
        <?php
            foreach ($_POST as $key => $value) {
                if($key != 'submit'){
                    echo "<tr>";
                    echo "<td>";
                    echo $key;
                    echo "</td>";
                    echo "<td>";
                    echo $value;
                    echo "</td>";
                    echo "</tr>";
                }else continue;
                
            }
        ?>
        </table>

</body>
</html>
