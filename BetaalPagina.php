<?php
include __DIR__ . "/header.php";
if(isset($_SESSION["Gebruikersnaam"])){
    header('Location: https://www.ideal.nl/demo/qr/?app=ideal');
}
?>

<link rel="stylesheet" type="text/css" href="Public\CSS\style.css">
<div id="CenteredContent">
    <form method="post" action="betaalDoorverwijzing.php">
        <div>
            <h2 id="afrekenen">Afrekenen</h2>
            <br>
            <p>Totaal te betalen: €<?php echo(sprintf(" %0.2f", $_SESSION["totaalprijs"]));?></p>
            <br><br>
            <h4>Volledige naam</h4>
            <input type="text" name="firstname" id="Voornaam" placeholder="Voornaam" required <br>
            <input type="text" name="middlename" id="TussenVoegsel" placeholder="Tussenvoegsel"<br>
            <input type="text" name="sirname" id="Achternaam" placeholder="Achternaam" required <br>
            <br><br><br>
            <h4>Contactgegevens</h4>
            <input type="text" name="Telephonenumber" id="telefoonnummer" placeholder="Telefoonnummer" required <br>
            <input type="email" name="email" id="E-mailadres" placeholder="E-mailadres" required<br>
            <br><br><br>
            <h4>Adresgegevens</h4>
            <br>
            <h6>Straatnaam</h6>
            <input type="text" name="street" id="Straatnaam" placeholder="Straatnaam" required<br>
            <br><br>
            <input type="text" name="housenumber" id="huisnummer" placeholder="Huisnummer" required<br>
            <input type="text" name="toevoeging" id="toevoeging" placeholder="Toevoeging"<br>
            <br><br>
            <input type="text" name="ZipCode" id="postcode" placeholder="Postcode" required <br>
            <br><br>
        </div>
        <div>
            <br>
            <label><h3>Account maken? </h3></label>
            <input type="checkbox" class="cbBetalen" id="accountMaken" value="Acc_maken" name="Account_maken">
            <div>
                <input type="submit" id="betalenBtn" value="Betalen">
            </div>
        </div>
    </form>
</div>