<div id="shoppingcartContainer">
<?php
function showShoppingcartContents($contents){
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
                            <td>&euro; 0</td>
                        </tr>
                        <tr>
                            <td>Totaalprijs (inclusief btw)</td>
                            <td>&euro; <?php echo(sprintf(" %0.2f", $_SESSION["totaalprijs"]));?> </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button class="btnCheckout">Afrekenen</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php  
            }
}
?>