<?php 
//if not logged in yet
if(!isset($_SESSION['IS_LOGGED_IN'])){
    header('location:login.php');
}


?>
 