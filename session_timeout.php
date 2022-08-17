<?php
//actually there's no error 
error_reporting(0);
session_start();
$check = $_SESSION['login_time'];

if(isset($check)){
    //subtract current time by login time
    $difference = time() - $check;
    //set timeout session 
    if($difference>100000){
        echo 'logout';//ajax function response
    }
}


?>