<?php
// Start the session
session_start();
require('dbdata.php');

if (isset($_POST['submit'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $hashedPassword = $conn->real_escape_string(sha1($_POST['password']));

    //Double checking if user inputs valid data (and not empty values)
    if ($email != "" && $_POST['password'] != "") {

        $sql = "SELECT `email`, `user_type` FROM `tb_user` WHERE `email`='$email' AND `password`='$hashedPassword'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['user_type'] == "admin") {
                    $_SESSION['admin'] = $email;
                    $_SESSION['status'] = "Welcome, Admin!";
                    header("Location: ../admin/"); // Redirect admin to admin page
                } else {
                    $_SESSION['email'] = $email;
                    $_SESSION['success'] = "Login successful!";
                    header("Location: ../index.php"); // Redirect normal user to index page
                }
            }
        } else {
            $_SESSION['error'] = "Incorrect email or password";
            header("Location: ../login.php");
        }
    } else {
        $_SESSION['error'] = "Enter login detail to continue";
        header("Location: ../login.php");
    }
}
