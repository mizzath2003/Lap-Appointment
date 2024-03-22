<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    die();
}
$pageName = "Appointment";
include_once("includes/header.php");
include_once('components/sidebar.php');
?>
<!-- Search Bar -->
<div class="searchAlign">
    <h1 class="h1">Appointment</h1>
    <input class="searchBar" type="text" id="myInput" placeholder="Search...">
</div>
<div class="tableDiv">
    <table class="tableSC">
        <tr class="table-head">
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Test</th>
            <th>Date</th>
            <th>Time</th>
            <th>NIC</th>
            <!-- <th>Status</th> -->
        </tr>

        <?php
        include_once("../dbh/dbdata.php");
        $i = 1;
        $sql = "SELECT * FROM `tb_appointment`";
        $results = mysqli_query($conn, $sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
        ?>

                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td><?= $row['test'] ?></td>
                    <td><?= $row['date'] ?></td>
                    <td><?= $row['time'] ?></td>
                    <td><?= $row['NIC'] ?></td>
                    <!-- <td><?= $row['Status'] ?></td> -->
                </tr>

        <?php
            }
        }
        ?>

    </table>
</div>


<?php include_once("includes/footer.php"); ?>