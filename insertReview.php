<div>

<?php

include __DIR__ . "/header.php";

if(isset($_POST['sendReview'])) {

  if(isset($_SESSION['Gebruikersnaam'])) {
    $username = $_SESSION['Gebruikersnaam'];
    }

    $score = $_POST['score'];
    $reviewText = $_POST['reviewText'];
    $productID = $_POST['productID'];

    if(!reviewToDatabase($username, $score, $reviewText, $databaseConnection, $productID)){
      print("<br><br><h1>U heeft al een review voor dit product geplaatst!</h1>");
?>
    <br>
      <h4> <a href="view.php?id=<?php print($_POST['productID']); ?>">Ga terug naar het product.</a> </h4>
<?php
    } else {
      header('Location: view.php?id='.$_POST['productID']);
    }
}
?>

</div>

