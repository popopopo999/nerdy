<?php
function createUser($connection, $uid, $email, $firstname, $middlename, $lastname, $pwd, $street, $houseNumber, $toevoeging, $zipcode, $telephoneNumber) {
    $sql = "INSERT INTO klant (Voornaam, Tussenvoegsel, Achternaam, Email, Gebruikersnaam, Wachtwoord, Straatnaam, Huisnummer, Toevoeging, Postcode, Telefoonnummer) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: localhost/nerdy-Clone/nerdy/?error=stmtfailed");
        exit();
    }

    $Hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssssisss", $firstname, $middlename, $lastname, $email, $uid, $Hashedpwd, $street, $houseNumber, $toevoeging, $zipcode, $telephoneNumber);
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
    require_once 'accountFunctions.php';

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
    header("Location: index.php");
}
