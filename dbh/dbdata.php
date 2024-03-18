<?php
//DATABASE CONNCTION
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "medlabs";

// Create connection
$con = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
