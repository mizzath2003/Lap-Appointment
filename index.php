<?php
session_start();
define("PAGE_TITLE", "Home");
require "dbh/dbdata.php";
require "include/header.php";
require "components/navbar.php";
require "components/testCard.php";

?>


<section class="hero-wrap js-fullheight" style="background-image: url('images/bg_3.jpg');" data-section="home" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
            <div class="col-md-6 pt-5 ftco-animate">
                <div class="mt-5">
                    <span class="subheading">Welcome to Med Labs Services</span>
                    <h1 class="mb-4">We are here <br>for your Care</h1>
                    <p class="mb-4">
                        In our lab , we're dedicated to providing accurate diagnostics and analysis, ensuring your health needs are met with precision and care.</p>
                    <p><a href="bookAppointment.php" class="btn btn-primary py-3 px-4">Make an appointment</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-counter img ftco-section ftco-no-pt ftco-no-pb" id="about-section">
    <div class="container">
        <div class="row d-flex">
            <div class="col-md-6 col-lg-5 d-flex">
                <div class="img d-flex align-self-stretch align-items-center" style="background-image:url(images/Clinics-hero.svg);background-size: contain;">
                </div>
            </div>
            <div class="col-md-6 col-lg-7 pl-lg-5 py-md-5">
                <div class="py-md-5">
                    <div class="row justify-content-start pb-3">
                        <div class="col-md-12 heading-section ftco-animate p-4 p-lg-5">
                            <h2 class="mb-4">We Are <span>Med Labs</span> A Cutting-Edge Medical Lab</h2>
                            <p>
                                Welcome to Med Labs, your trusted partner for accurate diagnostics. With advanced technology and expert staff, we deliver precise results swiftly. Your health is our priority.</p>
                            <p><a href="bookAppointment.php" class="btn btn-primary py-3 px-4">Make an appointment</a> <a href="contact.php" class="btn btn-secondary py-3 px-4">Contact us</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="ftco-intro img" style="background-image: url(images/bg_2.jpg);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 text-center">
                <h2>Your Health is Our Priority</h2>
                <p>At Med Labs, we're dedicated to providing top-notch medical testing services.</p>
            </div>
        </div>
    </div>
</section>

<!-- Tests -->
<section class="ftco-section ftco-no-pt ftco-no-pb" id="department-section">
    <div class="container-fluid px-0">
        <div class="row no-gutters">
            <div class="col-md-4 d-flex">
                <div class="img img-dept align-self-stretch" style="background-image: url(images/dept-1.jpg);"></div>
            </div>

            <div class="col-md-8">
                <div class="row no-gutters">

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
        </div>
    </div>
</section>

<!-- <section class="ftco-section" id="doctor-section">
    <div class="container-fluid px-5">
        <div class="row justify-content-center mb-5 pb-2">
            <div class="col-md-8 text-center heading-section ftco-animate">
                <h2 class="mb-4">Our Qualified Doctors</h2>
                <p>Separated they live in. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="staff">
                    <div class="img-wrap d-flex align-items-stretch">
                        <div class="img align-self-stretch" style="background-image: url(images/doc-1.jpg);"></div>
                    </div>
                    <div class="text pt-3 text-center">
                        <h3 class="mb-2">Dr. Lloyd Wilson</h3>
                        <span class="position mb-2">Neurologist</span>
                        <div class="faded">
                            <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p>
                            <ul class="ftco-social text-center">
                                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                            </ul>
                            <p><a href="#" class="btn btn-primary">Book now</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="staff">
                    <div class="img-wrap d-flex align-items-stretch">
                        <div class="img align-self-stretch" style="background-image: url(images/doc-2.jpg);"></div>
                    </div>
                    <div class="text pt-3 text-center">
                        <h3 class="mb-2">Dr. Rachel Parker</h3>
                        <span class="position mb-2">Ophthalmologist</span>
                        <div class="faded">
                            <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p>
                            <ul class="ftco-social text-center">
                                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                            </ul>
                            <p><a href="#" class="btn btn-primary">Book now</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="staff">
                    <div class="img-wrap d-flex align-items-stretch">
                        <div class="img align-self-stretch" style="background-image: url(images/doc-3.jpg);"></div>
                    </div>
                    <div class="text pt-3 text-center">
                        <h3 class="mb-2">Dr. Ian Smith</h3>
                        <span class="position mb-2">Dentist</span>
                        <div class="faded">
                            <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p>

                            <p><a href="#" class="btn btn-primary">Book now</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="staff">
                    <div class="img-wrap d-flex align-items-stretch">
                        <div class="img align-self-stretch" style="background-image: url(images/doc-4.jpg);"></div>
                    </div>
                    <div class="text pt-3 text-center">
                        <h3 class="mb-2">Dr. Alicia Henderson</h3>
                        <span class="position mb-2">Pediatrician</span>
                        <div class="faded">
                            <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p>
                            <p><a href="#" class="btn btn-primary">Book now</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="ftco-facts img ftco-counter" style="background-image: url(images/bg_3.jpg);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-md-5 heading-section heading-section-white">
                <span class="subheading">Fun facts</span>
                <h2 class="mb-4">Over 5,100 patients trust us</h2>
                <p class="mb-0"><a href="bookAppointment.php" class="btn btn-secondary px-4 py-3">Make an appointment</a></p>
            </div>
            <div class="col-md-7">
                <div class="row pt-4">
                    <div class="col-md-6 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18">
                            <div class="text">
                                <strong class="number" data-number="15">0</strong>
                                <span>Years of Experienced</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18">
                            <div class="text">
                                <strong class="number" data-number="4500">0</strong>
                                <span>Happy Patients</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18">
                            <div class="text">
                                <strong class="number" data-number="20">0</strong>
                                <span>Number of Doctors</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18">
                            <div class="text">
                                <strong class="number" data-number="100">0</strong>
                                <span>Number of Staffs</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require "include/footer.php"; ?>