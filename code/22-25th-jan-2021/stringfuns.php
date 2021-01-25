<?php

$string = 'This is an example of php string functions!';
$string_word_count = str_word_count($string, 0);

print_r( $string_word_count.'<hr>' );

//String shuffle
$string = 'abcdefghijklmnopqrstuvwxyz1234567890';
$string_shuffle = str_shuffle($string) ;

$res = substr( $string_shuffle, 0, 5);
echo $res."<br>";

//String reverse
$string1 = 'This is an exmple!';
$string_reverse = strrev($string1);

echo $string_reverse."<hr>";

//similar_text 
$string2 = 'This is php tutorials from alex.';
$string3 = 'This is php tutorial. his name is alex';

similar_text($string2, $string3, $result);
echo $result."<hr>";

//strlen
$string4 = 'This is php tutorials from alex.';
$length = strlen($string4);

echo $length."<hr>";

//trim - To remove white spaces
$string5 = "This is php tutorials from alex.";
$string_trim = trim($string5);
echo $string_trim."<hr>";

//addslashes
$string6 = "This is my image <img src = 'image.jpg'> ";
$string_slash = htmlentities(addslashes($string6));
echo $string_slash;

?>