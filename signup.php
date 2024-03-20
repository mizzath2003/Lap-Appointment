<?php
session_start();
define("PAGE_TITLE", "Sign Up");
require "include/header.php";
require "components/navbar.php";

?>

<style>
    .colorBlack {
        color: black;
        font-weight: 600;
    }
</style>

<!-- <section> begin ============================-->
<section id="signup">
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center mb-5 pb-2 mt-5">
            <div class="col-md-8 text-center heading-section ftco-animate">
                <h2 class="mb-4">Sign Up</h2>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="mx-auto">
                <form onsubmit="return verifyPasswords()" action="dbh/userRegister.php" method="POST" class="d-flex flex-column justify-content-center align-items-center row g-3 needs-validation " novalidate>
                    <div class="col-md-5 ">
                        <label for="validationCustom01" class="form-label colorBlack">Name</label>
                        <input type="text" class="form-control" id="validationCustom01" name="name" required>
                        <div class="invalid-feedback">
                            Please enter your name.
                        </div>
                    </div>
                    <div class="col-md-5 ">
                        <label for="validationCustom02" class="form-label colorBlack">Email</label>
                        <div class="input-group has-validation">
                            <input type="email" class="form-control" id="validationCustom02" name="email" aria-describedby="inputGroupPrepend" required>
                            <div class="invalid-feedback">
                                Please enter a valid email.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 ">
                        <label for="validationCustom03" class="form-label colorBlack">Mobile Number</label>
                        <input type="text" class="form-control" name="phone" id="validationCustom03" required>
                        <div class="invalid-feedback">
                            Please enter a valid mobile number.
                        </div>
                    </div>
                    <div class="col-md-5 ">
                        <label for="validationCustom04" class="form-label colorBlack">Password</label>
                        <input type="password" class="form-control" id="validationCustom04" name="password" required onkeyup="hideError()">
                        <div class="invalid-feedback">
                            Please enter a valid Password.
                        </div>
                    </div>



                    <div class="d-grid gap-2 mb-3 mt-5 col-5 mx-auto">
                        <button type="submit" class="btn btn-primary btn-lg" name="submit">Sign Up</button>
                    </div>

                    <p class="text-center">Already have an account? <a href="login.php">Login</a></p>
                    <div class="mt-2 alert alert-danger" role="alert" id="error" style="visibility:hidden">
                        Passwords do not match
                    </div>

                </form>
            </div>
        </div>
    </div><!-- end of .container-->
</section>

<?php require "include/footer.php"; ?>