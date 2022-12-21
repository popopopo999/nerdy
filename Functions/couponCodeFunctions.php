<?php
//Voorbeeld
//function getShoppingcartContents($databaseConnection){
//    if(empty($_SESSION["winkelwagen_inhoud"]))
//        return array();
//
//    $Query = getProductsQuery($_SESSION["winkelwagen_inhoud"]);
//    $Statement = mysqli_prepare($databaseConnection, $Query);
//    //mysqli_stmt_bind_param($Statement, "i", $CategoryID);
//    mysqli_stmt_execute($Statement);
//    $Result = mysqli_stmt_get_result($Statement);
//    return $Result = mysqli_fetch_all($Result, MYSQLI_ASSOC);
//}

function getCouponCodes($coupon, $databaseConnection)
{
    // Onur suggestie:
    $Query = "SELECT CouponCode, DiscountPercentage
              FROM SpecialDeals WHERE CouponCode ='" . $coupon . "'";
    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_execute($Statement);
    $Result = mysqli_stmt_get_result($Statement);
    return $Result = mysqli_fetch_all($Result, MYSQLI_ASSOC);
}

function checkCouponCodeInput($databaseConnection)
{
    $Query = "SELECT CouponCode
              FROM SpecialDeals";
    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_execute($Statement);
    $Result = mysqli_stmt_get_result($Statement);
    return $Result = mysqli_fetch_all($Result, MYSQLI_ASSOC);
}

function getCouponKorting($coupon, $databaseConnection){
    $inputCode = ($coupon["CouponCode"]);
    $couponCodes = getCouponCodes($inputCode, $databaseConnection);
    $perc = $couponCodes[0]["DiscountPercentage"];
    return $perc;
}
