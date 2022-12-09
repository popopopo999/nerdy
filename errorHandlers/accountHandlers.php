<?php
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