<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location:login.php");
    die();
}

define("PAGE_TITLE", "Lab Service");
require "include/header.php";
require "components/navbar.php";
require "components/testCard.php";
?>


<?php require "include/footer.php"; ?>