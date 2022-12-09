<?php
if(isset($_SESSION["Gebruikersnaam"])){
    header('Location: https://www.ideal.nl/demo/qr/?app=ideal');
}

if(isset($_POST["Account_maken"])){
    session_start();
    $_SESSION["Account_maken"] = $_POST;
    header('Location: Signup.php');
}else{
    header('Location: https://www.ideal.nl/demo/qr/?app=ideal');
}