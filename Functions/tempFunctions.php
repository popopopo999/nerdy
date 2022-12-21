<?php
function getCurrentTemperature($databaseConnection)
{

    $Query = "SELECT Temperature from coldroomtemperatures where ColdRoomSensorNumber = 5";
    $stmt = $databaseConnection->prepare($Query);
    $stmt->execute();
    $Result = $stmt->get_result();
    $row = mysqli_fetch_array($Result);
    return $row['Temperature'];
}

function checkIfChillerStock($databaseConnection, $Stockitem)
{
    $Result = null;


    $Query = ("SELECT IsChillerStock FROM stockitems WHERE StockItemID = ?");
    $Statement = mysqli_stmt_init($databaseConnection);
    if (!mysqli_stmt_prepare($Statement, $Query)) {
        header("location: localhost/nerdy-Clone/nerdy/?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($Statement, "i", $Stockitem);
    mysqli_stmt_execute($Statement);
    $Result = mysqli_stmt_get_result($Statement);
    $Result = mysqli_fetch_all($Result, MYSQLI_ASSOC)[0];
   /* if ($Result && mysqli_num_rows($Result) == 1) {

    }*/
    if ($Result['IsChillerStock'] == 1) {
        return true;
    } else {
        return false;
    }
}
?>







