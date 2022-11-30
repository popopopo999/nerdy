<?php

function signUp(){
    if(isset($_POST["submit"])) {
        $firstname = $_POST["firstname"];
        $middlename = $_POST["middlename"];
        $sirname = $_POST["sirname"];
        $email = $_POST["email"];
        $uid = $_POST["uid"];
        $pwd = $_POST["pwd"];
        $pwdrepeat = $_POST["pwdrepeat"];
        $street = $_POST["street"];
        $houseNumber = $_POST["housenumber"];
        $toevoeging = $_POST["toevoeging"];
        $zipcode = $_POST["ZipCode"];
        $telephoneNumber = $_POST["Telephonenumber"];


        require_once 'database.php';
        require_once 'browseFunctions.php';

        $databaseConnection = connectToDatabase();

        if (emptyInputSignIn($firstname,$sirname, $email, $uid, $pwd, $pwdrepeat) !== false) {
            header("location:?error=emptyinput");
            exit();
        }
        if (invalidUID($uid) !== false) {
            header("location:?error=invaliduid");
            exit();
        }
        if (invalidEmail($email) !== false) {
            header("location: ?error=invalidemail");
            exit();
        }
        if (pwdMatch($pwd, $pwdrepeat) !== false) {
            header("location: ?error=passwordsdontmatch");
            exit();
        }
        if (uidExists($databaseConnection, $uid, $email) !== false) {
            header("location: ?error=usernametaken");
            exit();
        }

        createUser($databaseConnection, $uid, $email, $firstname, $middlename, $sirname, $pwd, $street, $houseNumber, $toevoeging, $zipcode, $telephoneNumber);
    }
}
// else {
//    header("location: signup.php");
//}
