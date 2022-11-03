<?php
function establishWinkelwagen(){
    if(!isset($_SESSION["winkelwagen_inhoud"])){
        $_SESSION["winkelwagen_inhoud"] = array();
    }
}
function addProductToWinkelwagen($product, $amount = 1){
    $winkelwagen = $_SESSION["winkelwagen_inhoud"];
    if(array_key_exists($product, $winkelwagen)){
        $winkelwagen[$product]++;
    }else{
        $winkelwagen[$product] = $amount;
    }
    $_SESSION["winkelwagen_inhoud"] = $winkelwagen;
}
