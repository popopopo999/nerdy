<?php
function logout(){
    session_start();
    unset($_SESSION["Gebruikersnaam"]);
    header("Location: index.php");
}