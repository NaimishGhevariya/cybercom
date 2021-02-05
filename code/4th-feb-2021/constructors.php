<?php

    class Example{

        public function __construct($x){
            $this->say($x);
        }

        public function say($x){
            echo $x."<br>";
        }

    }

    $ex = new Example('hello');

?>