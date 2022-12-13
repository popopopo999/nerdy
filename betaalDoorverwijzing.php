<?php
include __DIR__ . "/header.php";

if(isset($_SESSION["Gebruikersnaam"])){
    insertBestelling($databaseConnection, $_POST);
    header('Location: https://www.ideal.nl/demo/qr/?app=ideal');
    exit();
}

if(isset($_POST["Account_maken"])){
    session_start();
    $_SESSION["Account_maken"] = $_POST;
    header('Location: Signup.php');
}else{
    insertBestelling($databaseConnection, $_POST);
    header('Location: https://www.ideal.nl/demo/qr/?app=ideal');
    exit();
}