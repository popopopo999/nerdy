<!-- de inhoud van dit bestand wordt bovenaan elke pagina geplaatst -->
<?php
session_start();
include "database.php";
include "functions.php";
$databaseConnection = connectToDatabase();
establishWinkelwagen();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>NerdyGadgets</title>

    <!-- Javascript -->
    <script src="Public/JS/fontawesome.js"></script>
    <script src="Public/JS/jquery.min.js"></script>
    <script src="Public/JS/bootstrap.min.js"></script>
    <script src="Public/JS/popper.min.js"></script>
    <script src="Public/JS/resizer.js"></script>

    <!-- Style sheets-->
    <link rel="stylesheet" href="Public/CSS/style.css" type="text/css">
    <link rel="stylesheet" href="Public/CSS/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="Public/CSS/typekit.css">
</head>
<body>
<div class="Background">
    <div class="row" id="Header">
        <div class="col-2"><a href="./" id="LogoA">
                <div id="LogoImage"></div>
            </a></div>
        <div class="col-8" id="CategoriesBar">
            <ul id="ul-class">
                <?php
                $HeaderStockGroups = getHeaderStockGroups($databaseConnection);

                foreach ($HeaderStockGroups as $HeaderStockGroup) {
                    ?>
                    <li>
                        <a href="browse.php?category_id=<?php print $HeaderStockGroup['StockGroupID']; ?>"
                           class="HrefDecoration"><?php print $HeaderStockGroup['StockGroupName']; ?></a>
                    </li>

                    <?php
                }
                ?>

                <li>
                    <a href="categories.php" class="HrefDecoration">Alle categorieën</a>
                </li>

            </ul>
        </div>
<!-- code voor US3: zoeken -->
<ul id="ul-class-navigation">
    <?php
    if (isset($_SESSION["Gebruikersnaam"])) {
        $username = $_SESSION["Gebruikersnaam"];

        echo "<li>Welkom $username!</li>";
        echo "<li><a href=\"logout.php\" class=\"HrefDecoration\"> Uitloggen</a></li>";
    }
    else {
        echo "<li><a href=\"Signup.php\" class=\"HrefDecoration\"> Aanmelden </a></li>";
        echo "<li><a href=\"login.php\" class=\"HrefDecoration\"> Inloggen</a></li>";
    }
    ?>
            <li>
                <a href="browse.php" class="HrefDecoration"><i class="fas fa-search search"></i> Zoeken</a>
            </li>
            <li>
                <a href="shoppingcart.php"><img src="Public\Img\cartimg.png" width="40" height="40">
                    <i class="result" style="color: yellow;">
                    <?php echo count(getShoppingcartContents($databaseConnection)); ?>
                    <script>
                        $.ajax({
                            url: header.php, // current page
                            type: 'POST',
                            data: {
                                var1: count(getShoppingcartContents($databaseConnection)) // of if writing a JS variable remove the quotes.
                            },
                            success: function() {
                                alert("hoi")
                            }
                        });
                    </script>
                    </i>
                </a>
            </li>
        </ul>

<!-- einde code voor US3 zoeken -->
    </div>
    <div class="row" id="Content">
        <div class="col-12">
            <div id="SubContent">


