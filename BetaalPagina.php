<?php
include __DIR__ . "/header.php";
$disabled = "";
if(isset($_SESSION["Gebruikersnaam"])){
    $userData = getUserData($databaseConnection);
    $_SESSION["Account_maken"] = $userData[0];
    $disabled = "disabled";
}
?>

<link rel="stylesheet" type="text/css" href="Public\CSS\style.css">
<div id="CenteredContent">
    <form method="post" action="betaalDoorverwijzing.php">
        <div>
            <h2 id="afrekenen">Afrekenen</h2>
            <br>
            <?php showUserForm(); ?>
        </div>
        <div>
            <br>
            <label><h3>Account maken? </h3></label>
            <input type="checkbox" class="cbBetalen" id="accountMaken" value="Acc_maken" name="Account_maken" <?php print($disabled); ?>>
            <div>
                <input type="submit" id="betalenBtn" value="Betalen">
            </div>
        </div>
    </form>
</div>