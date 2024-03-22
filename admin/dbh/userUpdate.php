<?php
// Start the session
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    die();
}
include('../../dbh/dbdata.php');

if (isset($_POST['submit'])) {

    //initializing user inputs   //(real_escape_string)->  used to prevent SQL injection
    $fname = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $status = $conn->real_escape_string($_POST['status']);
    $userType = $conn->real_escape_string($_POST['userType']);
    $userID = $conn->real_escape_string($_POST['submit']);

    //Double checking if user inputs valid data (and not empty values)
    if ($fname != "" && $email != "" && $phone != "" && $status != "" && $userType != "") {

        //Updating the user record in the database
        $sql = "UPDATE `tb_user` SET `name`='$fname', `email`='$email', `phone`='$phone', `status`='$status', `user_type`='$userType' WHERE `userID`='$userID'";
        $results = mysqli_query($conn, $sql);

        if (!$results) {
            $_SESSION['status'] = 'Could not update user' . mysqli_error($con);
            header("Location: ../users.php");
        } else {
            $_SESSION['status'] = "User updated successfully";
            header("Location: ../users.php");
        }
    } else {
        $_SESSION['status'] = "Fields cannot be empty";
        header("Location: ../userEdit.php?user=$userID");
    }
}
