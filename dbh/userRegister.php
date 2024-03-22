<?php
session_start();

class UserRegistration
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function registerUser($name, $email, $phone, $password)
    {
        $name = $this->conn->real_escape_string($name);
        $email = $this->conn->real_escape_string($email);
        $phone = $this->conn->real_escape_string($phone);
        $hashedPassword = $this->conn->real_escape_string(sha1($password));

        if (!empty($name) && !empty($email) && !empty($phone) && !empty($password)) {
            $sql1 = "SELECT `email` FROM `tb_user` WHERE `email`='$email'";
            $results1 = $this->conn->query($sql1);

            if ($results1->num_rows > 0) {
                $_SESSION['error'] = "Email already taken";
                header("Location: ../signup.php");
            } else {
                $sql2 = "INSERT INTO tb_user (name, email, phone, password, status, user_type) VALUES ('$name', '$email', '$phone', '$hashedPassword', 'active', 'user')";
                $results2 = $this->conn->query($sql2);

                if (!$results2) {
                    die('Could not Enter Data' . $this->conn->error);
                } else {
                    $_SESSION['email'] = $email;
                    $_SESSION['success'] = "User registered successfully";
                    header("Location: ../index.php");
                }
            }
        } else {
            $_SESSION['error'] = "Fields cannot be blank";
            header("Location:../signup.php");
        }
    }
}

require('dbdata.php');

if (isset($_POST['submit'])) {
    $userRegistration = new UserRegistration($conn);
    $userRegistration->registerUser($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['password']);
}
