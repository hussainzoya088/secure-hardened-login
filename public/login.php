<?php
// 1. HARDENING: Display errors for debugging (Turn off for final submission)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Link to Security Config and Functions
require_once __DIR__ . '/../app/config.php';
require_once __DIR__ . '/../app/functions.php';

// 3. EDGE CASE: If already logged in, skip login page
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';

// 4. SERVER-SIDE PROCESSING
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input to prevent XSS
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        try {
            // SQL HARDENING: Prepared Statement to prevent SQL Injection
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            // Verify Password and User Existence
            if ($user && password_verify($password, $user['password'])) {
                
                // SESSION HARDENING: Prevent Session Fixation attacks
                session_regenerate_id(true); 
                
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                
                header("Location: dashboard.php");
                exit;
            } else {
                // EDGE CASE: Generic error message to prevent account harvesting
                $error = "Invalid email or password.";
            }
        } catch (PDOException $e) {
            $error = "A system error occurred. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hardened Login</title>
    <style>
        body { font-family: sans-serif; background: #f4ece8; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 350px; }
        h2 { color: #6f4e37; text-align: center; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #6f4e37; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #5a3e2b; }
        .error { color: #d9534f; font-size: 14px; margin-bottom: 10px; text-align: center; }
    </style>
</head>
<body>

<div class="login-card">
    <h2>Secure Login</h2>

    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required id="password">
        <button type="submit">Log In</button>
    </form>
    
    <p style="text-align: center; font-size: 12px; margin-top: 15px;">
        <a href="register.php" style="color: #6f4e37;">Need an account? Register here</a>
    </p>
</div>

<script src="js/security.js"></script>

</body>
</html>