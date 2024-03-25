<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php?error=Please log in to access this page.");
    die();
}

define("PAGE_TITLE", "Lab Service");
require "include/header.php";
require "components/navbar.php";
require "components/reportCard.php";

?>
<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-4">
                <h1 class="mb-3 bread">Reports</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Reports <i class="ion-ios-arrow-forward"></i></span></p>
            </div>
        </div>
    </div>
</section>

<?php

include_once "dbh/dbdata.php";

// Retrieve the userID of the logged-in user based on their email
$email = $_SESSION['email'];
$userQuery = "SELECT `userID` FROM `tb_user` WHERE `email` = '$email'";
$userResult = $conn->query($userQuery);

if ($userResult->num_rows > 0) {
    $userData = $userResult->fetch_assoc();
    $userID = $userData['userID'];

    // Query reports for the user
    $reportQuery = "SELECT `test`, `date`, `time`, `Report` FROM `tb_appointment` WHERE `userID` = '$userID' AND `Report` != ''";
    $reportResult = $conn->query($reportQuery);

    if ($reportResult->num_rows > 0) {
?>

        <div class="container py-5 my-5">
            <?php
            // Loop through the reports and display them
            while ($row = $reportResult->fetch_assoc()) {
                $name = $row['test'];
                $date = $row['date'];
                $time = date("g:i A", strtotime($row['time']));
                $link = $row['Report'];
                // Call the reportCard function with dynamic data
                reportCard($name, $date, $time, $link);
            }
            ?>
        </div>
<?php
    } else {
        echo '
        <div class="text-center heading-section ftco-animatev py-5 my-5">
            <h2 class="mb-4">Reports not Available</h2>
        </div>';
        $_SESSION['error'] = "No reports found for the logged-in user.";
    }
} else {
    $_SESSION['error'] = "User not found.";
}

require "include/footer.php";
?>