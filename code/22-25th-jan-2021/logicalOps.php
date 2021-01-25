<?php

$number = 201;
$res = 200;
$res2 = 250;

if($number >= $res && $number <= $res2)
{
	echo 'in range';
}
else
{
	echo 'number must between ' .$res. 'and ' .$res2;
}

?>