<?php
session_start();
if(isset($_GET['logout'])){
    unset($_SESSION["email"]);
    session_destroy();
    header('location:index.php');
};
?>