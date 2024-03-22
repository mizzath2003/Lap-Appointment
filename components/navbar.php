<!-- TOP BAR -->
<div class="py-1 bg-black top">
    <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
            <div class="col-lg-12 d-block">
                <div class="row d-flex">
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                        <span class="text">+1234 5678 90</span>
                    </div>
                    <div class="col-md pr-4 d-flex topper align-items-center ">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                        <span class="text">info@medlabs.com</span>
                    </div>
                    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right justify-content-end">

                        <?php
                        if (!isset($_SESSION['email'])) {
                        ?>
                            <p class="mb-0 register-link"><a href="signup.php" class="mr-3">Sign Up</a><a href="login.php">Sign In</a></p>

                        <?php
                        }
                        ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- NAV BAR -->
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php">Med Labs</a>
        <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav nav ml-auto">
                <li class="nav-item"><a href="index.php" class="nav-link"><span>Home</span></a></li>
                <li class="nav-item"><a href="test.php" class="nav-link"><span>Lab Services</span></a></li>

                <?php
                if (isset($_SESSION['email'])) {
                ?>
                    <li class="nav-item"><a href="appointment.php" class="nav-link"><span>Appointments</span></a></li>
                    <li class="nav-item"><a href="report.php" class="nav-link"><span>Reports</span></a></li>
                <?php
                }
                ?>

                <li class="nav-item"><a href="contact.php" class="nav-link"><span>Contact</span></a></li>

                <?php
                if (isset($_SESSION['email'])) {
                ?>
                    <li class="nav-item cta mr-md-2"><a href="dbh/logout.php" class="nav-link">Logout</a>
                    </li>
                <?php
                }
                ?>

                <li class="nav-item cta mr-md-2"><a href="bookAppointment.php" class="nav-link">Book Appointment</a></li>
            </ul>
        </div>
    </div>
</nav>