<?php
include __DIR__ . "/header.php";

//TODO: updaten zodat hij alle wijzigingen op de hele pagina aanpast.
if(isset($_POST["changeAmountOfItems"])){
    updateNumberOfItems($_POST["productID"], $_POST["Aantal"]);
}

if(isset($_POST["deleteItem"])){
    deleteItem($_POST["productID"]);
}

$cartContents = getShoppingcartContents($databaseConnection);
showShoppingcartContents($cartContents);


include __DIR__ . "/footer.php";
