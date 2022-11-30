<?php
include __DIR__ . "/header.php";
?>

<link rel="stylesheet" type="text/css" href="Public\CSS\style.css">
<div id="CenteredContent">
    <div>
    <h2 id="afrekenen">Afrekenen</h2>
    <br>
    <p>Totaal te betalen: €xx,xx</p>
    <br><br>
    <h4>Volledige naam</h4>
    <input type="text" name="Voornaam" id="Voornaam" placeholder="Voornaam"<br>
    <input type="text" name="TussenVoegsel" id="TussenVoegsel" placeholder="Tussenvoegsel"<br>
    <input type="text" name="Achternaam" id="Achternaam" placeholder="Achternaam"<br>
    <br><br><br>
    <h4>Contactgegevens</h4>
    <input type="text" name="Telefoonnummer" id="telefoonnummer" placeholder="Telefoonnummer"<br>
    <input type="text" name="E-mailadres" id="E-mailadres" placeholder="E-mailadres"<br>
    <br><br><br>
    <h4>Adresgegevens</h4>
    <br>
    <h6>Straatnaam</h6>
    <input type="text" name="Straatnaam" id="Straatnaam" placeholder="Straatnaam"<br>
    <br><br>
    <input type="text" name="Huisnummer" id="huisnummer" placeholder="Huisnummer"<br>
    <input type="text" name="Toevoeging" id="toevoeging" placeholder="Toevoeging"<br>
    <br><br>
    <input type="text" name="Postcode" id="postcode" placeholder="Postcode"<br>
    <br><br>
    </div>
    <div>
        <br>
    <label><h3>Account maken? </h3></label>
    <input type="checkbox" class="cbBetalen" id="accountMaken" value="Acc maken" name="Account maken">
    <br><br><br>
    </div>
</div>


<div>
<input type="submit" id="betalenBtn" value="Betalen">
</div>