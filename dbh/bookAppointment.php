<?php
// Start the session
session_start();
require('dbdata.php');

if (isset($_POST['submit'])) {

    // Check if the user is logged in
    if (isset($_SESSION['email'])) {

        // Get user details from session
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM tb_user WHERE email = '$email'";
        $result = $conn->query($sql);

        // Check if user data is retrieved successfully
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userId = $row['ID']; // Get the user ID
        }
    } else {
        // Redirect to login page if user is not logged in
        header("Location: ../login.php");
        exit(); // Terminate script execution
    }

    // Get appointment details from form submission
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $test = $conn->real_escape_string($_POST['test']);
    $date = $conn->real_escape_string($_POST['date']);
    $time = $conn->real_escape_string($_POST['time']);
    $NIC = $conn->real_escape_string($_POST['NIC']);

    // Check if any of the required fields are empty
    if (empty($name) || empty($email) || empty($phone) || empty($test) || empty($date) || empty($time) || empty($NIC)) {
        $_SESSION['status'] = "All fields are required";
        header("Location: ../bookAppointment.php");
        exit(); // Terminate script execution
    }

    // Prepare SQL insert statement
    $sql = "INSERT INTO tb_appointment (name, email, phone, test, date, time, NIC, Status) 
            VALUES ('$name', '$email', '$phone', '$test', '$date', '$time', '$NIC', '1')";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        // Appointment added successfully
        $_SESSION['status'] = "Appointment booked successfully";
        header("Location: ../appointment.php"); // Redirect to appointment page or any other page
        exit(); // Terminate script execution
    } else {
        // Error occurred while adding appointment
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        header("Location: ../bookAppointment.php"); // Redirect to appointment page or any other page
        exit(); // Terminate script execution
    }
} else {
    // Redirect to appointment page if form is not submitted
    header("Location: ../bookAppointment.php");
    exit(); // Terminate script execution
}
