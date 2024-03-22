<!-- Hamburger icon for sidebar toggle -->
<div class="hamburger open" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</div>

<div class="sidebar open">
    <!-- <img src="images/fulllogo.png" width="160px" alt="Logo"> -->
    <p style="font-weight: 800; font-size: 32px;">Med Labs</p>
    <a href="./" class="<?= ($pageName == "Home") ? "active" : ""; ?>">Home</a>
    <a href="./appointment.php" class="<?= ($pageName == "Appointment") ? "active" : ""; ?>">Appointment</a>
    <a href="./Test.php" class="<?= ($pageName == "Test") ? "active" : ""; ?>">Test</a>
    <a href="./users.php" class="<?= ($pageName == "Users") ? "active" : ""; ?>">Users</a>
    <!-- <button class="collapsible">Users</button>
    <div class=" content">
        <a href="#">Register</a>
        <a href="#">Update</a>
    </div>
    <button class="collapsible">Menu</button>
    <div class="content">
        <a href="menu.php">View</a>
        <a href="../menuAdd.php">Update</a>
    </div>
    <button class="collapsible">Reservation</button>
    <div class="content">
        <a href="">View</a>
        <a href="#">Update</a>
    </div> -->
    <a href="../dbh/logout.php" style="margin-top:auto" class="bottom-align-div"><i class="fa-solid fa-power-off"></i> Logout</a>
</div>
<div class="mainSec open">