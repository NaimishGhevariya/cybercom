<?php

    class BankAccount{
        public $name = "not specified";
        public $balance = 5000;
        public $type = '18-25';

        public function __construct($name){
            $this->name = $name;
        }

        public function displayBalance(){
            echo 'Name: '.$this-> name."<br>";
            echo 'Current Balance: '.$this-> balance."<br>";
        }

        public function Withdraw($amount){
            if($amount > $this->balance){
                echo $this->name." not enought money in your account.<br>";
            }else
            $this->balance -= $amount;
        }

        public function Deposit($amount){
            $this->balance += $amount;
        }

        public function SetType($inp){
            $this->type = $inp; 
        }
    }


    class SavingAccount extends BankAccount{
    }

    $jay = new BankAccount('jay');
    $jay -> Deposit(100);
    $jay -> SetType('50 to 60');
    $jay -> displayBalance();
    echo "Account type: ".$jay -> type;

    echo "<br><hr><br>";
    
    $riya = new SavingAccount('riya');
    $riya -> Withdraw(5005);
    $riya -> SetType('Super Saver');
    $riya -> displayBalance();
    echo "Account type: ".$riya -> type;
?> 