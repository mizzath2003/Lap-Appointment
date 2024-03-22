<?php
session_start();
define("PAGE_TITLE", "Sign Up");
require "include/header.php";
require "components/navbar.php";



require('dbh/dbdata.php');

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM tb_user WHERE email = '$email'";
    $result = $conn->query($sql);

    // Check if data is retrieved successfully
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Assign retrieved values to variables
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
    }
} else {
    $name = "";
    $email = "";
    $phone = "";
}
?>

<style>
    .colorBlack {
        color: black;
        font-weight: 600;
    }

    .formInput {
        font-size: 17px;
    }
</style>

<section class="hero-wrap  hero-wrap-1" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-4">
                <h1 class="mb-3 bread">Book Appointment</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Book Appointment <i class="ion-ios-arrow-forward"></i></span></p>
            </div>
        </div>
    </div>
</section>

<!-- <section> begin ============================-->
<section id="bookappointment">
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center mb-5 pb-2 mt-5">
            <div class="col-md-8 text-center heading-section ftco-animate">
                <h2 class="mb-4">Book an Appointment</h2>
            </div>
        </div>
        <div class="row align-items-center px-md-5">
            <div class="mx-auto px-md-5">
                <form onsubmit="return verifyPasswords()" action="dbh/bookAppointment.php" method="POST" class="d-flex justify-content-center align-items-center row g-3 needs-validation px-md-5" novalidate>
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label colorBlack">Patient Name</label>
                        <input type="text" class="form-control formInput" id="validationCustom01" name="name" value="<?= $name ?>" required>
                        <div class="invalid-feedback">
                            Please enter your name.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="validationCustom02" class="form-label colorBlack">Email</label>
                        <div class="input-group has-validation">
                            <input type="email" class="form-control formInput" id="validationCustom02" name="email" value="<?= $email ?>" aria-describedby="inputGroupPrepend" required>
                            <div class="invalid-feedback">
                                Please enter a valid email.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="validationCustom03" class="form-label colorBlack">Mobile Number</label>
                        <input type="text" class="form-control formInput" name="phone" value="<?= $phone ?>" id="validationCustom03" required>
                        <div class="invalid-feedback">
                            Please enter a valid mobile number.
                        </div>
                    </div>



                    <div class="col-md-4">
                        <label for="validationCustom04" class="form-label colorBlack">Test</label>
                        <select class="form-select" name="test" id="validationCustom04" required>
                            <option selected disabled value="">Select Test</option>
                            <?php
                            // Fetch test names from the database and populate them as options
                            $sqlTests = "SELECT `name` FROM `tb_test`";
                            $resultTests = $conn->query($sqlTests);
                            if ($resultTests->num_rows > 0) {
                                while ($rowTest = $resultTests->fetch_assoc()) {
                                    $testName = $rowTest['name'];
                            ?>
                                    <option value="<?php echo $testName; ?>"><?php echo $testName; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            Please select a availabel Test.
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="validationCustom03" class="form-label colorBlack">Date</label>
                        <input type="date" class="form-control" name="date" id="validationCustom05" required>
                        <div class="invalid-feedback">
                            Please select a Date.
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="validationCustom03" class="form-label colorBlack">Time</label>
                        <select class="form-select" name="time" id="validationCustom06" required>
                            <option selected disabled value="">Select Time</option>
                            <!-- Loop through hours from 8 AM (08:00) to 4 PM (16:00) -->
                            <?php
                            for ($hour = 8; $hour <= 16; $hour++) {
                            ?>
                                <option value="<?php echo str_pad($hour, 2, "0", STR_PAD_LEFT) . ':00'; ?>"><?php echo str_pad($hour, 2, "0", STR_PAD_LEFT) . ':00'; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            Please select a Time.
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label colorBlack">NIC number</label>
                        <input type="text" class="form-control formInput" id="validationCustom07" name="NIC" required>
                        <div class="invalid-feedback">
                            Please enter your NIC number.
                        </div>
                    </div>



                    <div class="d-grid gap-2 mb-3 mt-5 col-5 mx-auto mb-5">

                        <button type="submit" name="submit" class="btn btn-primary btn-lg" name="submit">Book Appointment</button>


                    </div>

                    <!-- <p class="text-center mb-5">Already have an account? </p> -->

                </form>
            </div>
        </div>
    </div><!-- end of .container-->
</section>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the date input field
        var dateInput = document.getElementById('validationCustom05');

        // Add change event listener to the date input field
        dateInput.addEventListener('change', function() {
            var selectedDate = new Date(this.value); // Get the selected date
            var day = selectedDate.getDay(); // Get the day of the week (0 = Sunday, 1 = Monday, ..., 6 = Saturday)

            // If the selected date is a Sunday, clear the input value
            if (day === 0) {
                alert('We are closed on Sundays. Please select any other date.');
                this.value = ''; // Clear the input value
            }
        });
    });
</script>


<?php require "include/footer.php"; ?>