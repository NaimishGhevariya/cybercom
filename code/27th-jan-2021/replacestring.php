
<?php
	$String = 'Hello how are you?. I am fine brother.';
	$replace = substr_replace($String, 'sister', 30, 7);
	echo $replace."<br>";

	
	$search = array('how','are','i ');
	$replace0 = array('HOW','ARE','I ');
	$string1 = 'Hello how are you? i am fine brother.';
	$replace1 = str_replace($search, $replace0, $string1);
	echo $replace1;
	
?>