<?php include '../header.php'; ?>
<?php include '../navbar.php'; ?>
<?php include '../db.php'; ?>
<?php include '../auth.php'; ?>

<?php
$user_id = $_SESSION['user_id'];

$profileRow = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT id FROM elderly_profile WHERE user_id = '$user_id' LIMIT 1"
));
$elder_id = $profileRow['id'];

if (isset($_POST['save'])) {
    $mood = $_POST['mood'];
    $note = $_POST['note'];
    mysqli_query($conn,
        "INSERT INTO mood_checkins (elder_id, mood, note)
         VALUES ('$elder_id', '$mood', '$note')"
    );
    echo "<script>window.location.href='';</script>";
}

// Delete a history entry
if (isset($_GET['delete'])) {
    $del_id = (int) $_GET['delete'];
    mysqli_query($conn, "DELETE FROM mood_checkins WHERE id='$del_id' AND elder_id='$elder_id'");
    header("Location: mood.php");
    exit();
}

$result = mysqli_query($conn,
    "SELECT * FROM mood_checkins WHERE elder_id='$elder_id' ORDER BY id DESC"
);

$moodMap = [
    'Happy'   => '😊',
    'Normal'  => '😐',
    'Sad'     => '😢',
    'Excited' => '🤩',
    'Weak'    => '😣',
    'Anxious' => '😰',
];

$moodColor = [
    'Happy'   => '#43a047',
    'Normal'  => '#90a4ae',
    'Sad'     => '#1e88e5',
    'Excited' => '#fb8c00',
    'Weak'    => '#e53935',
    'Anxious' => '#8e24aa',
];
?>

