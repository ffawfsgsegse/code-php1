<?php

class User {
    //name, username, password
    public $name;
    public $username;
    public $password;

    // ham khoi tao
    public function __construct($name, $username, $password)
    {
    $this->name = $name;
    $this->username = $username;
    $this->password = $password;
    }
     function set_name($name){
        return $this->name = $name;
    }
    //get
    function get_name($name){
        return $this->name;
    }
    // ham in thong tin
    public function xuatthongtin() {
        echo $this->name;
        echo $this->username;
    }
    //ham kiem tra tai khoan -> admin&& 123456 pass
    public function login() {
        if($this -> username === "admin" && $this -> password === "123456") {
            return true;
        } 
        return false;
    }
    // ham get/set -> name
    //set
   
    







}  
ini_set('display_errors', '1');
    ini_set('display_startup_erors', '1');
    error_reporting(E_ALL);
    function chia2so ($a, $b){
        try {
            return $a /$b;
        } catch (DivisionByZeroError $e){   // gọi từ object
            echo $e -> getMessage();
        }
    }
        echo "<h1>".chia2so(4,0)."</h1>";