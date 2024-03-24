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
            <th>Report Status</th>
            <th>Add Report</th>
            <!-- <th>Status</th> -->
        </tr>

        <?php
        include_once("../dbh/dbdata.php");
        $i = 1;
        $sql = "SELECT * FROM `tb_appointment`";
        $results = mysqli_query($conn, $sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {

                // Determine if report is added or not
                $reportStatus = !empty($row['Report']) ? 'Added' : 'Not added';
                // Set color based on report status
                $color = !empty($row['Report']) ? '#2ab52a' : '#cf2c2c';
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
                    <td style="color: <?= $color ?>"><?= $reportStatus ?></td>
                    <td>
                        <form action="" method="POST">

                            <button type="button" class="btn btn-info mr-1">
                                <a href="addReport.php?appointment=<?= $row['ID'] ?>">Add Report</a>
                            </button>

                        </form>
                    </td>
                </tr>

        <?php
            }
        } else {
            echo "<tr><td colspan='7'>No Appointment found</td></tr>";
        }
        ?>

    </table>
</div>


<?php include_once("includes/footer.php"); ?>