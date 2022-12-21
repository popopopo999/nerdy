<?php
function establishWinkelwagen(){
    if(!isset($_SESSION["winkelwagen_inhoud"])){
        $_SESSION["winkelwagen_inhoud"] = array();
    }
}
function addProductToWinkelwagen($product, $amount = 1){
    $winkelwagen = $_SESSION["winkelwagen_inhoud"];
    if(array_key_exists($product, $winkelwagen)){
        $winkelwagen[$product] += $amount;
    }else{
        $winkelwagen[$product] = $amount;
    }
    $_SESSION["winkelwagen_inhoud"] = $winkelwagen;
}
function getProductsQuery($products){
    $whereClause = "StockItemID = ";
    $i = 0;
    foreach(array_keys($products) as $product){
        $whereClause .= $product;

        if($i != count($products) - 1){
            $whereClause .= " OR StockItemID = ";
        }
        $i++;
    }
    $query = "
        SELECT *, 
        (SELECT ImagePath FROM stockitemimages WHERE StockItemID = SI.StockItemID LIMIT 1) as ImagePath,
        (SELECT ImagePath FROM stockgroups JOIN stockitemstockgroups USING(StockGroupID) WHERE StockItemID = SI.StockItemID LIMIT 1) as BackupImagePath
        FROM stockItems SI
        JOIN stockitemholdings SIH USING(stockitemid)
        JOIN stockitemstockgroups USING(StockItemID)
        JOIN stockgroups ON stockitemstockgroups.StockGroupID = stockgroups.StockGroupID
        WHERE $whereClause
        GROUP BY StockItemID";

    return $query;
}

function getShoppingcartContents($databaseConnection){
    if(empty($_SESSION["winkelwagen_inhoud"]))
        return array();

    $Query = getProductsQuery($_SESSION["winkelwagen_inhoud"]);
    $Statement = mysqli_prepare($databaseConnection, $Query);
    //mysqli_stmt_bind_param($Statement, "i", $CategoryID);
    mysqli_stmt_execute($Statement);
    $Result = mysqli_stmt_get_result($Statement);
    return $Result = mysqli_fetch_all($Result, MYSQLI_ASSOC);
}

function deleteItem($key){
    $products = $_SESSION["winkelwagen_inhoud"];
    unset($products[$key]);
    $_SESSION["winkelwagen_inhoud"] = $products;
}

function updateNumberOfItems($key, $amount){
    $products = $_SESSION["winkelwagen_inhoud"];
    $products[$key] = $amount;
    $_SESSION["winkelwagen_inhoud"] = $products;
}

function emptyShoppingCart(){
    $_SESSION["winkelwagen_inhoud"] = array();
}
