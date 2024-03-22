<?php
session_start();
include('../../dbh/dbdata.php');

if (isset($_POST['btnSubmitTest'])) {
    // Get test ID from the form
    $test_id = $conn->real_escape_string($_POST['btnSubmitTest']);

    // Initialize and sanitize user inputs
    $name = $conn->real_escape_string($_POST['name']);
    $price = $conn->real_escape_string($_POST['price']);
    $description = $conn->real_escape_string($_POST['description']);

    // Double-check if user inputs valid data (and not empty values)
    if ($name != "" && $price != "" && $description != "") {

        // Update test details in the database
        $sql = "UPDATE `tb_test` SET `name`='$name', `description`='$description', `price`='$price' WHERE `ID`='$test_id'";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            // Handle update failure
            $_SESSION['status'] = "Error updating test: " . mysqli_error($conn);
            header("Location: ../testEdit.php?test=$test_id");
            exit();
        } else {
            // Test updated successfully
            $_SESSION['status'] = "Test updated successfully";
            header("Location: ../Test.php");
            exit();
        }
    } else {
        // Fields cannot be blank
        $_SESSION['status'] = "Fields can't be blank";
        header("Location: ../testEdit.php?test=$test_id");
        exit();
    }
} else {
    // Redirect if update button not clicked
    header("Location: ../Test.php");
    exit();
}
