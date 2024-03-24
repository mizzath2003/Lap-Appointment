<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php?error=Please log in to access this page.");
    die();
}

define("PAGE_TITLE", "Lab Service");
require "include/header.php";
require "components/navbar.php";
require "components/appointmentCard.php";

?>
<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-4">
                <h1 class="mb-3 bread">Appointments</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Appointments <i class="ion-ios-arrow-forward"></i></span></p>
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

    // Query appointments for the user
    $appointmentQuery = "SELECT `test`, `date`, `time` FROM `tb_appointment` WHERE `userID` = '$userID'";
    $appointmentResult = $conn->query($appointmentQuery);

    if ($appointmentResult->num_rows > 0) {
?>



        <div id="content" class="container py-5 my-5">
            <?php
            // Loop through the appointments and display them
            while ($row = $appointmentResult->fetch_assoc()) {
                $name = $row['test'];
                $date = $row['date'];
                $time = date("g:i A", strtotime($row['time']));
                // Call the appointmentCard function with dynamic data
                appointmentCard($name, $date, $time);
            }
            ?>
        </div>
<?php
    } else {
        echo '
        <div class="text-center heading-section ftco-animatev py-5 my-5">
            <h2 class="mb-4">Appointments not Available</h2>
        </div>';
        $_SESSION['error'] = "No appointments found for the logged-in user.";
    }
} else {
    $_SESSION['error'] = "User not found.";
}

require "include/footer.php";
?>