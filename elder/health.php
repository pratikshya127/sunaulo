<?php include '../header.php'; ?>
<?php include '../navbar.php'; ?>
<?php include '../db.php'; ?>
<?php include '../auth.php'; ?>

<?php
$user_id = $_SESSION['user_id'];

// SAVE HEALTH DATA
if (isset($_POST['save_health'])) {

    $blood_pressure = mysqli_real_escape_string($conn, $_POST['blood_pressure']);
    $sleep_hours = mysqli_real_escape_string($conn, $_POST['sleep_hours']);
    $water_intake = mysqli_real_escape_string($conn, $_POST['water_intake']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);

    // Check existing record
    $check = mysqli_query($conn,
        "SELECT * FROM health_records WHERE user_id='$user_id'"
    );

    if (mysqli_num_rows($check) > 0) {

        // UPDATE
        mysqli_query($conn,
            "UPDATE health_records SET
                blood_pressure='$blood_pressure',
                sleep_hours='$sleep_hours',
                water_intake='$water_intake',
                weight='$weight'
            WHERE user_id='$user_id'"
        );

    } else {

        // INSERT
        mysqli_query($conn,
            "INSERT INTO health_records
            (user_id, blood_pressure, sleep_hours, water_intake, weight)
            VALUES
            ('$user_id', '$blood_pressure', '$sleep_hours',
             '$water_intake', '$weight')"
        );
    }

    echo "<script>
        alert('Health Record Saved Successfully!');
        window.location='health.php';
    </script>";
}

// FETCH SAVED DATA
$health = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT * FROM health_records WHERE user_id='$user_id'"
));
?>

<div class="health-container">

    <div class="health-header">
        <h1>🩺 Health Records</h1>
        <p>Track and monitor your daily health information</p>
    </div>

    <form method="POST">

        <div class="health-grid">

            <!-- Blood Pressure -->
            <div class="health-card">
                <div class="card-icon">❤️</div>

                <div class="card-content">
                    <label>Blood Pressure</label>

                    <input
                        type="text"
                        name="blood_pressure"
                        placeholder="120/80 mmHg"
                        value="<?php echo $health['blood_pressure'] ?? ''; ?>"
                        required
                    >

                    <span class="status normal">
                        Normal Check
                    </span>
                </div>
            </div>

            <!-- Sleep Hours -->
            <div class="health-card">
                <div class="card-icon">😴</div>

                <div class="card-content">
                    <label>Sleep Hours</label>

                    <input
                        type="number"
                        name="sleep_hours"
                        placeholder="8 Hours"
                        value="<?php echo $health['sleep_hours'] ?? ''; ?>"
                        required
                    >

                    <span class="status good">
                        Healthy Sleep
                    </span>
                </div>
            </div>

            <!-- Water Intake -->
            <div class="health-card">
                <div class="card-icon">💧</div>

                <div class="card-content">
                    <label>Water Intake</label>

                    <input
                        type="text"
                        name="water_intake"
                        placeholder="2 Liters"
                        value="<?php echo $health['water_intake'] ?? ''; ?>"
                        required
                    >

                    <span class="status warning">
                        Stay Hydrated
                    </span>
                </div>
            </div>

            <!-- Weight -->
            <div class="health-card">
                <div class="card-icon">⚖️</div>

                <div class="card-content">
                    <label>Weight</label>

                    <input
                        type="text"
                        name="weight"
                        placeholder="65 kg"
                        value="<?php echo $health['weight'] ?? ''; ?>"
                        required
                    >

                    <span class="status good">
                        Keep Tracking
                    </span>
                </div>
            </div>

        </div>

        <div class="save-btn-area">
            <button type="submit" name="save_health">
                Save Health Record
            </button>
        </div>

    </form>

</div>

<?php include '../footer.php'; ?>