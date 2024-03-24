<?php
// Start the session
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit(); // Terminate script execution
}

// Include database connection
require_once('../../dbh/dbdata.php');

// Define a class for user deletion
class UserDeleter
{
    private $conn;

    // Constructor to initialize the database connection
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Method to delete a user
    public function deleteUser($userID)
    {
        // Check if user ID is valid (not empty)
        if (!empty($userID)) {
            // Delete the user record from the database
            $sql = "DELETE FROM `tb_user` WHERE `userID`=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $userID);
            if ($stmt->execute()) {
                return "User deleted successfully";
            } else {
                return "Could not delete user - " . $stmt->error;
            }
        } else {
            return "Invalid request";
        }
    }
}

// Create an instance of UserDeleter class
$userDeleter = new UserDeleter($conn);

// Handle form submission
if (isset($_POST['deleteUser'])) {
    $userID = $conn->real_escape_string($_POST['deleteUser']);

    // Delete user using the UserDeleter class
    $statusMessage = $userDeleter->deleteUser($userID);

    // Set session status message based on the result
    $_SESSION['status'] = $statusMessage;

    // Redirect back to users page
    header("Location: ../users.php");
    exit(); // Terminate script execution
} else {
    // Redirect back to users page if the user ID is empty or not set
    $_SESSION['status'] = "Invalid request";
    header("Location: ../users.php");
    exit(); // Terminate script execution
}
