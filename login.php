
<?php
include 'header.php';

if(isset($_POST["submit"]))
    login();
?>

<section class="signup-form">
    <h2>Log In</h2>
    <form action="" method="post">
        <input type="text" name="uid" placeholder="Gebruikersnaam/E-Mail">
        <input type="password" name="pwd" placeholder="Wachtwoord">
        <button type="submit" name="submit"> Log In</button>

    </form>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>Niet alle verplichte velden zijn ingevuld!</p>";
        }
        elseif ($_GET["error"] == "wronglogin") {
            echo "<p>Account informatie komt niet overeen</p>";
        }
    }

    ?>
    </section>
<?php
include 'footer.php';
?>
