<?php
// Start the session
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    die();
}

// Include the database connection file
include('../../dbh/dbdata.php');

// Check if the deleteReport button is clicked
if (isset($_POST['deleteReport'])) {

    // Get the appointment ID to be deleted
    $appointment_id = $conn->real_escape_string($_POST['deleteReport']);

    // Double check if the appointment ID is not empty
    if ($appointment_id != "") {

        // Deleting the report column data of the specific appointment from the database
        $sql = "UPDATE `tb_appointment` SET `Report` = NULL WHERE `ID`='$appointment_id';";
        $result = mysqli_query($conn, $sql);

        // Check if the deletion was successful
        if (!$result) {
            $_SESSION['status'] = 'Could not delete report - ' . mysqli_error($conn);
        } else {
            $_SESSION['status'] = "Report deleted successfully";
            header("Location: ../reports.php");
            exit();
        }
    }
}
