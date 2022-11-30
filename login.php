
<?php
include 'header.php';
?>

<section class="signup-form">
    <h2>Log In</h2>
    <form action="Functions/login.inc.php" method="post">
        <input type="text" name="uid" placeholder="Gebruikersnaam/E-Mail">
        <input type="password" name="pwd" placeholder="Wachtwoord">
        <button type="submit" name="submit"> Log In</button>

    </form>
    </section>
<?php
include 'footer.php';
?>
