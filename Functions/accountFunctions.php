<?php
function createUser($connection, $uid, $email, $Voornaam, $Tussenvoegsel, $lastname, $pwd, $Straatnaam, $Huisnummer, $toevoeging, $Postcode, $Telefoonnummer, $Woonplaats) {
    $sql = "INSERT INTO klant (Voornaam, Tussenvoegsel, Achternaam, Email, Gebruikersnaam, Wachtwoord, Straatnaam, Huisnummer, Toevoeging, Postcode, Telefoonnummer, Woonplaats) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: localhost/nerdy-Clone/nerdy/?error=stmtfailed");
        exit();
    }

    $Hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssssissss", $Voornaam, $Tussenvoegsel, $lastname, $email, $uid, $Hashedpwd, $Straatnaam, $Huisnummer, $toevoeging, $Postcode, $Telefoonnummer, $Woonplaats);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    LoginUser($connection, $uid, $pwd);
    header("location:?error=none");
    exit();
}

function LoginUser($databaseConnection, $username, $pwd) {
    $uidExists = uidExists($databaseConnection, $username, $username);

    if ($uidExists == false) {
        header("location: ?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["Wachtwoord"];
    $checkedPwd = password_verify($pwd, $pwdHashed);

    if ($checkedPwd == false) {
        header("location: ?error=wronglogin");
        exit();
    }
    if ($checkedPwd == true){
        $_SESSION["Gebruikersnaam"] = $uidExists["Gebruikersnaam"];
        header("location: ./index.php");
        exit();
    }
}

function signUp(){
    $Voornaam = $_POST["Voornaam"];
    $Tussenvoegsel = $_POST["Tussenvoegsel"];
    $Achternaam = $_POST["Achternaam"];
    $email = $_POST["Email"];
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];
    $Straatnaam = $_POST["Straatnaam"];
    $Huisnummer = $_POST["Huisnummer"];
    $toevoeging = $_POST["Toevoeging"];
    $Postcode = $_POST["Postcode"];
    $Telefoonnummer = $_POST["Telefoonnummer"];
    $Woonplaats = $_POST["Woonplaats"];


    require_once 'database.php';
    require_once 'accountFunctions.php';

    $databaseConnection = connectToDatabase();

    if (emptyInputSignIn($Voornaam,$Achternaam, $email, $uid, $pwd, $pwdrepeat) !== false) {
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

    createUser($databaseConnection, $uid, $email, $Voornaam, $Tussenvoegsel, $Achternaam, $pwd, $Straatnaam, $Huisnummer, $toevoeging, $Postcode, $Telefoonnummer, $Woonplaats);
}

function login(){
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

function logout(){
    session_start();
    unset($_SESSION["Gebruikersnaam"]);
    if(isset($_SESSION["Account_maken"]))
        unset($_SESSION["Account_maken"]);

    header("Location: index.php");
}

function getUserData($connection){
    $sql = "SELECT Voornaam, Tussenvoegsel, Achternaam, Email, Straatnaam, Huisnummer, Toevoeging, Postcode, Telefoonnummer, Woonplaats
            FROM klant WHERE Gebruikersnaam = '" . $_SESSION["Gebruikersnaam"] . "'";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: localhost/nerdy-Clone/nerdy/?error=stmtfailed");
        exit();
    }

    $Statement = mysqli_prepare($connection, $sql);
    mysqli_stmt_execute($Statement);
    $Result = mysqli_stmt_get_result($Statement);

    return $Result = mysqli_fetch_all($Result, MYSQLI_ASSOC);
}
