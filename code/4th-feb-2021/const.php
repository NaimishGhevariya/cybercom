<?php
    class circle{
        const pi = 3.141;

        public function Area($rad){
            return self::pi * ($rad * $rad);
        }
    }
    
    $c = new circle;
    echo $c->Area(10);
    

?>