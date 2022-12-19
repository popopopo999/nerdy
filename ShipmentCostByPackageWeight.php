<?php
include __DIR__ . "/header.php";

$databaseConnection = connectToDatabase();

$inhoud = $_SESSION["winkelwagen_inhoud"];

//function CheckForFilledShoppingCart($id,) {
//if (!empty($inhoud)) {
//   $result = "SELECT TypicalWeightPerUnit FROM stockitems WHERE StockItemID = '$inhoud'";
//
//}
//    return $result;
//}
//
//print_r($inhoud);
//print(CheckForFilledShoppingCart($inhoud));

print_r(AddUnitWeightToShoppingCartItems($inhoud, $databaseConnection));



