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

// Define a class for user management
class UserUpdater
{
    private $conn;

    // Constructor to initialize the database connection
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Method to update user details
    public function updateUser($userID, $name, $email, $phone, $status, $userType)
    {
        // Check if any field is empty
        if (empty($name) || empty($email) || empty($phone) || empty($status) || empty($userType)) {
            return "Fields cannot be empty";
        }

        // Update the user record in the database
        $sql = "UPDATE `tb_user` SET `name`=?, `email`=?, `phone`=?, `status`=?, `user_type`=? WHERE `userID`=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssi", $name, $email, $phone, $status, $userType, $userID);

        if ($stmt->execute()) {
            return "User updated successfully";
        } else {
            return "Could not update user: " . $stmt->error;
        }
    }
}

// Create an instance of UserUpdater class
$userUpdater = new UserUpdater($conn);

// Handle form submission
if (isset($_POST['submit'])) {
    $userID = $conn->real_escape_string($_POST['submit']);
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $status = $conn->real_escape_string($_POST['status']);
    $userType = $conn->real_escape_string($_POST['userType']);

    // Update user using the UserUpdater class
    $statusMessage = $userUpdater->updateUser($userID, $name, $email, $phone, $status, $userType);

    // Set session status message based on the result
    $_SESSION['status'] = $statusMessage;

    // Determine redirect link based on the result
    if (strpos($statusMessage, "successfully") !== false) {
        header("Location: ../users.php");
    } else {
        header("Location: ../userEdit.php?user=$userID");
    }
    exit(); // Terminate script execution
}
