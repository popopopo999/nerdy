<?php
function insertBestelling($databaseConnection, $Values){

    $currentDate = date("Y/m/d/H/i/s");
    $Voornaam = $Values["Voornaam"];
    $Tussenvoegsel = $Values["Tussenvoegsel"];
    $Achternaam = $Values["Achternaam"];
    $email = $Values["Email"];
    $Straatnaam = $Values["Straatnaam"];
    $Huisnummer = $Values["Huisnummer"];
    $toevoeging = $Values["Toevoeging"];
    $Postcode = $Values["Postcode"];
    $Telefoonnummer = $Values["Telefoonnummer"];
    $Woonplaats = "Moet toegevoegd worden!";

    if(empty($_SESSION["winkelwagen_inhoud"]))
        header("location: index.php");

    $SQL = "INSERT INTO bestellingen (BestellingDatum, Voornaam, Achternaam, Tussenvoegsel, Email, Telefoonnummer, Adres, Huisnummer, Toevoeging, Postcode, Woonplaats) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $Statement = mysqli_stmt_init($databaseConnection);
    if(!mysqli_stmt_prepare($Statement, $SQL)){
        header("location: localhost/nerdy-Clone/nerdy/?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($Statement, "sssssssisss", $currentDate, $Voornaam, $Achternaam, $Tussenvoegsel, $email, $Telefoonnummer, $Straatnaam, $Huisnummer, $toevoeging, $Postcode, $Woonplaats);
    mysqli_stmt_execute($Statement);
    $orderID = mysqli_insert_id($databaseConnection);
    mysqli_stmt_close($Statement);

    insertBestellingLine($databaseConnection, $orderID);
}

function insertBestellingLine($databaseConnection, $orderID){
    $winkelwagenInhoud = $_SESSION["winkelwagen_inhoud"];

    foreach($winkelwagenInhoud as $product => $amount){
        $SQL = "INSERT INTO bestellingregel (StockItemID, BestellingID, Hoeveelheid) VALUES (?, ?, ?)";
        $Statement = mysqli_stmt_init($databaseConnection);
        if(!mysqli_stmt_prepare($Statement, $SQL)){
            header("location: localhost/nerdy-Clone/nerdy/?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($Statement, "iii", $product, $orderID, $amount);
        mysqli_stmt_execute($Statement);
        mysqli_stmt_close($Statement);
    }
    emptyShoppingCart();
}