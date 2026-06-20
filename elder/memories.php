<?php
include '../auth.php';
include '../db.php';

$user_id = $_SESSION['user_id'];

// Upload memory
if (isset($_POST['add_memory'])) {
    $title       = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    if (!empty($_FILES['photo']['name'])) {
        $upload_dir = 'uploads/memories/';

        // Create directory if it doesn't exist
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $ext       = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $file_type = $_FILES['photo']['type'];
        $allowed   = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array(strtolower($ext), $allowed)) {
            $filename  = 'mem_' . time() . '_' . uniqid() . '.' . $ext;
            $filepath  = $upload_dir . $filename;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $filepath)) {
                $sql = "INSERT INTO memories (user_id, title, file_path, file_type, description)
                        VALUES ('$user_id', '$title', '$filepath', '$file_type', '$description')";
                mysqli_query($conn, $sql);
            }
        }
    }

    header("Location: memories.php");
    exit();
}

// Delete memory
if (isset($_GET['delete'])) {
    $id  = (int) $_GET['delete'];
    $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT file_path FROM memories WHERE id='$id' AND user_id='$user_id'"));
    if ($row) {
        if (file_exists($row['file_path'])) {
            unlink($row['file_path']);
        }
        mysqli_query($conn, "DELETE FROM memories WHERE id='$id' AND user_id='$user_id'");
    }
    header("Location: memories.php");
    exit();
}

// Fetch memories
$memories = mysqli_query($conn, "SELECT * FROM memories WHERE user_id='$user_id' ORDER BY uploaded_at DESC");
?>

<?php include '../header.php'; ?>
<link rel="stylesheet" href="memories.css">
<?php include '../navbar.php'; ?>

<div class="container">

    <h1 class="page-title">🖼️ Memories</h1>
    <p class="page-subtitle">Your cherished moments</p>

    <!-- Upload Form -->
    <div class="form-card" style="margin-bottom: 30px;">
        <h2 style="color:#2e7d32; margin-bottom:20px; font-size:18px;">📤 Add a Memory</h2>
        <form method="POST" enctype="multipart/form-data">

            <label>Title</label>
            <input type="text" name="title" placeholder="e.g. Family Picnic 2025">

            <label>Description</label>
            <textarea name="description" placeholder="Write something about this memory..." rows="3"></textarea>

            <label>Photo</label>
            <input type="file" name="photo" accept="image/*" required
                   style="padding:10px; border:2px dashed #c8e6c9; background:#f4fbf4; cursor:pointer;">

            <!-- Preview -->
            <div id="preview-wrap" style="display:none; margin-bottom:18px;">
                <img id="preview-img" src=""
                     style="max-width:100%; max-height:220px; border-radius:14px; object-fit:cover; box-shadow:0 3px 10px rgba(0,0,0,0.1);">
            </div>

            <button class="btn" name="add_memory" style="margin-top:6px;">Save Memory</button>
        </form>
    </div>

    <!-- Gallery -->
    <?php if (mysqli_num_rows($memories) == 0): ?>
        <div class="empty-state">
            <div class="empty-icon">📷</div>
            <h3>No memories yet</h3>
            <p>Upload your first photo above.</p>
        </div>
    <?php else: ?>
        <div class="memory-grid">
            <?php while ($m = mysqli_fetch_assoc($memories)): ?>
                <div class="memory-card">
                    <div class="memory-img-wrap">
                        <img src="<?= htmlspecialchars($m['file_path']) ?>"
                             alt="<?= htmlspecialchars($m['title']) ?>"
                             class="memory-img"
                             onclick="openLightbox(this.src)">
                    </div>
                    <div class="memory-footer">
                        <div class="memory-title"><?= htmlspecialchars($m['title']) ?></div>
                        <?php if (!empty($m['description'])): ?>
                            <div class="memory-desc"><?= htmlspecialchars($m['description']) ?></div>
                        <?php endif; ?>
                        <div class="memory-date"><?= date('M d, Y', strtotime($m['uploaded_at'])) ?></div>
                        <a href="memories.php?delete=<?= $m['id'] ?>"
                           class="memory-delete"
                           >🗑 Delete</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>

</div>

<!-- Lightbox -->
<div id="lightbox" onclick="closeLightbox()" style="display:none;">
    <img id="lightbox-img" src="">
</div>

<?php include '../footer.php'; ?>

<script>
// Image preview before upload
document.querySelector('input[name="photo"]').addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('preview-wrap').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});

// Lightbox
function openLightbox(src) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox').style.display = 'flex';
}

function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
}
</script>