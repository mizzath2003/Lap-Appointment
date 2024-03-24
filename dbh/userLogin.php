<?php
session_start();
require('dbdata.php');

class UserAuthentication
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function loginUser($email, $password)
    {
        $email = $this->conn->real_escape_string($email);
        $hashedPassword = $this->conn->real_escape_string(sha1($password));

        if ($email != "" && $password != "") {
            $sql = "SELECT `email`, `user_type` FROM `tb_user` WHERE `email`='$email' AND `password`='$hashedPassword'";
            $result = $this->conn->query($sql);

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
}

// Usage:
$userAuth = new UserAuthentication($conn);
if (isset($_POST['submit'])) {
    $userAuth->loginUser($_POST['email'], $_POST['password']);
}
