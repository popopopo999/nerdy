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
    $Woonplaats = $Values["Woonplaats"];

    if(empty($_SESSION["winkelwagen_inhoud"]))
        header("location: index.php");

    mysqli_begin_transaction($databaseConnection);

    try{
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

        mysqli_commit($databaseConnection);
    } catch (mysqli_sql_exception $exception){
        mysqli_rollback($databaseConnection);

        throw $exception;
    }


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
        subtractQuantityOnHand($databaseConnection, $product, $amount);
        mysqli_stmt_close($Statement);
    }
    emptyShoppingCart();
}

function subtractQuantityOnHand($databaseConnection, $itemID, $amount){
    $SQL = "UPDATE stockitemholdings
            SET QuantityOnHand = QuantityOnHand - ?
            WHERE StockItemID = ?";
    $Statement = mysqli_stmt_init($databaseConnection);
    if(!mysqli_stmt_prepare($Statement, $SQL)){
        header("location: localhost/nerdy-Clone/nerdy/?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($Statement, "ii", $amount, $itemID);
    mysqli_stmt_execute($Statement);
}