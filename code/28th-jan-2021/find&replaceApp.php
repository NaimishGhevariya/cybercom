<?php

if(isset($_POST) && !empty($_POST)){
    $user_input = $_POST['user_input'];
    $find = $_POST['search_input'];
    $replace = $_POST['replace_input'];
    $user_input_new = str_ireplace($find, $replace, $user_input);
    echo $user_input_new;

} 

?>
<hr>    

<form action="find&replaceApp.php" method = "POST">
<textarea name="user_input" id="" cols="30" rows="6"><?php echo $user_input; ?></textarea>
<br><br><br>

<label for="search_input">Search For:</label>
<br>
<input type="text" name ="search_input">
<br><br><br>

<label for="replace_input">Replace With:</label>
<br>
<input type="text" name ="replace_input">

<br><br><br>
<input type="submit" value="Find and replace">
</form>