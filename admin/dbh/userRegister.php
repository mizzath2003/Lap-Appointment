<?php
// Start the session
session_start();

// Include database connection
require_once('../../dbh/dbdata.php');

// Define a class for user management
class UserManager
{
    private $conn;

    // Constructor to initialize the database connection
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Method to add a new user
    public function addUser($name, $email, $password, $phone, $status, $userType)
    {
        // Check if any field is empty
        if (empty($name) || empty($email) || empty($password)) {
            return "Fields can't be blank";
        }

        // Check if email already exists
        $sqlCheckEmail = "SELECT * FROM `tb_user` WHERE `email`=?";
        $stmtCheckEmail = $this->conn->prepare($sqlCheckEmail);
        $stmtCheckEmail->bind_param("s", $email);
        $stmtCheckEmail->execute();
        $resultCheckEmail = $stmtCheckEmail->get_result();

        if ($resultCheckEmail->num_rows > 0) {
            return "Email already taken";
        }

        // Hash the password
        $hashedPassword = sha1($password);

        // Insert the user into the database
        $sqlAddUser = "INSERT INTO `tb_user` (`name`, `email`, `password`, `phone`, `status`, `user_type`) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtAddUser = $this->conn->prepare($sqlAddUser);
        $stmtAddUser->bind_param("ssssss", $name, $email, $hashedPassword, $phone, $status, $userType);

        if ($stmtAddUser->execute()) {
            return "User added successfully";
        } else {
            return "Error adding user: " . $stmtAddUser->error;
        }
    }
}

// Create an instance of UserManager class
$userManager = new UserManager($conn);

// Handle form submission
if (isset($_POST['submit'])) {
    // Sanitize user inputs to prevent SQL injection
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $status = $conn->real_escape_string($_POST['status']);
    $userType = $conn->real_escape_string($_POST['userType']);

    // Add user using the UserManager class
    $statusMessage = $userManager->addUser($name, $email, $password, $phone, $status, $userType);

    // Set session status message based on the result
    $_SESSION['status'] = $statusMessage;

    // Redirect to appropriate page
    header("Location: ../users.php");
    exit();
}
