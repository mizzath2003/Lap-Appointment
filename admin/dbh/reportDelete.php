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

// Define a class for report management
class ReportManager
{
    private $conn;

    // Constructor to initialize the database connection
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Method to delete a report based on appointment ID
    public function deleteReport($appointmentId)
    {
        // Check if the appointment ID is not empty
        if ($appointmentId != "") {
            // Deleting the report column data of the specific appointment from the database
            $sql = "UPDATE `tb_appointment` SET `Report` = NULL WHERE `ID`=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $appointmentId);
            if ($stmt->execute()) {
                return "Report deleted successfully";
            } else {
                return "Could not delete report - " . $stmt->error;
            }
        } else {
            return "Invalid appointment ID";
        }
    }
}

// Create an instance of ReportManager class
$reportManager = new ReportManager($conn);

// Check if the deleteReport button is clicked
if (isset($_POST['deleteReport'])) {
    // Get the appointment ID to be deleted
    $appointment_id = $conn->real_escape_string($_POST['deleteReport']);

    // Delete report using the ReportManager class
    $statusMessage = $reportManager->deleteReport($appointment_id);

    // Set session status message based on the result
    $_SESSION['status'] = $statusMessage;

    // Redirect to reports page
    header("Location: ../reports.php");
    exit();
}

// If deleteReport button is not clicked, redirect to reports page
header("Location: ../reports.php");
exit();
