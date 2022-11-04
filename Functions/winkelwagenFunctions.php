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
    print($whereClause);
    $query = "
        SELECT * 
        FROM stockItems
        WHERE $whereClause";

    return $query;
}