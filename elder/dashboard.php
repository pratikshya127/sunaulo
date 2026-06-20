<?php

include '../header.php';
include '../navbar.php';
include '../db.php';
include '../auth.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


// USER DETAILS
$user_query = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($user_query);


// PROFILE
$profile_query = mysqli_query($conn, "SELECT * FROM elderly_profile WHERE user_id='$user_id'");
$profile = mysqli_fetch_assoc($profile_query);


// LATEST MOOD
$mood_query = mysqli_query($conn, "
    SELECT * FROM mood_checkins
    WHERE elder_id='$user_id'
    ORDER BY id DESC
    LIMIT 1
");
$mood = mysqli_fetch_assoc($mood_query);


// SOS COUNT
$sos_query = mysqli_query($conn, "
    SELECT * FROM sos_alerts
    WHERE elder_id='$user_id'
    AND status='active'
");
$sos_count = mysqli_num_rows($sos_query);


// MEDICINE COUNT
$med_query = mysqli_query($conn, "
    SELECT * FROM medicine_schedule
    WHERE elder_id='$user_id'
");
$med_count = mysqli_num_rows($med_query);

?>

<div class="container">

    <!-- Welcome Card -->
    <div class="welcome-card">

        <h1>Welcome To Sunaulo!💚</h1>

        
    </div>


    <!-- Dashboard Cards -->
    <div class="card-grid">

        <div class="card">
            <h2>💊 Medicines</h2>
            <p>You have <?php echo $med_count; ?> medicines</p>
            <a href="medicines.php" class="btn">Open</a>
        </div>

        <div class="card">
            <h2>😊 Mood Tracker</h2>
            <p>Track emotional health</p>
            <a href="mood.php" class="btn">Open</a>
        </div>

        <div class="card">
            <h2>❤️ Health</h2>
            <p>Monitor your health stats</p>
            <a href="health.php" class="btn">Open</a>
        </div>

        <div class="card">
            <h2>🚨 Emergency</h2>
            <p>Active SOS: <?php echo $sos_count; ?></p>
            <a href="sos.php" class="btn">Open</a>
        </div>

    </div>


    <!-- User Info Card -->
    <div class="welcome-card">

    
    </div>

</div>

<?php include '../footer.php'; ?>