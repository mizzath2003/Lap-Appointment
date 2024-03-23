<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    die();
}
$pageName = "Report Add";
include_once("includes/header.php");
include_once('components/sidebar.php');
include_once("../dbh/dbdata.php");


$appointment_id = $conn->real_escape_string($_GET['appointment']);
?>



<h1 class="h1">Add Report</h1>
<div class="menuBox">
    <form action="dbh/reportAdd.php" class="row" method="post" enctype="multipart/form-data">

        <div class="form-content col-12">
            <label for="file">Upload File</label>
            <input type="file" name="file" id="file" accept=".txt,.pdf,.doc,.docx,.jpg,.jpeg,.png" style="height: 60px;" />
        </div>


        <button type="submit" class="btnSubmitMenu btn btn-warning" name="submit" value="<?= $appointment_id ?>">Add</button>
    </form>
</div>
<?php include_once("includes/footer.php"); ?>