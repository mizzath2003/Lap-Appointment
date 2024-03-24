<?php

session_start();

// Check if admin session is not set
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    die();
}

// Include database connection
require_once '../../dbh/dbdata.php';

class ReportHandler
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addReport($appointmentId, $file)
    {
        // Check if file is uploaded without errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['status'] = "File upload failed";
            return;
        }

        // File upload directory
        $uploadDir = "uploads/";

        // Get file details
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileType = $file['type'];

        // Accepted file types
        $allowedTypes = array('text/plain', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png');

        // Check if file type is valid
        if (!in_array($fileType, $allowedTypes)) {
            $_SESSION['status'] = "Invalid file type. Allowed types: .txt, .pdf, .doc, .docx, .jpg, .jpeg, .png";
            return;
        }

        // Generate unique file name to avoid overwriting
        $uniqueFileName = uniqid() . '_' . $fileName;

        // Move uploaded file to destination directory
        if (!move_uploaded_file($fileTmpName, $uploadDir . $uniqueFileName)) {
            $_SESSION['status'] = "Error uploading file";
            return;
        }

        // Add upload directory to the filename
        $fileFullPath = $uploadDir . $uniqueFileName;

        // Update appointment record with file details
        $sql = "UPDATE tb_appointment SET Report = ? WHERE ID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $fileFullPath, $appointmentId);

        if ($stmt->execute()) {
            $_SESSION['status'] = "Report added successfully";
            header("Location: ../reports.php");
            exit();
        } else {
            $_SESSION['status'] = "Error updating appointment record: " . $stmt->error;
        }
    }
}

// Instantiate the ReportHandler class
$reportHandler = new ReportHandler($conn);

if (isset($_POST['submit'])) {
    // Get appointment ID from form submission
    $appointmentId = $conn->real_escape_string($_POST['submit']);

    // Call the addReport method with appointment ID and file data
    $reportHandler->addReport($appointmentId, $_FILES['file']);
} else {
    // Redirect to add report page if form is not submitted
    header("Location: ../addReport.php?appointment=$appointment_id");
    exit();
}
