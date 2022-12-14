<?php
function reviewToDatabase($username, $score, $review, $databaseConnection, $itemID) {
    $date = date("Y-m-d H:i:s");

    $sql = "INSERT INTO productreviews (stockitemID, gebruikersnaam, score, writtenReview, date)
    VALUES (?,?,?,?,?)";

    $Statement = mysqli_stmt_init($databaseConnection);
    if (!mysqli_stmt_prepare($Statement, $sql)) {
        header("location: localhost/nerdy-Clone/nerdy/?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($Statement, "isiss", $itemID, $username, $score, $review, $date);
    try {
        mysqli_stmt_execute($Statement);
    }
    catch (Exception $e) {
        return false;
    }
    mysqli_stmt_close($Statement);
    return true;

}

function howManyReviews($databaseConnection, $itemID) {

    $reviews = "SELECT COUNT(score)
    FROM productreviews
    WHERE stockitemID = ".$itemID;

    $Statement = mysqli_stmt_init($databaseConnection);
    if (!mysqli_stmt_prepare($Statement, $reviews)) {
        header("location: localhost/nerdy-Clone/nerdy/?error=stmtfailed");
        exit();
    }
    //mysqli_stmt_bind_param($Statement, "i", $CategoryID);
    mysqli_stmt_execute($Statement);
    $Result = mysqli_stmt_get_result($Statement);
    $Result = mysqli_fetch_all($Result, MYSQLI_ASSOC);

    return $Result = $Result[0]["COUNT(score)"];
}

function reviewsProduct($databaseConnection, $itemID) {

    $getFromDatabase = "SELECT gebruikersnaam, score, writtenreview, date
    FROM productreviews
    WHERE stockitemID = ".$itemID;

    $Statement = mysqli_prepare($databaseConnection, $getFromDatabase);
    //mysqli_stmt_bind_param($Statement, "i", $CategoryID);
    mysqli_stmt_execute($Statement);
    $Result = mysqli_stmt_get_result($Statement);
    $Result = mysqli_fetch_all($Result, MYSQLI_ASSOC);

    return $Result;
}

function showReviews($reviews) {

    if (empty($reviews)) {
        print("Nog geen reviews geschreven. Laat als eerste een review achter!");
    } else {
?>

    <table>
        <tr>
            <th>Gebruikersnaam</th>
            <th>Score</th>
            <th>Review</th>
            <th>Datum</th>
        </tr>

<?php
        foreach ($reviews as $review) {
            $gebruikersnaam = ($review["gebruikersnaam"]);
            $score = $review["score"];
            $writtenReview = $review["writtenreview"];
            $date = $review["date"];

            print("<tr>");

            print("<td>$gebruikersnaam</td>");
            print("<td>$score</td>");
            print("<td>$writtenReview</td>");
            print("<td>$date</td>");

            print("</tr>");
        }

    }
}

function totalReviewScore($databaseConnection, $itemID) {

  $SQL = "SELECT SUM(score)/COUNT(score)
FROM productreviews
WHERE stockitemID = ".$itemID;

    $Statement = mysqli_prepare($databaseConnection, $SQL);
    //mysqli_stmt_bind_param($Statement, "i", $CategoryID);
    mysqli_stmt_execute($Statement);
    $Result = mysqli_stmt_get_result($Statement);
    $Result = mysqli_fetch_all($Result, MYSQLI_ASSOC);

    $Result = $Result[0]["SUM(score)/COUNT(score)"];

    $Result = round($Result, 1);

    return $Result;
}