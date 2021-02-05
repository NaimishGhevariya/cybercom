<?php

    class BankAccount{
        public $balance = 5000;

        public function displayBalance(){
            echo 'Current Balance: '.$this-> balance;
        }

        public function Withdraw($amount){
            if($amount > $this->balance){
                echo "not enought money<br>";
            }else
            $this->balance -= $amount;
        } 

    }

    $obj = new BankAccount();
    $obj -> Withdraw(5005);
    $obj->displayBalance();
?> 