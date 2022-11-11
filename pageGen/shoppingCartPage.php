<?php

function showShoppingcartContents($contents){
    if(empty($contents))
        print("<h1>Shopping cart is empty!</h1>");

    foreach($contents as $row) {
        ?>


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
                        <h1 class="StockItemPriceText"><?php print sprintf(" %0.2f", berekenVerkoopPrijs($row["RecommendedRetailPrice"], $row["TaxRate"])); ?></h1>
                        <h6>Inclusief BTW </h6>
                        <form method="post">
                            <label for="Aantal">Aantal:</label>
                            <input class="Aantal" type="number" min="1" name="Aantal" value="<?php print($_SESSION["winkelwagen_inhoud"][$row["StockItemID"]]) ?>"><br>
                            <input class="btnToevoegen" type="submit" name="changeAmountOfItems" value="Pas aantal items aan"><br>
                            <input type="hidden" name="productID" value="<?php print $row['StockItemID']; ?>">
                            <input class="btnToevoegen" type="submit" name="deleteItem" value="Verwijder uit winkelwagen">
                        </form>
                    </div>
                </div>
                <h1 class="StockItemID">Artikelnummer: <?php print $row["StockItemID"]; ?></h1>
                <p class="StockItemName"><?php print $row["StockItemName"]; ?></p>
                <p class="StockItemComments"><?php print $row["MarketingComments"]; ?></p>
            </div>

        <?php
    }
}
    ?>