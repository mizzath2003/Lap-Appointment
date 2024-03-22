<?php
// Start the session
session_start();
include('../../dbh/dbdata.php');

if (isset($_POST['submit'])) {

    //initializing user inputs   //(real_escape_string)->  used to prevent SQL injection
    $name = $conn->real_escape_string($_POST['name']);
    $price = $conn->real_escape_string($_POST['price']);
    $description = $conn->real_escape_string($_POST['description']);

    //Double checking if user inputs valid data (and not empty values)
    if ($name != "" and $price != "" and $description != "") {

        //Double checking if test name already exists in the database
        $sql1 = "INSERT INTO `tb_test`(`name`, `description`, `price`) VALUES ('$name','$description','$price')";

        $results1 = mysqli_query($conn, $sql1);

        if (!$results1) {
            die('Could not Enter Data' . mysqli_error($conn));
        } else {
            $_SESSION['status'] = "Test added successfully";
            header("Location: ../Test.php");
        }
    } else {
        $_SESSION['status'] = "Fields can't be blank";
        header("Location: ../testAdd.php");
    }
}
