<!-- dit bestand bevat alle code voor de pagina die één product laat zien -->
<?php
include __DIR__ . "/header.php";

$StockItem = getStockItem($_GET['id'], $databaseConnection);
$StockItemImage = getStockItemImage($_GET['id'], $databaseConnection);
$StockItemGroups = getStockgroupsImage($_GET['id'], $databaseConnection);
$pVoorraad = str_replace("Voorraad: ", "", $StockItem['QuantityOnHand']);

?>
<div id="CenteredContent">
    <?php
    if ($StockItem != null) {
        ?>
        <?php
        if (isset($StockItem['Video'])) {
            ?>
            <div id="VideoFrame">
                <?php print $StockItem['Video']; ?>
            </div>
        <?php
        }
        ?>
        <div id="ArticleHeader">
            <?php
            if(!$StockItemImage) {
                ?>
            <div id="ImageFrame"
                 style="background-image: url('Public/StockGroupIMG/<?php print $StockItemGroups[0]['ImagePath']; ?>'); background-size: 300px; background-repeat: no-repeat; background-position: center;"></div>
                <?php
            }
            ?>
            <?php
            if (isset($StockItemImage)) {
                // één plaatje laten zien
                if (count($StockItemImage) == 1) {
                    ?>
                    <div id="ImageFrame"
                         style="background-image: url('Public/StockItemIMG/<?php print $StockItemImage[0]['ImagePath']; ?>'); background-size: 300px; background-repeat: no-repeat; background-position: center;"></div>
                    <?php
                } else if (count($StockItemImage) >= 2) { ?>
                    <!-- meerdere plaatjes laten zien -->
                    <div id="ImageFrame">
                        <div id="ImageCarousel" class="carousel slide" data-interval="false">
                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                                <?php for ($i = 0; $i < count($StockItemImage); $i++) {
                                    ?>
                                    <li data-target="#ImageCarousel"
                                        data-slide-to="<?php print $i ?>" <?php print (($i == 0) ? 'class="active"' : ''); ?>></li>
                                    <?php
                                } ?>
                            </ul>

                            <!-- slideshow -->
                            <div class="carousel-inner">
                                <?php for ($i = 0; $i < count($StockItemImage); $i++) {
                                    ?>
                                    <div class="carousel-item <?php print ($i == 0) ? 'active' : ''; ?>">
                                        <img src="Public/StockItemIMG/<?php print $StockItemImage[$i]['ImagePath'] ?>">
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- knoppen 'vorige' en 'volgende' -->
                            <a class="carousel-control-prev" href="#ImageCarousel" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#ImageCarousel" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div id="ImageFrame"
                     style="background-image: url('Public/StockGroupIMG/<?php print $StockItem['BackupImagePath']; ?>'); background-size: cover;"></div>
                <?php
            }

            ?>


        <?php
        if(isset($_POST["btnToevoegen"])){
            addProductToWinkelwagen($_POST["itemID"], $_POST["Aantal"]);
            //header("Location: shoppingcart.php");
            }
        ?>
        <form method="post">
            <h1 class="StockItemID" name="StockItemID">Artikelnummer: <?php print $StockItem["StockItemID"]; ?> <br><br>
                <p><?php print(totalReviewScore($databaseConnection, $_GET['id'])) ?> / 5 (<?php print(howManyReviews($databaseConnection, $_GET['id'])); ?> reviews)</p></h1>
            <input type="hidden" name="itemID" value="<?php print $StockItem["StockItemID"] ?>">
            <h2 class="StockItemNameViewSize StockItemName">
                <?php print $StockItem['StockItemName']; ?>
            </h2>
            <div class="QuantityText"><?php print getVoorraadTekst($StockItem); ?></div>
            <div id="StockItemHeaderLeft">
                <div class="CenterPriceLeft">
                    <div class="CenterPriceLeftChild">
                        <p class="StockItemPriceText"><b><?php print sprintf("€ %.2f", $StockItem['SellPrice']); ?></b></p>
                        <h6> Inclusief BTW </h6>
                            <label for="Aantal">Aantal:</label> 
                            <input class="Aantal" name="Aantal" type="number" value="1" min="1" max="<?php print($pVoorraad);?>">
                            <button class="btnToevoegen" name="btnToevoegen" type="submit">Toevoegen aan winkelwagen</button>
        </form>


        <form method="post" action="shoppingcart.php">
            <?php
            if(isset($_POST["btnToevoegen"])){
                ?>
                <br> <button class="btnWinkel" name="NaarWinkelwagen" type="submit">Toegevoegd! Ga hier naar je winkelwagen</button>
                <?php
            }
            ?>
            </div>
        </form>

        </div>
        </div>
        </div>
        </div>

        <div id="StockItemDescription">
            <h3>Artikel beschrijving</h3>
            <p><?php print $StockItem['SearchDetails']; ?></p>
        </div>
        <div id="StockItemSpecifications">
            <h3>Artikel specificaties</h3>
            <?php
            $CustomFields = json_decode($StockItem['CustomFields'], true);
            if (is_array($CustomFields)) { ?>
                <table>
                <thead>
                <th>Naam</th>
                <th>Data</th>
                </thead>
                <?php
                foreach ($CustomFields as $SpecName => $SpecText) { ?>

                    <tr>
                        <td>
                            <?php print $SpecName;
                            ?>

                        </td>
                        <td>
                            <?php
                            if (is_array($SpecText)) {
                                foreach ($SpecText as $SubText) {
                                    print $SubText . " ";
                                }
                            } else {
                                print $SpecText;
                            }
                           ?>

                        </td>

                    </tr>

                <?php } ?>

                <tr>
                    <td>
                        <p>Temperatuur </p>

                    </td>
                    <td>
                        <?php
                            if (checkIfChillerStock($databaseConnection, $StockItem["StockItemID"])){
                                $temp =getCurrentTemperature($databaseConnection);
                                print $temp;

                                }
                        else {
                            print ("Temperatuur is niet van toepassing op dit product.");
                        }
                        ?>

                        </
                    </td>
                </tr>

                </table><?php
            } else { ?>
            <table>

                <td>
                <p><?php print $StockItem['CustomFields']; ?>.</p>

                <?php
            }?>


                </td>
            </table>



        </div>
        <?php
    } else {
        ?><h2 id="ProductNotFound">Het opgevraagde product is niet gevonden.</h2><?php
    } ?>
</div>

<!-- Reviews -->

<div id="reviewArea">
    <div id="reviewBox">
    <h3> <?php print(totalReviewScore($databaseConnection, $_GET['id'])) ?> / 5 </h3>
    </div>
    <h6> <br>Op basis van <?php print(howManyReviews($databaseConnection,$_GET['id'])); ?> reviews<br><br></h6>
<div id="reviewForm">
    <br>
<?php if(isset($_SESSION["Gebruikersnaam"])) { ?>
    <form method="POST" action="insertReview.php">
        <input type="hidden" name="productID" value="<?php print($_GET['id']); ?>">
        Score <input type="number" name="score" value="" min="1" max="5" placeholder="Geef hier een score van 1 tot 5" required>
        Review <textarea name="reviewText" placeholder="Schrijf hier uw review." required></textarea>
        <input type="submit" name="sendReview" value="Plaats review">
    </form>
    <?php } ?>
</div>
    <div id="reviewList">
    <?php
    $aantalReviews = reviewsProduct($databaseConnection, $_GET['id']);
    showReviews($aantalReviews);
    ?>
    </div>
</div>