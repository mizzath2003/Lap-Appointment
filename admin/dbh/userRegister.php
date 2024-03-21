<?php
// Start the session
session_start();
include('../../dbh/dbdata.php');

if (isset($_POST['btnSubmitMenu'])) {

    //initializing user inputs   //(real_escape_string)->  used to prevent SQL injection
    $fname = $conn->real_escape_string($_POST['fname']);
    $lname = $conn->real_escape_string($_POST['lname']);
    $username = $conn->real_escape_string(strtolower($_POST['username'])); //converting the username enetered to lowercase
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $status = $conn->real_escape_string($_POST['status']);
    $user_type = $conn->real_escape_string($_POST['userType']);
    //password encryption
    $hashedPassword = $conn->real_escape_string(sha1($_POST['password']));


    //Double checking if user inputs valid data (and not empty values)
    if ($fname != "" and $lname != "" and $username != "" and $email != "" and $phone != "" and $status != ""  and $user_type != "" and $_POST['password'] != "") {

        //Double checking if userName already exists in database
        $sql1 = "SELECT `username` FROM `tb_user` WHERE `username`='$username'";
        $results1 = mysqli_query($conn, $sql1);
        if ($results1->num_rows > 0) {
            $_SESSION['status'] = "Username already taken";
            header("Location:../userAdd.php");
        } else {

            //Inserting the new user record to database
            $sql2 = "INSERT INTO tb_user" . "(fname, lname, username, phone, email, password, status, user_type)" . "VALUES ('$fname', '$lname', '$username', '$phone', '$email', '$hashedPassword','$status','$user_type')";
            $results2 = mysqli_query($conn, $sql2);

            if (!$results2) {
                die('Could not Enter Data' . mysqli_error($conn));
            } else {
                // echo "Data entered successfully";
                $_SESSION['userName'] = $username;
                header("Location: ../users.php");
            }
        }
    } else {
        $_SESSION['status'] = "Field's cant be blank";
        header("Location: ../userAdd.php");
    }
}