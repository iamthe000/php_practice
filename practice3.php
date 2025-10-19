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
$test = new human("iam","15","example@email.com");
$test -> hello();
$test -> way();
echo "test:" . $test->name . "!!!<br>";
echo "PHPオブジェクト指向"
?>
