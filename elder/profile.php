<?php
include '../db.php';
include '../auth.php';

$user_id = $_SESSION['user_id'];

// Save profile FIRST (before any HTML output)
if (isset($_POST['save'])) {

    $name    = mysqli_real_escape_string($conn, $_POST['name']);
    $age     = mysqli_real_escape_string($conn, $_POST['age']);
    $gender  = mysqli_real_escape_string($conn, $_POST['gender']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $medical = mysqli_real_escape_string($conn, $_POST['medical']);

    $check2 = mysqli_query($conn, "SELECT id FROM elderly_profile WHERE user_id='$user_id'");

    if (mysqli_num_rows($check2) > 0) {
        mysqli_query($conn, "
            UPDATE elderly_profile SET
                name='$name',
                age='$age',
                gender='$gender',
                address='$address',
                medical_condition='$medical'
            WHERE user_id='$user_id'
        ");
    } else {
        mysqli_query($conn, "
            INSERT INTO elderly_profile
            (user_id, name, age, gender, address, medical_condition)
            VALUES
            ('$user_id', '$name', '$age', '$gender', '$address', '$medical')
        ");
    }

    header("Location: dashboard.php");
    exit();
}

// Fetch existing profile data
$result = mysqli_query($conn, "SELECT * FROM elderly_profile WHERE user_id='$user_id'");
$data   = mysqli_fetch_assoc($result);
?>

<?php include '../header.php'; ?>
<?php include '../navbar.php'; ?>

<div class="container">

    <div class="form-card">

        <h1 class="page-title">Elder Profile</h1>

        <form method="POST">

            <label>Name</label>
            <input type="text" name="name"
                value="<?php echo htmlspecialchars($data['name'] ?? ''); ?>" required>

            <label>Age</label>
            <input type="number" name="age"
                value="<?php echo htmlspecialchars($data['age'] ?? ''); ?>" required>

            <label>Gender</label>
            <select name="gender">
                <option value="Male"
                    <?php if (($data['gender'] ?? '') == 'Male') echo 'selected'; ?>>
                    Male
                </option>
                <option value="Female"
                    <?php if (($data['gender'] ?? '') == 'Female') echo 'selected'; ?>>
                    Female
                </option>
            </select>

            <label>Address</label>
            <textarea name="address"><?php echo htmlspecialchars($data['address'] ?? ''); ?></textarea>

            <label>Medical Condition</label>
            <textarea name="medical"><?php echo htmlspecialchars($data['medical_condition'] ?? ''); ?></textarea>

            <button class="btn" name="save">Save Profile</button>

        </form>

    </div>

</div>

<?php include '../footer.php'; ?>