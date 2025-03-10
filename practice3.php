<?php
class Human{
    public $name;
    private $age;
    protected $mail;

    public function __construct($name,  $age , $mail){
        $this -> name = $name;
        $this -> age = $age;
        $this -> mail = $mail;
    }

    public function hello(){
        echo"Hello,World!<br>";
    }
    public function way(){
        $test = "user";
        echo "hello" . $test . "!<br>";
    }
}
$hoshi = new human("hoshi","15","example@email.com");
$hoshi -> hello();
$hoshi -> way();
echo "test:" . $hoshi->name . "!!!<br>";
echo "PHPオブジェクト指向"
?>