<?php
session_start();
function logout(){
    unset($_SESSION["Gebruikersnaam"]);
    header("Location: index.php");
}