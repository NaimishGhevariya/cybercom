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
    <title>Register</title>
</head>
<body>
    <div class ='container'>
    <h1 class="text-center">Register</h1>
        <form action="" method= "POST" class="col g-3">
            <div class="col-sm-6">
                <label for="prefix" class="form-label">Email Id</label>
                <select name="prefix" id="prefix" class="form-select">
                    <option value="Mr.">Mr.</option>
                    <option value="Mrs.">Mrs.</option>
                </select>
            </div>
            <div class="col-sm-6">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" class="form-control" id="firstname" name="firstname">
                <span></span>
            </div>
            <div class="col-sm-6">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" class="form-control" id="lastname" name="lastname">
                <span></span>
            </div>
            <div class="col-sm-6">
                <label for="email" class="form-label">Email Id</label>
                <input type="text" class="form-control" id="email" name="email">
                <span></span>
            </div>
            <div class="col-sm-6">
                <label for="phone" class="form-label">Mobile number:</label>
                <input type="tel" class="form-control" id="phone" name="phone">
                <span></span>
            </div>
            <div class="col-sm-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <span></span>
            </div>
            
            <div class="col-sm-6">
                <label for="confPassword" class="form-label">Confirm password</label>
                <input type="password" class="form-control" id="confPassword" name="confPassword">
                <span></span>
            </div>
            
            <div class="col-sm-6">
                <label for="information" class="form-label">Information</label>
                <textarea name="information" id="information" class="form-control"></textarea>
                <span></span>
            </div>

            <div class="col-sm-6">
                <input type="checkbox" name="terms" id="terms">
                <label for="information" class="form-label">Hereby, I Accept Terms & Conditions.</label>
                <span></span>
            </div>
            
            <div class="col-sm-6">
            <input type="submit" class="btn btn-success px-5 my-3" value = 'Register' name = 'registerBtn' onclick=""></input>
            </div>  
        </form>

        </div>
<?php
include 'connection.php';

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registerBtn']) && isset($_POST['terms'])){
    echo 'rgister pressed';
    $prefix = testInput($_POST['prefix']);
    $firstname = testInput($_POST['firstname']);
    $lastname = testInput($_POST['lastname']);
    $mobile = testInput($_POST['phone']);
    $email = testInput($_POST['email']);
    $password = md5(testInput($_POST['password']));
    $confPassword = md5(testInput($_POST['confPassword']));
    $information = testInput($_POST['information']);
    date_default_timezone_set("Asia/Kolkata");
    $created =date('Y-m-d H:i:s');

    if($password == $confPassword){

        $sql="INSERT INTO  userdata ( `prefix`, `firstname`, `lastname`, `mobile`, `email`, `password`, `information`, `createdat`) 
        VALUES ('$prefix','$firstname','$lastname',$mobile,'$email','$password','$information','$created')";
   
        if ($dbcon->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
            die();
        }
    }else{
        echo "password missmatch";
    }
}


?>


</body>
</html>