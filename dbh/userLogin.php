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
            $_SESSION['email'] = $email;
            header("Location: ../index.php");
        } else {
            $_SESSION['status'] = "Incorrect email or password";
            header("Location: ../login.php");
        }
    } else {
        $_SESSION['status'] = "Enter login detail to continue";
        header("Location: ../login.php");
    }
}
