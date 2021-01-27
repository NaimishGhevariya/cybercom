<?php 
//example of associatve and multiple dimentions array
//Loop through assosiative array - 1D
$cars = array("bringel"=>"30" , "ocra"=>"40" , "apple"=>"50");

foreach ($cars as $key => $value) { 
	echo "the price of ".$key." is : ".$value." rs/kg. <br>";
}


//foreach in multi-dimentional associative Array
$cars = array("vegetable"=>array("bringel","ocra") , "fruits"=>array("apple","banana","grapes"));

foreach ($cars as $key => $value) {
	echo "<br>".$key." -";
	foreach ($value as $innerArray) {
		echo $innerArray." ";
	}

}

 ?>