<?php
// Start the session
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    die();
}
include('../../dbh/dbdata.php');

if (isset($_POST['deleteTest'])) {

    $test_id = $conn->real_escape_string($_POST['deleteTest']);

    //Double checking if user inputs valid data (and not empty values)
    if ($test_id != "") {

        //Deleting the test record from the database
        $sql = "DELETE FROM `tb_test` WHERE `ID`='$test_id';";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            $_SESSION['status'] = 'Could not delete test - ' . mysqli_error($conn);
            header("Location: ../Test.php");
            exit();
        } else {
            $_SESSION['status'] = "Test deleted successfully";
            header("Location: ../Test.php");
            exit();
        }
    }
}
