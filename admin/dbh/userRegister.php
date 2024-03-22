<?php
// Start the session
session_start();


// Database connection
include('../../dbh/dbdata.php');

if (isset($_POST['submit'])) {
    // Sanitize user inputs to prevent SQL injection
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $status = $conn->real_escape_string($_POST['status']);
    $userType = $conn->real_escape_string($_POST['userType']);

    // Check if any field is empty
    if ($name != "" && $email != "" && $password != "") {

        // Check if email already exists
        $sqlCheckEmail = "SELECT * FROM `tb_user` WHERE `email`='$email'";
        $resultCheckEmail = mysqli_query($conn, $sqlCheckEmail);
        if (mysqli_num_rows($resultCheckEmail) > 0) {
            $_SESSION['status'] = "Email already taken";
            header("Location: ../userAdd.php");
            exit();
        }

        // Hash the password
        $hashedPassword = sha1($password);

        // Insert the user into the database
        $sqlAddUser = "INSERT INTO `tb_user` (`name`, `email`, `password`, `phone`, `status`, `user_type`) VALUES ('$name', '$email', '$hashedPassword', '$phone', '$status', '$userType')";
        $resultAddUser = mysqli_query($conn, $sqlAddUser);

        if (!$resultAddUser) {
            $_SESSION['status'] = "Error adding user: " . mysqli_error($conn);
            header("Location: ../userAdd.php");
            exit();
        } else {
            $_SESSION['status'] = "User added successfully";
            header("Location: ../users.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "Fields can't be blank";
        header("Location: ../userAdd.php");
        exit();
    }
}
