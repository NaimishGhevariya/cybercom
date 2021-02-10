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
    <h1 class="text-center">Add New Blog Post</h1>
        <form action="" method= "POST" class="col g-3" enctype="multipart/form-data" id='form'>
            
            <div class="col-sm-6">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title">
                <span></span>
            </div>
            <div class="col-sm-6">
                <label for="content" class="form-label">Contant</label>
                <textarea name="content" id="content" class="form-control"></textarea>
                <span></span>
            </div>
            <div class="col-sm-6">
                <label for="url" class="form-label">URL</label>
                <input type="text" class="form-control" id="url" name="url">
                <span></span>
            </div>
            <div class="col-sm-6">
                <label for="publishedAt" class="form-label">Publshed At</label>
                <input type="date" class="form-control" id="publishedAt" name="publishedAt">
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
                <input type="file" class="form-control" id="image" name="image">
                <span></span>
            </div>
            
            <div class="col-sm-6">
            <button type="submit" class="btn btn-success px-5 my-3" name = 'submitBtn'>Submit</button>
            </div>  
        </form>

        </div>


<?php


include 'connection.php';
include 'fileupload.php';

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitBtn' ])){
    echo 'submitiing....';
    $userid = 1;
    $title = testInput($_POST['title']);
    $url = testInput($_POST['url']);
    $content = testInput($_POST['content']);
    $imgurl = file_upload('image');
    date_default_timezone_set("Asia/Kolkata");
    $createdAt =date('Y-m-d H:i:s');
    $publishedAt = testInput($_POST['publishedAt']);
    $updatedAt = $createdAt;
    
    $sql="INSERT INTO blogdata ( `userid`, `title`, `url`, `content`, `imageurl`, `publishedat`, `createdat`, `updatedat`)
        VALUES ($userid,'$title','$url','$content','$imgurl','$publishedAt','$createdAt','$updatedAt')";

    if($dbcon->query($sql) === TRUE) {
        echo "New record created successfully";
        header('Location:blogListingPage.php');
    } else {
        echo "Error: " . $sql . "<br>" . $dbcon->error;
        die();
    }

}



?>
</body>
</html>