<?php
session_start();

// Check if admin session is not set
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    die();
}

// Include database connection
include('../../dbh/dbdata.php');

// Define a class for managing report uploads
class ReportUploader
{
    private $conn;

    // Constructor to initialize the database connection
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Method to handle report upload
    public function uploadReport($appointmentId, $file)
    {
        // Check if file is uploaded without errors
        if ($file['error'] === UPLOAD_ERR_OK) {
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
            if (in_array($fileType, $allowedTypes)) {
                // Generate unique file name to avoid overwriting
                $uniqueFileName = uniqid() . '_' . $fileName;

                // Move uploaded file to destination directory
                if (move_uploaded_file($fileTmpName, $uploadDir . $uniqueFileName)) {
                    // Add upload directory to the filename
                    $fileFullPath = $uploadDir . $uniqueFileName;

                    // Update appointment record with file details
                    $sql = "UPDATE tb_appointment SET Report = ? WHERE ID = ?";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bind_param("si", $fileFullPath, $appointmentId);

                    if ($stmt->execute()) {
                        return "Report added successfully";
                    } else {
                        return "Error updating appointment record: " . $stmt->error;
                    }
                } else {
                    return "Error uploading file";
                }
            } else {
                return "Invalid file type. Allowed types: .txt, .pdf, .doc, .docx, .jpg, .jpeg, .png";
            }
        } else {
            return "File upload failed";
        }
    }
}

// Create an instance of ReportUploader class
$reportUploader = new ReportUploader($conn);

// Handle form submission
if (isset($_POST['submit'])) {
    $appointmentId = $conn->real_escape_string($_POST['submit']);

    // Upload report using the ReportUploader class
    $statusMessage = $reportUploader->uploadReport($appointmentId, $_FILES['file']);

    // Set session status message based on the result
    $_SESSION['status'] = $statusMessage;

    // Redirect back to the add report page
    header("Location: ../addReport.php?appointment=$appointmentId");
    exit();
} else {
    // Redirect to add report page if form is not submitted
    header("Location: ../addReport.php");
    exit();
}
