<?php
include __DIR__ . "/header.php";

if(isset($_POST["submit"])){
    $_SESSION["Account_maken"] = $_POST;
    signUp();
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
            <?php showUserForm(); ?>
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
