<?php
include '../auth.php';
include '../db.php';

$elder_id = $_SESSION['user_id'];

// Add contact
if (isset($_POST['add_contact'])) {
    $contact_name = mysqli_real_escape_string($conn, $_POST['contact_name']);
    $contact_type = mysqli_real_escape_string($conn, $_POST['contact_type']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $address      = mysqli_real_escape_string($conn, $_POST['address']);

    $sql = "INSERT INTO medical_contacts (elder_id, contact_name, contact_type, phone_number, address)
            VALUES ('$elder_id', '$contact_name', '$contact_type', '$phone_number', '$address')";
    mysqli_query($conn, $sql);
    header("Location: contacts.php");
    exit();
}

// Delete contact
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    mysqli_query($conn, "DELETE FROM medical_contacts WHERE id='$id' AND elder_id='$elder_id'");
    header("Location: contacts.php");
    exit();
}

// Fetch contacts
$contacts = mysqli_query($conn, "SELECT * FROM medical_contacts WHERE elder_id='$elder_id' ORDER BY contact_name ASC");
?>

<?php include '../header.php'; ?>
<link rel="stylesheet" href="contacts.css">
<?php include '../navbar.php'; ?>

<div class="container">

    <h1 class="page-title">📋 Contacts</h1>
    <p class="page-subtitle">Your saved medical contacts</p>

    <!-- Add Contact Form -->
    <div class="form-card" style="margin-bottom: 30px;">
        <h2 style="color:#2e7d32; margin-bottom:20px; font-size:18px;">➕ Add New Contact</h2>
        <form method="POST">

            <label>Contact Name</label>
            <input type="text" name="contact_name" placeholder="e.g. Dr. Ram Bahadur" required>

            <label>Contact Type</label>
            <select name="contact_type">
                <option value="Doctor">Doctor</option>
                <option value="Family">Family</option>
                <option value="Caretaker">Caretaker</option>
                <option value="Friend">Friend</option>
                <option value="Hospital">Hospital</option>
                <option value="Other">Other</option>
            </select>

            <label>Phone Number</label>
            <input type="text" name="phone_number" placeholder="e.g. 9800000000" required>

            <label>Address</label>
            <input type="text" name="address" placeholder="e.g. Kathmandu, Nepal">

            <button class="btn" name="add_contact" style="margin-top:6px;">Save Contact</button>
        </form>
    </div>

    <!-- Contact List -->
    <?php if (mysqli_num_rows($contacts) == 0): ?>
        <div class="empty-state">
            <div class="empty-icon">📭</div>
            <h3>No contacts yet</h3>
            <p>Add your first contact above.</p>
        </div>
    <?php else: ?>
        <div class="contact-grid">
            <?php while ($c = mysqli_fetch_assoc($contacts)): ?>
                <div class="contact-card">
                    <div class="contact-avatar">
                        <?= strtoupper(substr($c['contact_name'], 0, 1)) ?>
                    </div>
                    <div class="contact-info">
                        <div class="contact-name"><?= htmlspecialchars($c['contact_name']) ?></div>
                        <div class="contact-phone">📞 <?= htmlspecialchars($c['phone_number']) ?></div>
                        <?php if (!empty($c['address'])): ?>
                            <div class="contact-address">📍 <?= htmlspecialchars($c['address']) ?></div>
                        <?php endif; ?>
                        <div class="contact-type-badge"><?= htmlspecialchars($c['contact_type']) ?></div>
                    </div>
                    <div class="contact-actions">
                        <a href="tel:<?= htmlspecialchars($c['phone_number']) ?>" class="contact-btn btn-call">📞 Call</a>
                        <a href="contacts.php?delete=<?= $c['id'] ?>"
                           class="contact-btn btn-delete"
                           onclick="return confirm('Delete this contact?')">🗑 Delete</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>

</div>

<?php include '../footer.php'; ?>