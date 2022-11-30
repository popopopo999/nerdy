<?php
$url = $_SERVER['REQUEST_URI'];
$urlQuery = substr($url, strpos($url, "?"));

if(isset($_GET["Account_maken"])){
    header('Location: Signup.php' . $urlQuery);
}else{
    header('Location: https://www.ideal.nl/demo/qr/?app=ideal');
}