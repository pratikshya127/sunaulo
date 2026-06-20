<?php include '../header.php'; ?>
<?php include '../db.php'; ?>
<?php include '../auth.php'; ?>

<?php
$user_id = $_SESSION['user_id'];

$profileRow = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT id FROM elderly_profile WHERE user_id = '$user_id' LIMIT 1"
));
$elder_id = $profileRow['id'];

date_default_timezone_set("Asia/Kathmandu");
$currentDate = date("Y-m-d");
$currentTime = date("H:i:s");

mysqli_query($conn,"
    UPDATE medicine_schedule
    SET status = 'Missed'
    WHERE elder_id = '$elder_id'
    AND status = 'Pending'
    AND date = '$currentDate'
    AND reminder_time < '$currentTime'
");

if(isset($_POST['update_status'])){
    $medicine_id = $_POST['medicine_id'];
    $status      = $_POST['status'];
    mysqli_query($conn,"
        UPDATE medicine_schedule
        SET status = '$status'
        WHERE id = '$medicine_id'
        AND elder_id = '$elder_id'
    ");
    echo "<script>alert('Status Updated!'); window.location.href='';</script>";
}

$result = mysqli_query($conn,"
    SELECT * FROM medicine_schedule
    WHERE elder_id = '$elder_id'
    ORDER BY date DESC, reminder_time ASC
");
?>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial,sans-serif}
body{background:#eef9ee}

.med-container{width:90%;margin:auto;padding:36px 0}

.med-header{margin-bottom:28px}
.med-header h1{color:#2e7d32;font-size:26px;font-weight:700;margin-bottom:6px}
.med-header p{color:#888;font-size:14px}

.empty-state{background:white;border-radius:18px;padding:60px 30px;text-align:center;box-shadow:0 3px 12px rgba(0,0,0,0.08)}
.empty-state .empty-icon{font-size:48px;margin-bottom:14px}
.empty-state h3{color:#2e7d32;font-size:20px;margin-bottom:8px}
.empty-state p{color:#aaa;font-size:14px}

.medicine-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:20px}

.med-card{background:white;border-radius:18px;padding:22px;border-left:5px solid #ccc;display:flex;flex-direction:column;gap:14px;box-shadow:0 3px 14px rgba(0,0,0,0.08);transition:transform .2s,box-shadow .2s}
.med-card:hover{transform:translateY(-4px);box-shadow:0 8px 24px rgba(0,0,0,0.13)}

.status-border-taken    {border-left-color:#43a047}
.status-border-pending  {border-left-color:#8e24aa}
.status-border-missed   {border-left-color:#e53935}
.status-border-not-taken{border-left-color:#fb8c00}
.status-border-finished {border-left-color:#1e88e5}

.med-card-top{display:flex;justify-content:space-between;align-items:flex-start;gap:10px}
.med-name{font-size:19px;font-weight:700;color:#1b5e20;text-transform:capitalize;line-height:1.2}

.status-badge{font-size:11px;font-weight:600;padding:5px 12px;border-radius:20px;white-space:nowrap;flex-shrink:0}
.badge-taken    {background:#e8f5e9;color:#1b5e20}
.badge-pending  {background:#f3e5f5;color:#4a148c}
.badge-missed   {background:#ffebee;color:#b71c1c}
.badge-not-taken{background:#fff3e0;color:#bf360c}
.badge-finished {background:#e3f2fd;color:#0d47a1}

.med-info-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px 10px;background:#f4fbf4;border-radius:12px;padding:14px}
.med-info-item{display:flex;align-items:flex-start;gap:8px}
.info-icon{font-size:17px;flex-shrink:0;margin-top:1px}
.info-label{font-size:10px;text-transform:uppercase;letter-spacing:.5px;color:#aaa;font-weight:700;margin-bottom:2px}
.info-value{font-size:13px;font-weight:600;color:#333;line-height:1.3}

.med-btn-row{display:flex;gap:7px;border-top:1px solid #f0f0f0;padding-top:13px}
.med-btn{flex:1;padding:9px 6px;border-radius:10px;font-size:12px;font-weight:600;cursor:pointer;white-space:nowrap;border:1.5px solid transparent;transition:opacity .2s,transform .15s}
.med-btn:hover{opacity:.82;transform:scale(1.04)}
.btn-taken {background:#e8f5e9;color:#1b5e20;border-color:#a5d6a7}
.btn-not   {background:#ffebee;color:#b71c1c;border-color:#ef9a9a}
.btn-finish{background:#e3f2fd;color:#0d47a1;border-color:#90caf9}

@media(max-width:640px){
    .medicine-grid{grid-template-columns:1fr}
    .med-btn-row{flex-direction:column}
    .med-btn{width:100%;text-align:center}
}
</style>

<?php include '../navbar.php'; ?>

<div class="med-container">

    <div class="med-header">
        <h1>💊 My Medicine Schedule</h1>
        <p>Your medicines are managed by your family. Update your status after taking each one.</p>
    </div>

    <?php if(mysqli_num_rows($result) == 0): ?>
        <div class="empty-state">
            <div class="empty-icon">💊</div>
            <h3>No medicines scheduled yet</h3>
            <p>Your family will add your medicines here.</p>
        </div>
    <?php else: ?>

    <div class="medicine-grid">

    <?php while($row = mysqli_fetch_assoc($result)):
        $status      = $row['status'] ?? 'Pending';
        $statusClass = strtolower(str_replace(' ', '-', $status));
        $icons = ['Taken'=>'✅','Missed'=>'⚠️','Finished'=>'💊','Not Taken'=>'❌','Pending'=>'⏳'];
        $icon     = $icons[$status] ?? '⏳';
        $timeStr  = date("h:i A", strtotime($row['reminder_time']));
        $dateStr  = date("d M Y",  strtotime($row['date']));
        $interval = !empty($row['med_interval']) ? $row['med_interval'] : '—';
        $id       = $row['id'];
    ?>

        <div class="med-card status-border-<?php echo $statusClass; ?>">

            <div class="med-card-top">
                <div class="med-name"><?php echo htmlspecialchars($row['medicine_name']); ?></div>
                <span class="status-badge badge-<?php echo $statusClass; ?>">
                    <?php echo $icon . ' ' . $status; ?>
                </span>
            </div>

            <div class="med-info-grid">
                <div class="med-info-item">
                    <span class="info-icon">💉</span>
                    <div>
                        <div class="info-label">Dosage</div>
                        <div class="info-value"><?php echo htmlspecialchars($row['dosage']); ?></div>
                    </div>
                </div>
                <div class="med-info-item">
                    <span class="info-icon">🔁</span>
                    <div>
                        <div class="info-label">Interval</div>
                        <div class="info-value"><?php echo htmlspecialchars($interval); ?></div>
                    </div>
                </div>
                <div class="med-info-item">
                    <span class="info-icon">🕐</span>
                    <div>
                        <div class="info-label">Time</div>
                        <div class="info-value"><?php echo $timeStr; ?></div>
                    </div>
                </div>
                <div class="med-info-item">
                    <span class="info-icon">📅</span>
                    <div>
                        <div class="info-label">Date</div>
                        <div class="info-value"><?php echo $dateStr; ?></div>
                    </div>
                </div>
            </div>

            <form method="POST" class="med-btn-row">
                <input type="hidden" name="medicine_id" value="<?php echo $id; ?>">
                <input type="hidden" name="status" id="status_<?php echo $id; ?>">
                <button type="submit" class="med-btn btn-taken" name="update_status"
                    onclick="document.getElementById('status_<?php echo $id; ?>').value='Taken'">
                    ✅ Taken
                </button>
                <button type="submit" class="med-btn btn-not" name="update_status"
                    onclick="document.getElementById('status_<?php echo $id; ?>').value='Not Taken'">
                    ❌ Not Taken
                </button>
                <button type="submit" class="med-btn btn-finish" name="update_status"
                    onclick="document.getElementById('status_<?php echo $id; ?>').value='Finished'">
                    💊 Finished
                </button>
            </form>

        </div>

    <?php endwhile; ?>
    </div>

    <?php endif; ?>
</div>

<?php include '../footer.php'; ?>