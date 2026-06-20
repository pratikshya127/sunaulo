<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Sunaulo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <div class="form-card">

        <h1 class="page-title">Register</h1>

        <form method="POST">

            <label>Full Name</label>
            <input type="text" name="full_name" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Role</label>
            <select name="role">
                <option value="elder">Elder</option>
                <option value="family">Family</option>
            </select>

            <label>Phone</label>
            <input type="text" name="phone">

            <button class="btn" name="register">Register</button>

        </form>

    </div>

</div>

</body>
</html>

<?php

if (isset($_POST['register'])) {

    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $phone = $_POST['phone'];

    // HASH PASSWORD
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (full_name, email, password, role, phone)
            VALUES ('$name', '$email', '$hashedPassword', '$role', '$phone')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Registered Successfully'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Error: Email already exists');</script>";
    }
}

?>