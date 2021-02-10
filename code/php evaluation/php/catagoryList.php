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
    <title>catagory listing page</title>
</head>
<body>
    <div class = 'col-sm-12 d-flex flex-row-reverse'>
        <button type="button" class="btn btn-success px-5 mx-3 my-3"  name = 'logoutBtn' onclick="location.href='login.php'">Logout</button>
        <button type="button" class="btn btn-success px-5 mx-3 my-3"  name = 'myProfileBtn' onclick="location.href='profile.php'">My Profile</button>
        <button type="button" class="btn btn-success px-5 mx-3 my-3"  name = 'manageBLogBtn' onclick="location.href='blogListingPage.php'">Manage blog</button>
    </div>

<div class="container">


    <h1>blog Posts</h1>
    <button type="button" class="btn btn-success px-5 my-3"  name = 'addCatBtn' onclick="location.href='addCatagory.php'">Add Catagory</button>

    <div class="tableHolder">
        <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Catagory Id</th>
                <th>Category Image</th>
                <th>Catagory Name</th>
                <th>Created Date</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php

        include 'connection.php';

        $sql = "SELECT * FROM categorydata";
        $result = $dbcon->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td onclick="location.href ='viewCatagory.php?id=<?php echo $row['catid'];?>'"><?php echo $row['catid'];?></td>
                <td><img src="<?php echo $row['url'];?>" alt=""> cat img</td>
                <td><?php echo $row['title'];?></td>
                <td><?php echo $row['created'];?></td>
                <td class="d-flex flex-row-reverse">
                <button type="button" class="btn btn-danger mx-1"> <i class="fas fa-trash-alt"></i> </button>
                <button type="button" class="btn btn-primary mx-1" onclick="location.href ='editCatagory.php?id=<?php echo $row['catid'];?>'"> <i class="fas fa-pen"></i> </button>
                </td>
            </tr>

        <?php
        }
        } else {
        echo "0 results";
        }
        ?>
        </tbody>
    </table>
    </div>
</body>
</html>