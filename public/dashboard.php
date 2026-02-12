<?php
require_once __DIR__ . '/../app/config.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secure Dashboard</title>
    <style>
        body { font-family: sans-serif; background: #f4ece8; margin: 0; display: flex; }
        .sidebar { width: 250px; height: 100vh; background: #6f4e37; color: white; padding: 20px; position: fixed; }
        .main-content { margin-left: 290px; padding: 40px; width: 100%; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .logout-btn { color: #ff6b6b; text-decoration: none; font-weight: bold; border: 1px solid #ff6b6b; padding: 5px 10px; border-radius: 4px; }
        .logout-btn:hover { background: #ff6b6b; color: white; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Secure App</h2>
    <p>Logged in as:<br><strong><?php echo htmlspecialchars($email); ?></strong></p>
    <hr>
   <nav>
    <p><a href="dashboard.php" style="color: white; text-decoration: none;">🏠 Home</a></p>
    <p><a href="profile.php" style="color: white; text-decoration: none;">👤 Profile</a></p>
    <p><a href="settings.php" style="color: white; text-decoration: none;">⚙️ Settings</a></p>
    <br>
    <a href="logout.php" class="logout-btn">🚪 Logout</a>
</nav>
</div>

<div class="main-content">
    <div class="card">
        <h1>Welcome to your Hardened Dashboard</h1>
        <p>This area is protected by session-based authentication.</p>
        
        <h3>Security Status:</h3>
        <ul>
            <li><strong>Session ID:</strong> Protected (Regenerated at login)</li>
            <li><strong>SQL Injection:</strong> Blocked (Prepared Statements used)</li>
            <li><strong>XSS Protection:</strong> Active (Output Escaping enabled)</li>
        </ul>
    </div>
</div>

</body>
</html>