<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    die();
}
$pageName = "Report";
include_once("includes/header.php");
include_once('components/sidebar.php');
?>
<div class="searchAlign">
    <h1 class="h1">Report</h1>
    <input class="searchBar" type="text" id="myInput" placeholder="Search...">
</div>
<div class="tableDiv">
    <table class="tableSC">
        <tr>
            <th>No</th>
            <th>Appointment ID</th>
            <th>Test Name</th>
            <th>User ID</th>
            <th>User Name</th>
            <th>Report</th>
            <th>Manage</th>
        </tr>

        <?php
        include_once("../dbh/dbdata.php");
        $i = 1;
        $sql = "SELECT A.*, U.name AS user_name
                FROM `tb_appointment` A
                LEFT JOIN `tb_user` U ON A.userID = U.userID
                WHERE A.`Report` IS NOT NULL";
        $results = mysqli_query($conn, $sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
        ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $row['ID'] ?></td>
                    <td><?= $row['test'] ?></td>
                    <td><?= $row['userID'] ?></td>
                    <td><?= $row['user_name'] ?></td>
                    <td>
                        <button type="button" class="btn btn-info" onclick="window.open('../admin/dbh/<?= $row['Report'] ?>', '_blank')">View Report</button>
                    </td>
                    <td>
                        <form action="dbh/reportDelete.php" method="POST">
                            <button name="deleteReport" class="btn btn-error" type="submit" value="<?= $row['ID'] ?>" onclick="return confirm('Are you sure you want to delete this Report? Once deleted you cannot undo');">Delete</button>
                        </form>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='7'>No reports found</td></tr>";
        }
        ?>

    </table>
</div>

<?php
include_once("includes/footer.php");
?>