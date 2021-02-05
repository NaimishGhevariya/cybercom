<?php
/*
$dir = '../1st-feb-2021';
if($handel = opendir($dir.'/')){
    echo "inside ".$dir."<br>";

    while($file = readdir($handel)){
        if($file !='.' && $file !='..'){
            echo '<a href = "'.$dir.'/'.$file.'" >'.$file."</a><br>";

        }
        
    }
}*/


function file_upload($file_attr_name){
// Check if image file is a actual image or fake image
if(isset($_POST["submit"]) && isset($_FILES[$file_attr_name]["name"])) {

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES[$file_attr_name]["name"]);
    $FileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $file_temp = $_FILES[$file_attr_name]['tmp_name'];
    
    echo $file_temp."<br>";
    
    if ((file_exists($target_file) && $target_file != "uploads/")
    || $_FILES[$file_attr_name]["size"] > 5000000 
    || ($FileType != "jpg" 
        && $FileType != "png" 
        && $FileType != "jpeg" 
        && $FileType != "gif" 
        && $FileType != "docx" 
        && $FileType != "pdf" 
        && $FileType != "txt")){
            echo 'file is not valid or already uploaded !!';
        }else{
            echo 'valid file<br>';
            if(move_uploaded_file($_FILES[$file_attr_name]["tmp_name"], $target_file)){
                echo "file transfered<br>";
                echo $target_file;
            }
        }
    }else{
        echo "upload file.";
    }
}

file_upload('file');

/*

// Check if image file is a actual image or fake image
if(isset($_POST["submit"]) && isset($_FILES["file"]["name"])) {

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
$file_temp = $_FILES["file"]['tmp_name'];


    echo $file_temp."<br>";

    $check = getimagesize($file_temp);

    if ((file_exists($target_file) && $target_file != "uploads/")
    || $_FILES["file"]["size"] > 5000000 
    || ($FileType != "jpg" 
        && $FileType != "png" 
        && $FileType != "jpeg" 
        && $FileType != "gif" 
        && $FileType != "docx" 
        && $FileType != "pdf" 
        && $FileType != "txt")){
            echo 'file is not valid or already uploaded !!';
        }else{
            echo 'valid file<br>';
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)){
                echo "file transfered<br>";
                echo $target_file;
            }
        }
}else{
    echo "upload file.";
}
*/
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method= "POST" enctype = "multipart/form-data">
    <input type="file" name= 'file'><br><br>
    <input type="submit" name= 'submit'>
</form>
