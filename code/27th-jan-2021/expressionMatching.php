<?php 

function space($str)
{
	if(preg_match('/ /',$str))
	{
		return true;
	}
	else
	{
		return false;
	}

}

$check=space("Hello Smit");

if($check)
	echo "Yes String Contains space";
else
	echo "There is NO space";


 ?>