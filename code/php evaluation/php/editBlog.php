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
    <title>add blog</title>
</head>
<body>
        
    <div class ='container'>
    <h1 class="text-center">Edit Blog Post</h1>
    <?php
            include 'connection.php';

            $id = $_GET["id"];
            $sql = "SELECT * FROM blogdata WHERE id = $id";
            $result = $dbcon->query($sql) or die('died');
            if ($result->num_rows > 0){
                $row = $result->fetch_assoc();
            }else{
                echo "0 rows";
            }
            
            ?>
        <form action="" method= "POST" class="col g-3">
            
            <div class="col-sm-6">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value='<?php echo $row['title']?>'>
                <span></span>
            </div>
            <div class="col-sm-6">
                <label for="content" class="form-label">Contant</label>
                <textarea name="content" id="content" class="form-control"><?php echo $row['content']?></textarea>
                <span></span>
            </div>
            <div class="col-sm-6">
                <label for="url" class="form-label">URL</label>
                <input type="text" class="form-control" id="url" name="url" value='<?php echo $row['url']?>'>
                <span></span>
            </div>
            <div class="col-sm-6">
                <label for="publshedAt" class="form-label">Publshed At</label>
                <input type="date" class="form-control" id="publshedAt" name="publshedAt" value='<?php echo $row['publishedat']?>'>
                <span></span>
            </div>
            <div class="col-sm-6">
                <label for="catagory" class="form-label">Catagory</label>
                <select name="catagory[]" id="catagory" class="form-control" multiple>
                    <option value="lifestyle">Lifestyle</option>
                    <option value="lifestyle">Lifestyle</option>
                    <option value="lifestyle">Lifestyle</option>
                    <option value="lifestyle">Lifestyle</option>
                </select>
                <span></span>
            </div>
            
            <div class="col-sm-6">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" >
                <span></span>
            </div>
            
            <div class="col-sm-6">
            <button type="submit" class="btn btn-success px-5 my-3" name = 'submitBtn'>Submit</button>
            </div>
        </form>

        </div>
<?php

include 'fileupload.php';

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitBtn' ])){
    echo 'submitiing....';
    $userid = 1;
    $title = testInput($_POST['title']);
    $url = testInput($_POST['url']);
    $content = testInput($_POST['content']);
    $imgurl = file_upload('image');
    date_default_timezone_set("Asia/Kolkata");
    $updatedAt =date('Y-m-d H:i:s');
    
    $sql="UPDATE `blogdata` SET  `title` = $userid, `url`= $url, `content` = $content, `imageurl` = $imgurl, `updatedat` = $updatedAt";

    if($dbcon->query($sql) === TRUE) {
        echo "New record updated successfully";
        header('Location:blogListingPage.php');
    } else {
        echo "Error: " . $sql . "<br>" . $dbcon->error;
        die();
    }
}
?>

</body>
</html>