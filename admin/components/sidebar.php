<!-- Hamburger icon for sidebar toggle -->
<div class="hamburger open" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</div>

<div class="sidebar open">
    <!-- <img src="images/fulllogo.png" width="160px" alt="Logo"> -->
    <p style="font-weight: 800; font-size: 32px;">Med Labs</p>
    <a href="./" class="<?= ($pageName == "Home") ? "active" : ""; ?>">Home</a>
    <a href="./users.php" class="<?= ($pageName == "Users") ? "active" : ""; ?>">Users</a>
    <a href="./patient.php" class="<?= ($pageName == "Patients") ? "active" : ""; ?>">Patient</a>

    <a href="./Test.php" class="<?= ($pageName == "Test") ? "active" : ""; ?>">Test</a>

    <a href="./appointment.php" class="<?= ($pageName == "Appointment") ? "active" : ""; ?>">Appointment</a>
    <a href="./reports.php" class="<?= ($pageName == "Report") ? "active" : ""; ?>">Report</a>

    
    <a href="../dbh/logout.php" style="margin-top:auto" class="bottom-align-div"><i class="fa-solid fa-power-off"></i> Logout</a>
</div>
<div class="mainSec open">