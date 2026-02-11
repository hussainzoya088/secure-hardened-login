<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secure Hardened App</title>
    <style>
        /* CSS stays here - now it applies to every page! */
        body { font-family: sans-serif; background: #f4ece8; margin: 0; display: flex; }
        .sidebar { width: 250px; height: 100vh; background: #6f4e37; color: white; padding: 20px; position: fixed; }
        .main-content { margin-left: 290px; padding: 40px; width: 100%; }
        .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        nav p a { color: white; text-decoration: none; display: block; padding: 10px; border-radius: 4px; }
        nav p a:hover { background: #5a3e2b; }
        .logout-btn { color: #ff6b6b; text-decoration: none; font-weight: bold; border: 1px solid #ff6b6b; padding: 5px 10px; border-radius: 4px; display: inline-block; margin-top: 20px;}
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Secure App</h2>
    <p>User: <strong><?php echo htmlspecialchars($_SESSION['email']); ?></strong></p>
    <hr>
    <nav>
        <p><a href="dashboard.php">🏠 Home</a></p>
        <p><a href="profile.php">👤 Profile</a></p>
        <p><a href="settings.php">⚙️ Settings</a></p>
        <a href="logout.php" class="logout-btn">🚪 Logout</a>
    </nav>
</div>

<div class="main-content">