<?php
include __DIR__ . "/header.php";

if(isset($_POST["submit"])){
    $_SESSION["Account_maken"] = $_POST;
    signUp();
}

function addValue($value){
    if(isset($_SESSION["Account_maken"][$value])){
        $test = $_SESSION["Account_maken"][$value];
        print('value=' . $test);
    }
}

?>

<section class="signup-form">
    <div id="CenteredContent">
        <h2>Sign Up</h2>
        <form action="" method="post">
            <div id="userDetails">
                <input type="text" name="uid" placeholder="Gebruikersnaam">
                <input type="password" name="pwd" placeholder="Wachtwoord">
                <input type="password" name="pwdrepeat" placeholder="Herhaal Wachtwoord">
            </div>
            <div id="signUpBox">

                <input type="text" name="firstname" placeholder="Voornaam" <?php addValue('firstname') ?> >
                <input type="text" name="middlename" placeholder="Tussenvoegsel" <?php addValue('middlename') ?>>
                <input type="text" name="sirname" placeholder="Achternaam" <?php addValue('sirname') ?>>
                <input type="text" name="Telephonenumber" placeholder="Telefoonnummer" <?php addValue('Telephonenumber') ?>>
                <input type="email" name="email" placeholder="E-mail" <?php addValue('email') ?>>
                <input type="text" name="street" placeholder="Straatnaam" <?php addValue('street') ?>>
                <input type="text" name="housenumber" placeholder="Huisnummer" <?php addValue('housenumber') ?>>
                <input type="text" name="toevoeging" placeholder="Toevoeging" <?php addValue('toevoeging') ?>>
                <input type="text" name="ZipCode" placeholder="Postcode" <?php addValue('ZipCode') ?>>
            </div>
            <button type="submit" name="submit" id="betalenBtn"> Signup</button>

        </form>
    </div>

    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>Niet alle verplichte velden zijn ingevuld!</p>";
        }
        elseif ($_GET["error"] == "invaliduid") {
            echo "<p>De gebruikersnaam is niet valide</p>";
        }
        elseif ($_GET["error"] == "invalidemail") {
            echo "<p>De E-mail is niet valide</p>";
        }
        elseif ($_GET["error"] == "passwordsdontmatch") {
            echo "<p>De wachtwoorden komen niet overeen</p>";
        }
        elseif ($_GET["error"] == "usernametaken") {
            echo "<p>De gebruikersnaam is al in gebruik</p>";
        }
        elseif ($_GET["error"] == "stmtfailed") {
            echo "<p>Er ging iets fout.. probeer het a.u.b. opnieuw</p>";
        }
        elseif ($_GET["error"] == "none") {
            echo "<p>U bent ingelogd!</p>";
        }
    }

    include 'footer.php';
    ?>
    </section>
