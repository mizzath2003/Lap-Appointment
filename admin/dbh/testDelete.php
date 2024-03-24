<?php
// Start the session
session_start();

// Include database connection
require_once('../../dbh/dbdata.php');

// Define a class for deleting tests
class TestDeleter
{
    private $conn;

    // Constructor to initialize the database connection
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Method to delete a test record
    public function deleteTest($testId)
    {
        // Check if test ID is not empty
        if (!empty($testId)) {
            // Delete the test record from the database
            $sql = "DELETE FROM `tb_test` WHERE `ID`=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $testId);

            if ($stmt->execute()) {
                return "Test deleted successfully";
            } else {
                return "Could not delete test - " . $stmt->error;
            }
        } else {
            return "Invalid test ID";
        }
    }
}

// Create an instance of TestDeleter class
$testDeleter = new TestDeleter($conn);

// Handle form submission
if (isset($_POST['deleteTest'])) {
    $testId = $conn->real_escape_string($_POST['deleteTest']);

    // Delete test using the TestDeleter class
    $statusMessage = $testDeleter->deleteTest($testId);

    // Set session status message based on the result
    $_SESSION['status'] = $statusMessage;

    // Redirect back to test page
    header("Location: ../Test.php");
    exit(); // Terminate script execution
} else {
    // Redirect if delete button not clicked
    header("Location: ../Test.php");
    exit();
}
