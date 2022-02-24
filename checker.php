<?php
if (!($_SESSION['success'] === "You are now logged in")){
    header("Location: login.php");
    die(); 
}