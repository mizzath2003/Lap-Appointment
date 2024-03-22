<?php
// Start the session
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    die();
}
include('../../dbh/dbdata.php');

if (isset($_POST['deleteUser'])) {

    $userID = $conn->real_escape_string($_POST['deleteUser']);

    //Double checking if user input is valid (not empty)
    if ($userID != "") {

        //Deleting the user record from the database
        $sql = "DELETE FROM `tb_user` WHERE `userID`='$userID'";
        $result = mysqli_query($conn, $sql);

        // Check if the query was successful
        if (!$result) {
            $_SESSION['status'] = 'Could not delete user - ' . mysqli_error($conn);
            header("Location: ../users.php");
            exit();
        }


        $_SESSION['status'] = "User deleted successfully";
        header("Location: ../users.php");
        exit();
    }
}

// Redirect back to users page if the user ID is empty or not set
$_SESSION['status'] = "Invalid request";
header("Location: ../users.php");
