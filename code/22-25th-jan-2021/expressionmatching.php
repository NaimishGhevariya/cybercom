<?php

//preg_match(); //It is used for finding the word from any string

$string = "This is php practice";

if (preg_match("/php/",$string)) {
    echo "Matched";
} else {
    echo "Not matched";
}

?>