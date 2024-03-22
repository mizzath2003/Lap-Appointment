<?php
session_start();

define("PAGE_TITLE", "Lab Service");
require "dbh/dbdata.php";
require "include/header.php";
require "components/navbar.php";
require "components/testCard.php";
?>

<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-4">
                <h1 class="mb-3 bread">Lab Services</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Lab Services <i class="ion-ios-arrow-forward"></i></span></p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section" id="doctor-section">
    <div class="container-fluid px-5">
        <div class="row justify-content-center mb-5 pb-2">
            <div class="col-md-8 text-center heading-section ftco-animatev">
                <h2 class="mb-4">Lab Services</h2>
                <p>Discover our Lab Services – precise, caring, and personalized. We provide accurate diagnostics and reliable results, all for your well-being.</p>
            </div>
        </div>

        <div class="row">

            <?php
            $sql = "SELECT `Name`, `Description` FROM `tb_test` ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $testName = $row['Name'];
                    $description = $row['Description'];

                    // Call the testCard function with dynamic data
                    testCard($testName, $description);
                }
            }
            ?>

        </div>
    </div>
</section>

<?php require "include/footer.php"; ?>