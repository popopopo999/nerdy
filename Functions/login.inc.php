<?php
function login(){
    if (isset($_POST["submit"])) {
        $username = $_POST["uid"];
        $pwd = $_POST["pwd"];

        require_once 'C:\xampp\htdocs\nerdy\database.php';
        require_once 'browseFunctions.php';

        $databaseConnection = connectToDatabase();

        if (emptyInputLogin($username, $pwd) !== false) {
            header("location:?error=emptyinput");
            exit();
        }
        LoginUser($databaseConnection, $username, $pwd);
    }
}
//else {
//    header("location: ");
//    exit();
//}