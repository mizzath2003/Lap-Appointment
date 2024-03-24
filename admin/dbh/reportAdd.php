<?php
session_start();

// Check if admin session is not set
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    die();
}

// Include database connection
include('../../dbh/dbdata.php');

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Get appointment ID from form submission
    $appointment_id = $conn->real_escape_string($_POST['submit']);

    // Check if file is uploaded without errors
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // File upload directory
        $uploadDir = "uploads/";

        // Get file details
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];

        // Accepted file types
        $allowedTypes = array('text/plain', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png');

        // Check if file type is valid
        if (in_array($fileType, $allowedTypes)) {
            // Generate unique file name to avoid overwriting
            $uniqueFileName = uniqid() . '_' . $fileName;

            // Move uploaded file to destination directory
            if (move_uploaded_file($fileTmpName, $uploadDir . $uniqueFileName)) {
                // Add upload directory to the filename
                $fileFullPath = $uploadDir . $uniqueFileName;

                // Update appointment record with file details
                $sql = "UPDATE tb_appointment SET Report = '$fileFullPath' WHERE ID = '$appointment_id'";
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['status'] = "Report added successfully";
                    header("Location: ../reports.php");
                    exit();
                } else {
                    $_SESSION['status'] = "Error updating appointment record: " . $conn->error;
                }
            } else {
                $_SESSION['status'] = "Error uploading file";
            }
        } else {
            $_SESSION['status'] = "Invalid file type. Allowed types: .txt, .pdf, .doc, .docx, .jpg, .jpeg, .png";
        }
    } else {
        $_SESSION['status'] = "File upload failed";
    }

    // Redirect back to the add report page
    header("Location: ../addReport.php?appointment=$appointment_id");
    exit();
} else {
    // Redirect to add report page if form is not submitted
    header("Location: ../addReport.php?appointment=$appointment_id");
    exit();
}
