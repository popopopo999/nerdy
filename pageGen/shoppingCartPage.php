<div id="shoppingcartContainer">
<?php
function showShoppingcartContents($contents){
    $databaseConnection = connectToDatabase();
$totalWeight = 0;
$shippingPrice = 0;
$databaseConnection = connectToDatabase();
    $totalPrijsArr = Array();
    if(empty($contents))
    print("<h1>Shopping cart is empty!</h1>");
    
    foreach($contents as $row) {
        $prijs = sprintf(" %0.2f", berekenVerkoopPrijs($row["RecommendedRetailPrice"], $row["TaxRate"])*$_SESSION["winkelwagen_inhoud"][$row["StockItemID"]]);
        $voorraad = str_replace("Voorraad: ", "", $row['QuantityOnHand']);
        $aantal = $_SESSION["winkelwagen_inhoud"][$row["StockItemID"]];
        ?>
        <link rel="stylesheet" href="Public/CSS/style.css" type="text/css">
        <style>
        #ProductFrame {
            width: 70%;
            border: 1px solid red;
            display:inline-block;
        }
        </style>
            <!-- einde coderegel 1 van User story: bekijken producten   -->
                <div id="ProductFrame">
                    <a class="ListItem" href='view.php?id=<?php print $row['StockItemID']; ?>'>
                    <?php
                    if (isset($row['ImagePath'])) { ?>
                        <div class="ImgFrame"
                            style="background-image: url('<?php print "Public/StockItemIMG/" . $row['ImagePath']; ?>'); background-size: 230px; background-repeat: no-repeat; background-position: center;"></div>
                    <?php } else if (isset($row['BackupImagePath'])) { ?>
                        <div class="ImgFrame"
                            style="background-image: url('<?php print "Public/StockGroupIMG/" . $row['BackupImagePath'] ?>'); background-size: cover;"></div>
                    <?php }
                    ?>
                    </a>
                    <div id="StockItemFrameRight">
                        <div class="CenterPriceLeftChild">
                            <h1 class="StockItemPriceText">&euro;<?php print $prijs; ?></h1>
                            <h6>Inclusief BTW </h6>
                            <form method="post">
                                <label for="Aantal">Aantal:</label>
                                <input class="Aantal" type="number" min="1" max="<?php print $voorraad; ?>" name="Aantal" value="<?php print $aantal; ?>"><br>
                                <input class="btnAanpassen" type="submit" name="changeAmountOfItems" value="Pas aan"><br>
                                <input type="hidden" name="productID" value="<?php print $row['StockItemID']; ?>">
                                <input class="btnVerwijder" type="submit" name="deleteItem" value="Verwijder">
                            </form>
                        </div>
                    </div>
                    <h1 class="StockItemID">Artikelnummer: <?php print $row["StockItemID"]; ?></h1>
                    <p class="StockItemName">
                        <a class="WinkelLink" href="view.php?id=<?php print $row["StockItemID"];?>">
                            <?php print $row["StockItemName"]; ?>
                        </a>
                    </p>
                    <p class="StockItemComments"><?php print $row["MarketingComments"]; ?></p>
                </div>
                <?php
                array_push($totalPrijsArr, $prijs);
                //unset($_SESSION["items"][$row['StockItemID']]);
                // print_r($row['StockItemID']);
                AddUnitWeightToShoppingCartItems($row["StockItemID"], $databaseConnection);
                $totalWeight = $totalWeight + AddUnitWeightToShoppingCartItems($row["StockItemID"], $databaseConnection) * $aantal;
                if ($totalWeight <= 1) {
                    $shippingPrice = 0.69;
                } else {
                    if ($totalWeight >1 and $totalWeight <= 3) {
                        $shippingPrice = 4.200;
                    } else {
                        if ($totalWeight > 3 and $totalWeight <= 10) {
                            $shippingPrice = 5.99;
                        } else {
                            if ($totalWeight > 10) {
                                $shippingPrice = 10;
                            }
                        }
                    }
                }
    }
                $_SESSION["totaalprijs"] = array_sum($totalPrijsArr);
                $_SESSION["cartInhoudArr"] = count($totalPrijsArr); 
                $btw = $_SESSION["totaalprijs"] * 0.21;
            # Afrekenen section
            if(!empty($contents)) { ?>
                <div id="totaalprijscart">
                    <table class="tblCheckout">
                        <tr>
                            <td colspan="2"><h2 class="totaalprijs">Totaalprijs</h2></td>
                        <tr>
                            <td>Verzending</td>
                            <td>&euro; <?php print($shippingPrice) ?></td>
                        </tr>
                        <tr>
                            <td>Totaalprijs (inclusief btw)</td>
                            <td>&euro; <?php echo(sprintf(" %0.2f", $_SESSION["totaalprijs"]));?> </td>
                        </tr>
                        <tr>
                            <td>Couponkorting</td>
                            <?php
                            if(isset($_POST["CouponCodeInvoerBtn"])){
                                $_SESSION["totaalprijs"] *=
                                    ((100-getCouponKorting($_POST, $databaseConnection)) / 100);
                                ?>
                                <td>
                                    <?php echo(sprintf(" %0.2f", $_SESSION["totaalprijs"]));?>
                                </td>
                                <?php
                            }
                            ?>

                        </tr>
                        <tr>
                            <td colspan="2">
                                <form method="POST" action="BetaalPagina.php">
                                    <input type="hidden" name="totaalPrijs" value="<?php $_SESSION["totaalprijs"]; ?>">
                                    <input id="payButton" type="submit" name="verwijzingBetaling" value="Betalen"
                                    <input class="payButton" type="submit" name="verwijzingBetaling" value="Betalen">
                            </td>
                    </form>
                            <form method="POST">
                                <input type="text" name="CouponCode" id="CouponCode" placeholder="Coupon code" required <br>
                                <input type="submit" name="CouponCodeInvoerBtn" id="CouponCodeInvoerBtn" value="Invoeren">
                            </form>
                        </tr>
                    </table>
                </div>
            </div>
        <?php   
        }
        ?>
            <style>
            .col-md-3{
                border: 1px solid;
                margin: 1%;
                box-shadow: 5px 10px #000000;
            }
           .container{
            margin-top: 5%;
            margin-left: -0.5%;
            margin-bottom: 2%;
           }
           .aanbevolenLink{
            color: white;
           }
           .price{
            color: yellow;
            border-bottom: 1px solid white;
            font-weight: bold;
           }
            </style>
        <div class="container">
            <div id="recommendedItems">
                <h1 style="border-bottom: 1px solid grey; width:80%";>Aanbevolen artikelen voor jou!</h1>
                <div class="row">
                    <?php
                    $databaseConnection = connectToDatabase();
                    $query = "select StockItemID from stockitems";
                    $result = $databaseConnection->query($query);
                    $totalItemsWebArr = Array();
                    if(!$result){
                        die(mysqli_error($databaseConnection));
                    }
                    if (mysqli_num_rows($result) >= 0) {
                        while($row = mysqli_fetch_array($result)){
                            array_push($totalItemsWebArr, $row["StockItemID"]);
                        }
                    }
                    if (!isset($_SESSION["items"])){
                        $_SESSION['items'] = array();
                    }
                    while (count($_SESSION["items"]) <= 2){
                        $_SESSION["items"][rand(1, count($totalItemsWebArr))] =  0;
                    }
                    arsort($_SESSION["items"]);
                    $slicedArr = array_slice($_SESSION["items"], 0, 3, true);
                    $result = connectToDatabase()->query(getProductsQuery($slicedArr));
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '
                            <div class="col-md-3 col-sm-6">
                                <a class="aanbevolenLink" href="view.php?id='. $row["StockItemID"] . '">';
                                if(isset($row['ImagePath'])) { ?>
                                    <div class="ImgFrame"
                                        style="background-image: url('<?php print "Public/StockItemIMG/" . $row['ImagePath']; ?>'); background-size: 230px; background-repeat: no-repeat; background-position: center;">
                                    </div>
                                    <?php echo '
                                    <h5>"' . $row['StockItemName'] . '"</h5>
                                    <p class="price">&euro;'. sprintf(" %0.2f", berekenVerkoopPrijs($row["RecommendedRetailPrice"], $row["TaxRate"])) . '</p>
                                </a></div>';
                                } elseif(isset($row['BackupImagePath'])) { ?>
                                    <div class="ImgFrame"
                                        style="background-image: url('<?php print "Public/StockGroupIMG/" . $row['BackupImagePath'] ?>'); background-size: cover;">
                                    </div>
                                    <?php echo '
                                    <h5>"' . $row['StockItemName'] . '"</h5>
                                    <p class="price">&euro;'. sprintf(" %0.2f", berekenVerkoopPrijs($row["RecommendedRetailPrice"], $row["TaxRate"])) . '</p>
                                </a>   
                            </div>';
                                    }
                        }
                    }else {
                        print("");
                    }
}
?>
</div>