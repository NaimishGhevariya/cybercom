    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- bootstrap --> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" href="<?php echo $cssPath; ?>">
        <!-- font awesome -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" 
            integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <title>login</title>
    </head>
    <body>
    <div class ='container'>
    <h1 class="text-center">Login</h1>
        <form action="" method= "POST" class="col g-3">
        <div class="col-sm-6">
            <label for="email" class="form-label">Email Id</label>
            <input type="text" class="form-control" id="email" name="email">
            <span></span>
        </div>
        <div class="col-sm-6">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            <span></span>
        </div>
        <div class="col-sm-6">
        <input type="submit" class="btn btn-success px-5 my-3" value='Login' name = 'loginBtn'></input>
        <input type="button" class="btn btn-success px-5 my-3" value='Register' name = 'registerBtn' onclick="location.href='register.php'"></input>
        </div>  
        </form>

        </div>

<script src="../js/validate.js"></script>

<?php
include 'connection.php';
    
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registerBtn']) && isset($_POST['terms'])){
    echo 'rgister pressed';
    $email = testInput($_POST['email']);
    $password = testInput($_POST['password']);

    $sql="SELECT * FROM `userdata` WHERE email = $email, password = $password";
    $result = mysqli_query($dbcon, $query); 
    if ($dbcon->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $dbcon->error;
        die();
    }
}
?>   

    </body>
    </html>