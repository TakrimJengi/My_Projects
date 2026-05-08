<?php
session_start();
include 'db.php';

if (isset($_POST['login'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM admin_users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: dashboard.php");
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login | RandomSports</title>
    <style>
        body { background: #0b0d17; color: white; font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-card { background: #161b22; padding: 40px; border-radius: 10px; border: 1px solid #30363d; width: 300px; }
        input { width: 100%; padding: 10px; margin: 10px 0; background: #0d1117; border: 1px solid #30363d; color: white; }
        button { width: 100%; padding: 10px; background: #00a859; border: none; color: white; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Admin Login</h2>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="user" placeholder="Username" required>
            <input type="password" name="pass" placeholder="Password" required>
            <button type="submit" name="login">LOGIN</button>
        </form>
    </div>
</body>
</html>