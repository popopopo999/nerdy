<div>
<?php
include __DIR__ . "/header.php";
?>

<link rel="stylesheet" type="text/css" href="Public\CSS\style.css">
<div id="CenteredContent">
    <form method="POST">
        <input type="text" name="CouponCode" id="CouponCode" placeholder="Coupon code" required <br>
        <input type="submit" name="CouponCodeInvoerBtn" value="Invoeren">
    </form>

    <?php
    if(isset($_POST["CouponCodeInvoerBtn"])) {
        getCouponCodes($_POST);
    } else {
        print("else");
    }
    ?> </div>