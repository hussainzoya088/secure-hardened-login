<?php
require_once __DIR__ . '/../app/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings - Secure App</title>
    <style>
        body { font-family: sans-serif; background: #f4ece8; margin: 0; padding: 50px; display: flex; justify-content: center; }
        .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 500px; }
        h1 { color: #6f4e37; border-bottom: 2px solid #f4ece8; padding-bottom: 10px; }
        .status-box { background: #e8f5e9; border-left: 5px solid #28a745; padding: 15px; margin: 20px 0; }
        .back-link { display: inline-block; margin-top: 20px; color: #6f4e37; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Account Settings</h1>
        <div class="status-box">
            Security Level: <strong>High (Hardened)</strong><br>
            <small>Two-factor simulation active. Session ID rotated.</small>
        </div>
        <p>Manage your security preferences and account details here.</p>
        <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
    </div>
</body>
</html>