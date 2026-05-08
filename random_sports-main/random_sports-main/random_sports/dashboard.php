<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

// Stream Link Update Logic (Example for EPL)
if (isset($_POST['update_epl'])) {
    $id = $_POST['match_id'];
    $new_url = $_POST['stream_url'];
    $conn->query("UPDATE epl_streams SET stream_url='$new_url' WHERE id=$id");
    $msg = "EPL Link Updated Successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard | RandomSports</title>
    <style>
        body { background: #0b0d17; color: white; font-family: sans-serif; padding: 20px; }
        .nav { background: #161b22; padding: 15px; display: flex; justify-content: space-between; margin-bottom: 20px; }
        .card { background: #161b22; padding: 20px; border-radius: 10px; margin-bottom: 10px; border: 1px solid #30363d; }
        input { padding: 8px; width: 300px; background: #0d1117; color: white; border: 1px solid #333; }
        button { padding: 8px 15px; background: #00a859; color: white; border: none; cursor: pointer; }
        a { color: #ff4757; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="nav">
        <strong>RandomSports Admin Panel</strong>
        <a href="logout.php">Logout</a>
    </div>

    <h1>Manage Stream Links</h1>
    <?php if(isset($msg)) echo "<p style='color:green;'>$msg</p>"; ?>

    <div class="card">
        <h3>Update Premier League (EPL) Links</h3>
        <?php
        $res = $conn->query("SELECT * FROM epl_streams");
        while($row = $res->fetch_assoc()) {
            echo "<form method='POST' style='margin-bottom:10px;'>
                    <span>{$row['match_title']}</span><br>
                    <input type='hidden' name='match_id' value='{$row['id']}'>
                    <input type='text' name='stream_url' value='{$row['stream_url']}'>
                    <button type='submit' name='update_epl'>UPDATE</button>
                  </form>";
        }
        ?>
    </div>
    
    <p>Tumi chaile ami nicher baki league gulo (LaLiga, UCL, F1) ekhanei add kore dite pari.</p>
</body>
</html>