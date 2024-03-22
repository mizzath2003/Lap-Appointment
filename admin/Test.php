<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    die();
}
$pageName = "Test";
include_once("includes/header.php");
include_once('components/sidebar.php');
?>
<div class="header-section">
    <h1 class="h1">Test</h1>
    <a href="testAdd.php"><button class="btn btn-warning">Add Tests</button></a>
</div>
<div class="tableDiv">
    <table class="tableSC">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Manage</th>
        </tr>

        <?php
        include_once("../dbh/dbdata.php");
        $i = 1;
        $sql1 = "SELECT `ID`, `name`, `description`, `price` FROM `tb_test`";
        $results1 = mysqli_query($conn, $sql1);
        if ($results1->num_rows > 0) {
            while ($row = $results1->fetch_assoc()) {
        ?>

                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $row['name'] ?></td>
                    <td style="max-width:500px"><?= $row['description'] ?></td>
                    <td>LKR <?= $row['price'] ?></td>
                    <td>
                        <form action="dbh/testDelete.php" method="POST">

                            <button type="button" class="btn btn-info mr-1">
                                <a href="testEdit.php?test=<?= $row['ID'] ?>">Edit</a>
                            </button>

                            <button name="deleteTest" class="btn btn-error" type="submit" value="<?= $row['ID'] ?>" onclick="return confirm('Are you sure you want to delete this menu? Once deleted you cannot undo');">Delete</button>
                        </form>
                    </td>
                </tr>

        <?php
            }
        }
        ?>

    </table>
</div>

<?php
include_once("includes/footer.php");
?>