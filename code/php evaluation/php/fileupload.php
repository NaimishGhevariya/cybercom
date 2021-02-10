<?php


    $storeToDB = false;
    function file_upload($file_attr_name){  
        if(isset($_POST["submitBtn"]) && isset($_FILES[$file_attr_name]["name"])){
            //code for file handeling
            $target_dir = '../uploads/';
            $target_file = $target_dir . basename($_FILES[$file_attr_name]["name"]);
            $FileType = pathinfo($target_file, PATHINFO_EXTENSION);
            $file_temp = $_FILES[$file_attr_name]['tmp_name'];
            echo "image is set<br>";
        }else {
            echo "<br>image not yet set to server <br>";
            die();
        }
        
        if(isset($_POST["submitBtn"]) && isset($_FILES[$file_attr_name]["name"])) {
            echo $file_temp."<br>";

            if ((file_exists($target_file) && $target_file != "uploads/")
            || $_FILES[$file_attr_name]["size"] > 5000000 
            || ($FileType != "jpg" 
                && $FileType != "png" 
                && $FileType != "jpeg" 
                && $FileType != "gif" 
            )){
                echo 'image is not valid or already uploaded !!<br>';
                die();
            }else{
                echo 'valid file<br>';
                if(move_uploaded_file($_FILES[$file_attr_name]["tmp_name"], $target_file)){
                    echo "image transfered<br>";
                    $storeToDB = true;
                    echo $target_file."<br>";
                    return $target_file;
                }
            }
        }else{
            echo "upload image again.<br>";
            die();
        }
    }

?>