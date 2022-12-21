<?php
$disabled = "";

function addValue($value){
    if(isset($_SESSION["Account_maken"][$value])){
        $test = $_SESSION["Account_maken"][$value];

        if($test != "")
            print('value=' . $test);
    }
}

function showUserForm(){

    ?>
    <input type="text" name="Voornaam" id="Voornaam" placeholder="Voornaam" required  <?php addValue('Voornaam') ?>  <br>
    <input type="text" name="Tussenvoegsel" id="TussenVoegsel" placeholder="Tussenvoegsel" <?php addValue('Tussenvoegsel') ?> <br>
    <input type="text" name="Achternaam" id="Achternaam" placeholder="Achternaam" required  <?php addValue('Achternaam') ?> <br>
    <br><br><br>
    <h4>Contactgegevens</h4>
    <input type="text" name="Telefoonnummer" id="telefoonnummer" placeholder="Telefoonnummer" required <?php addValue('Telefoonnummer') ?> <br>
    <input type="email" name="Email" id="E-mailadres" placeholder="E-mailadres" required <?php addValue('Email') ?> <br>
    <br><br><br>
    <h4>Adresgegevens</h4>
    <br>
    <h6>Woonplaats</h6>
    <input type="text" name="Woonplaats" id="Straatnaam" placeholder="Woonplaats" require <?php addValue('Woonplaats') ?> <br>
    <h6>Straatnaam</h6>
    <input type="text" name="Straatnaam" id="Straatnaam" placeholder="Straatnaam" require <?php addValue('Straatnaam') ?> <br>
    <br><br>
    <input type="text" name="Huisnummer" id="huisnummer" placeholder="Huisnummer" required <?php addValue('Huisnummer') ?> <br>
    <input type="text" name="Toevoeging" id="toevoeging" placeholder="Toevoeging" <?php addValue('Toevoeging') ?> <br>
    <br><br>
    <input type="text" name="Postcode" id="postcode" placeholder="Postcode" required <?php addValue('Postcode') ?> <br>
    <br><br>
<?php
}
