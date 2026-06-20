<?php include '../header.php'; ?>
<?php include '../navbar.php'; ?>
<?php include '../db.php'; ?>
<?php include '../auth.php'; ?>

<?php
$elder_id = $_SESSION['user_id'];

if (isset($_POST['send'])) {

    mysqli_query($conn,
        "INSERT INTO sos_alerts (elder_id,message)
        VALUES ('$elder_id','Help Needed')"
    );
}

$result = mysqli_query($conn,
    "SELECT * FROM sos_alerts WHERE elder_id='$elder_id' ORDER BY id DESC"
);
?>

<div class="container">

<div class="form-card">

<h1 class="page-title">SOS System</h1>

<form method="POST">
    <button class="btn" style="background:red;" name="send">
        SEND SOS
    </button>
</form>

<br>

<h3>SOS History</h3>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

    <div class="card">
        <h2><?php echo $row['message']; ?></h2>
        <p>Status: <?php echo $row['status']; ?></p>
        <small><?php echo $row['created_at']; ?></small>
    </div>

<?php } ?>

</div>

</div>

<?php include '../footer.php'; ?>