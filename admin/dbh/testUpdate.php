<?php
// Start the session
session_start();

// Include database connection
require_once('../../dbh/dbdata.php');

// Define a class for updating tests
class TestUpdater
{
    private $conn;

    // Constructor to initialize the database connection
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Method to update test details
    public function updateTest($testId, $name, $price, $description)
    {
        // Check if any field is empty
        if (empty($name) || empty($price) || empty($description)) {
            return "Fields can't be blank";
        }

        // Update test details in the database
        $sql = "UPDATE `tb_test` SET `name`=?, `description`=?, `price`=? WHERE `ID`=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssdi", $name, $description, $price, $testId);

        if ($stmt->execute()) {
            return "Test updated successfully";
        } else {
            return "Error updating test: " . $stmt->error;
        }
    }
}

// Create an instance of TestUpdater class
$testUpdater = new TestUpdater($conn);

// Handle form submission
if (isset($_POST['btnSubmitTest'])) {
    // Get test ID from the form
    $testId = $conn->real_escape_string($_POST['btnSubmitTest']);

    // Initialize and sanitize user inputs
    $name = $conn->real_escape_string($_POST['name']);
    $price = $conn->real_escape_string($_POST['price']);
    $description = $conn->real_escape_string($_POST['description']);

    // Update test using the TestUpdater class
    $statusMessage = $testUpdater->updateTest($testId, $name, $price, $description);

    // Set session status message based on the result
    $_SESSION['status'] = $statusMessage;

    // Redirect to appropriate page
    if ($statusMessage === "Test updated successfully") {
        header("Location: ../Test.php");
    } else {
        header("Location: ../testEdit.php?test=$testId");
    }
    exit(); // Terminate script execution
} else {
    // Redirect if update button not clicked
    header("Location: ../Test.php");
    exit();
}
?>
