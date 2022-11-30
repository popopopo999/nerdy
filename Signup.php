<?php
include __DIR__ . "/header.php";
?>

<section class="signup-form">
    <h2>Sign Up</h2>
    <form action="" method="post">
        <input type="text" name="firstname" placeholder="Voornaam">
        <input type="text" name="middlename" placeholder="Tussenvoegsel">
        <input type="text" name="sirname" placeholder="Achternaam">
        <input type="text" name="email" placeholder="E-mail">
        <input type="text" name="uid" placeholder="Gebruikersnaam">
        <input type="password" name="pwd" placeholder="Wachtwoord">
        <input type="password" name="pwdrepeat" placeholder="Herhaal Wachtwoord">
        <input type="text" name="street" placeholder="Straatnaam">
        <input type="text" name="housenumber" placeholder="Huisnummer">
        <input type="text" name="toevoeging" placeholder="Toevoeging">
        <input type="text" name="ZipCode" placeholder="Postcode">
        <input type="text" name="Telephonenumber" placeholder="Telefoonnummer">
        <button type="submit" name="submit"> Signup</button>

    </form>
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
?>
?>
<?php
include 'footer.php';
?>
