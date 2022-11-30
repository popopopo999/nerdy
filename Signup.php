<?php
include __DIR__ . "/header.php";

function addValue($value){
    if(isset($_GET[$value])){
        $test = $_GET[$value];
        print('value=' . $test);
    }
}

?>

<section class="signup-form">
    <h2>Sign Up</h2>
    <form action="" method="post">
        <input type="text" name="firstname" placeholder="Voornaam" <?php addValue('Voornaam') ?> >
        <input type="text" name="middlename" placeholder="Tussenvoegsel" <?php addValue('TussenVoegsel') ?>>
        <input type="text" name="sirname" placeholder="Achternaam" <?php addValue('Achternaam') ?>>
        <input type="text" name="email" placeholder="E-mail" <?php addValue('E-mailadres') ?>>
        <input type="text" name="uid" placeholder="Gebruikersnaam">
        <input type="password" name="pwd" placeholder="Wachtwoord">
        <input type="password" name="pwdrepeat" placeholder="Herhaal Wachtwoord">
        <input type="text" name="street" placeholder="Straatnaam" <?php addValue('Straatnaam') ?>>
        <input type="text" name="housenumber" placeholder="Huisnummer" <?php addValue('Huisnummer') ?>>
        <input type="text" name="toevoeging" placeholder="Toevoeging" <?php addValue('Toevoeging') ?>>
        <input type="text" name="ZipCode" placeholder="Postcode" <?php addValue('Postcode') ?>>
        <input type="text" name="Telephonenumber" placeholder="Telefoonnummer" <?php addValue('Telefoonnummer') ?>>
        <button type="submit" name="submit"> Signup</button>

    </form>
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
    ?>
    </section>

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
}

include 'footer.php';
?>
