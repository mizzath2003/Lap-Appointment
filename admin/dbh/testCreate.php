<?php
// Start the session
session_start();

// Include database connection
require_once('../../dbh/dbdata.php');

// Define a class for adding tests
class TestAdder
{
    private $conn;

    // Constructor to initialize the database connection
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Method to add a new test
    public function addTest($name, $price, $description)
    {
        // Check if any field is empty
        if (empty($name) || empty($price) || empty($description)) {
            return "Fields can't be blank";
        }

        // Insert the test into the database
        $sql = "INSERT INTO `tb_test` (`name`, `description`, `price`) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssd", $name, $description, $price);

        if ($stmt->execute()) {
            return "Test added successfully";
        } else {
            return "Could not add test: " . $stmt->error;
        }
    }
}

// Create an instance of TestAdder class
$testAdder = new TestAdder($conn);

// Handle form submission
if (isset($_POST['submit'])) {
    // Sanitize user inputs to prevent SQL injection
    $name = $conn->real_escape_string($_POST['name']);
    $price = $conn->real_escape_string($_POST['price']);
    $description = $conn->real_escape_string($_POST['description']);

    // Add test using the TestAdder class
    $statusMessage = $testAdder->addTest($name, $price, $description);

    // Set session status message based on the result
    $_SESSION['status'] = $statusMessage;

    // Redirect to appropriate page
    if ($statusMessage === "Test added successfully") {
        header("Location: ../Test.php");
    } else {
        header("Location: ../testAdd.php");
    }
    exit(); // Terminate script execution
}