<style>
.mood-container { width: 90%; margin: auto; padding: 36px 0; }
.mood-page-title { color: #2e7d32; font-size: 26px; font-weight: 700; margin-bottom: 6px; }
.mood-page-sub { color: #888; font-size: 13px; margin-bottom: 28px; }
.mood-form-card { background: white; border-radius: 20px; padding: 28px 30px; box-shadow: 0 3px 14px rgba(0,0,0,0.08); margin-bottom: 32px; }
.mood-row { display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 22px; }
.mood-btn { flex: 1; min-width: 90px; display: flex; flex-direction: column; align-items: center; gap: 6px; padding: 14px 10px; border-radius: 16px; border: 2px solid #e0e0e0; background: white; cursor: pointer; transition: all .18s; font-size: 13px; font-weight: 600; color: #555; }
.mood-emoji { font-size: 28px; line-height: 1; }
.mood-btn:hover { border-color: #43a047; background: #f4fbf4; color: #2e7d32; transform: translateY(-2px); }
.mood-btn.selected { border-color: #43a047; background: #e8f5e9; color: #1b5e20; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(67,160,71,0.18); }
.mood-note { width: 100%; padding: 13px 15px; border: 1.5px solid #ddd; border-radius: 12px; font-size: 14px; resize: none; margin-bottom: 18px; font-family: Arial, sans-serif; color: #333; box-sizing: border-box; }
.mood-note:focus { outline: none; border-color: #43a047; }
.mood-save-btn { background: #43a047; color: white; border: none; padding: 12px 32px; border-radius: 12px; font-size: 15px; font-weight: 700; cursor: pointer; transition: background .18s; }
.mood-save-btn:hover { background: #2e7d32; }
.mood-section-title { color: #2e7d32; font-size: 20px; font-weight: 700; margin-bottom: 18px; }
.history-grid { display: flex; flex-direction: column; gap: 14px; }
.history-card { background: white; border-radius: 16px; padding: 18px 22px; box-shadow: 0 2px 10px rgba(0,0,0,0.07); display: flex; align-items: flex-start; gap: 16px; border-left: 5px solid #ccc; position: relative; }
.h-emoji { font-size: 32px; flex-shrink: 0; margin-top: 2px; }
.h-body { flex: 1; }
.h-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px; }
.h-mood { font-size: 16px; font-weight: 700; }
.h-time { font-size: 12px; color: #aaa; }
.h-note { font-size: 13px; color: #666; line-height: 1.5; }
.h-delete { position: absolute; top: 12px; right: 14px; text-decoration: none; font-size: 18px; color: #ccc; line-height: 1; transition: color 0.2s; }
.h-delete:hover { color: #e53935; }
.mood-empty { background: white; border-radius: 18px; padding: 50px 30px; text-align: center; box-shadow: 0 3px 12px rgba(0,0,0,0.07); }
.mood-empty p { color: #aaa; font-size: 14px; margin-top: 10px; }
@media (max-width: 600px) {
    .mood-btn { min-width: 70px; padding: 12px 6px; font-size: 12px; }
    .mood-emoji { font-size: 24px; }
}
</style>

<div class="mood-container">

    <h1 class="mood-page-title">😊 Mood Tracker</h1>
    <p class="mood-page-sub">How are you feeling today? Tap a mood to record it.</p>

    <div class="mood-form-card">
        <form method="POST" id="moodForm">

            <input type="hidden" name="mood" id="selectedMood" value="Happy">

            <div class="mood-row">
                <button type="button" class="mood-btn selected" onclick="selectMood(this,'Happy')">
                    <span class="mood-emoji">😊</span>Happy
                </button>
                <button type="button" class="mood-btn" onclick="selectMood(this,'Normal')">
                    <span class="mood-emoji">😐</span>Normal
                </button>
                <button type="button" class="mood-btn" onclick="selectMood(this,'Sad')">
                    <span class="mood-emoji">😢</span>Sad
                </button>
                <button type="button" class="mood-btn" onclick="selectMood(this,'Excited')">
                    <span class="mood-emoji">🤩</span>Excited
                </button>
                <button type="button" class="mood-btn" onclick="selectMood(this,'Weak')">
                    <span class="mood-emoji">😣</span>Weak
                </button>
                <button type="button" class="mood-btn" onclick="selectMood(this,'Anxious')">
                    <span class="mood-emoji">😰</span>Anxious
                </button>
            </div>

            <textarea
                class="mood-note"
                name="note"
                rows="3"
                placeholder="Add a note (optional)..."
            ></textarea>

            <button type="submit" class="mood-save-btn" name="save">Save Mood</button>

        </form>
    </div>

    <h2 class="mood-section-title">Mood History</h2>

    <?php if (mysqli_num_rows($result) == 0): ?>
        <div class="mood-empty">
            <span style="font-size:40px">📋</span>
            <p>No mood entries yet. Start by saving your first mood above!</p>
        </div>
    <?php else: ?>

    <div class="history-grid">
    <?php while ($row = mysqli_fetch_assoc($result)):
        $mood    = $row['mood'];
        $emoji   = $moodMap[$mood]   ?? '😐';
        $color   = $moodColor[$mood] ?? '#90a4ae';
        $note    = $row['note'];
        $timeStr = date("d M Y · h:i A", strtotime($row['created_at']));
    ?>
        <div class="history-card" style="border-left-color: <?= $color ?>">
            <span class="h-emoji"><?= $emoji ?></span>
            <div class="h-body">
                <div class="h-top">
                    <span class="h-mood" style="color: <?= $color ?>"><?= htmlspecialchars($mood) ?></span>
                    <span class="h-time"><?= $timeStr ?></span>
                </div>
                <?php if (!empty($note)): ?>
                    <div class="h-note"><?= htmlspecialchars($note) ?></div>
                <?php endif; ?>
            </div>
            <a href="mood.php?delete=<?= $row['id'] ?>" class="h-delete" title="Remove">✕</a>
        </div>
    <?php endwhile; ?>
    </div>

    <?php endif; ?>

</div>

<script>
function selectMood(el, mood) {
    document.querySelectorAll('.mood-btn').forEach(b => b.classList.remove('selected'));
    el.classList.add('selected');
    document.getElementById('selectedMood').value = mood;
}
</script>

<?php include '../footer.php'; ?>