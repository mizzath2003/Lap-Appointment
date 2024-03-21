<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    die();
}
$pageName = "Users";
include_once("includes/header.php");
include_once('components/sidebar.php');
?>
<div class="header-section">
    <h1 class="h1">Users</h1>
    <a href="userAdd.php"><button class="btn btn-warning">Add User</button></a>
</div>
<div class="tableDiv">
    <table class="tableSC">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>User Type</th>
            <th>Manage</th>
        </tr>
        <?php
        include_once("../dbh/dbdata.php");
        $i = 1;
        $sql = "SELECT * FROM `tb_user`";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td><?= $row['user_type'] ?></td>
                    <td>
                        <form action="dbh/userDelete.php" method="POST">

                            <button type="button" class="btn btn-info mr-1">
                                <a href="userEdit.php?user=<?= $row['userID'] ?>">Edit</a>
                            </button>

                            <button name="deleteUser" class="btn btn-error" type="submit" value="<?= $row['userID'] ?>" onclick="return confirm('All details and reservations relevant to this user will be deleted. Are you sure you want to delete this user? Once deleted you cannot undo');">Delete</button>
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