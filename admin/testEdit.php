<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    die();
}
$pageName = "Edit Test";
include_once("includes/header.php");
include_once('components/sidebar.php');

include_once("../dbh/dbdata.php");


$test_id = $conn->real_escape_string($_GET['test']);
$sql1 = "SELECT * FROM `tb_test` WHERE `ID`='$test_id'";
$results1 = mysqli_query($conn, $sql1);
if ($results1->num_rows > 0) {
    while ($row = $results1->fetch_assoc()) {
        $name = $row['name'];
        $price = $row['price'];
        $description = $row['description'];
    }
}
?>
<h1 class="h1">Edit Test</h1>
<div class="menuBox">
    <form action="dbh/testUpdate.php" class="row" method="post">
        <div class="form-content col-6">
            <label for="tital">Test Title</label>
            <input type="text" placeholder="Enter Menu Tital" name="name" value="<?= $name ?>">
        </div>
        <div class="form-content col-6">
            <label for="tital">Test Price</label>
            <input type="number" placeholder="Enter menu price" name="price" value="<?= $price ?>">
        </div>
        <div class="form-content col-12">
            <label for="tital">Test Description</label>
            <!-- <input type="text" placeholder="Enter menu description"> -->
            <textarea placeholder="Enter description" id="" rows="5" name="description"><?= $description ?></textarea>
        </div>
        <button type="submit" class="btnSubmitMenu btn btn-warning" name="btnSubmitTest" value="<?= $test_id ?>">Submit</button>
    </form>
</div>
<?php include_once("includes/footer.php"); ?>