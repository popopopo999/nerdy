<?php
include __DIR__ . "/header.php";

$Query = getProductsQuery($_SESSION["winkelwagen_inhoud"]);
$Statement = mysqli_prepare($databaseConnection, $Query);
//mysqli_stmt_bind_param($Statement, "i", $CategoryID);
mysqli_stmt_execute($Statement);
$Result = mysqli_stmt_get_result($Statement);
$Result = mysqli_fetch_all($Result, MYSQLI_ASSOC);

foreach($Result as $products) {
?>

<div id="ProductFrame">
    <div class="ImgFrame"></div>
</div>

<?php
}

?>

<?php
include __DIR__ . "/footer.php";
?>
