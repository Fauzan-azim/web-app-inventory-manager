<?php 
session_unset();
session_start();
session_destroy();

header('location:login.php');

?>