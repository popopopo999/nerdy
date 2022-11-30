<?php
function getVoorraadTekst($actueleVoorraad) {
    if ($actueleVoorraad > 1000) {
        return "Ruime voorraad beschikbaar.";
    } else {
        return "Voorraad: $actueleVoorraad";
    }
}
function berekenVerkoopPrijs($adviesPrijs, $btw) {
    return $btw * $adviesPrijs / 100 + $adviesPrijs;
}


// Functies voor het aanmaken van een account:

function emptyInputSignIn($firstname, $lastname, $email, $uid, $pwd, $pwdrepeat) {
    $result;
    if(empty($firstname) || empty($lastname) ||empty($email) || empty($uid) || empty($pwd) || empty($pwdrepeat)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUID($uid) {
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdrepeat) {
    $result;
    if($pwd !== $pwdrepeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function uidExists($databaseConnection, $uid, $email) {
    $sql = "SELECT * FROM klant WHERE Gebruikersnaam = ? OR Email = ?;";
    $stmt = mysqli_stmt_init($databaseConnection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: localhost/nerdy-Clone/nerdy/?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $uid, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($connection, $uid, $email, $firstname, $middlename, $lastname, $pwd, $street, $houseNumber, $toevoeging, $zipcode, $telephoneNumber) {
    $sql = "INSERT INTO klant (Voornaam, Tussenvoegsel, Achternaam, Email, Gebruikersnaam, Wachtwoord, Straatnaam, Huisnummer, Toevoeging, Postcode, Telefoonnummer) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: localhost/nerdy-Clone/nerdy/?error=stmtfailed");
        exit();
    }

    $Hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssssisss", $uid, $email, $firstname, $middlename, $lastname, $Hashedpwd, $street, $houseNumber, $toevoeging, $zipcode, $telephoneNumber);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:?error=none");
    exit();
}

function LoginUser($databaseConnection, $username, $pwd) {
    $uidExists = uidExists($databaseConnection, $username, $username);

//    if ($uidExists == false) {
//        header("location: ?error=uiddoesntmatch");
//        exit();
//    }

    $pwdHashed = $uidExists["Wachtwoord"];
    $checkedPwd = password_verify($pwd, $pwdHashed);

//    if ($checkedPwd == false) {
//        header("location: ../login.php?error=pwdDoesntMatch");
//        exit();
//    }
    if ($checkedPwd == true){
        session_start();
        $_SESSION["Gebruikersnaam"] = $uidExists["Gebruikersnaam"];
        header("location: ../index.php");
        exit();
    }
}

function emptyInputLogin($username, $pwd) {
    $result;
    if(empty($username) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

