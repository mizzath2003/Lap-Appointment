<?php
define("PAGE_TITLE", "Lab Service");
require "include/header.php";
require "components/navbar.php";
require "components/testCard.php";
?>

<section class="ftco-section" id="doctor-section">
    <div class="container-fluid px-5">
        <div class="row justify-content-center mb-5 pb-2">
            <div class="col-md-8 text-center heading-section ftco-animate">
                <h2 class="mb-4">Lab Services</h2>
                <p>Discover our Lab Services – precise, caring, and personalized. We provide accurate diagnostics and reliable results, all for your well-being.</p>
            </div>
        </div>

        <div class="row">

            <?php
            // Assign values to the parameters and call the function
            $testName = "Blood Test";
            $description = "Assess various aspects of health such as cholesterol levels, blood cell counts, and disease markers.";
            $redirectLink = "blood_test.php";

            testCard($testName, $description, $redirectLink);
            testCard($testName, $description, $redirectLink);
            testCard($testName, $description, $redirectLink);
            testCard($testName, $description, $redirectLink);
            testCard($testName, $description, $redirectLink);
            testCard($testName, $description, $redirectLink);
            ?>

        </div>
    </div>
</section>

<?php require "include/footer.php"; ?>