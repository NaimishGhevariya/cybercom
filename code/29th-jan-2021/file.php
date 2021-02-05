<?php
    //writing file
    $handel = fopen('name.txt','w');
    fwrite($handel,'Naimish');
    fwrite($handel,' Ghevariya '."\n");
    fwrite($handel,'milan '."\n");
    fwrite($handel,'bavadiya'."\n");
    fwrite($handel,'jemo tabelo'."\n");
    fclose($handel);

    //appending to file
    $handel = fopen('name.txt','a');
    fwrite($handel,'ravina');
    fwrite($handel,' milan ghevariya '."\n");
    fwrite($handel,'bhavana '."\n");
    fwrite($handel,'ramesh'."\n");
    fclose($handel);

    //reading from file
    $readin = file('name.txt');
    $readinCount = count($readin);
    $count = 1;
    foreach ($readin as $name){
        echo trim($name);
        if($count < $readinCount){
            echo ", ";
        }
        $count++;
    }
    
    //explode data
    $filename = 'name.txt';
    $handel = fopen($filename,'r');
    $data_in = fread($handel, filesize($filename));
    $names_arr = explode("\n", $data_in);
    echo "<br>";
    print_r($names_arr);
    
    foreach($names_arr as $name){
        echo $name.'<br>';
    }

    //implode data
    $filename = 'name.txt';
    $handel = fopen($filename,'r');
    $data_in = fread($handel, filesize($filename));
    $names_arr = implode("-", $data_in);
    echo "<br>";
    print_r($names_arr);
    
    foreach($names_arr as $name){
        echo $name.'<br>';
    }

    

    

?>