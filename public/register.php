<?phpini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../app/config.php';
require_once __DIR__ . '/../app/functions.php';

$error = '';
$success = '';if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    }     elseif (strlen($password) < 12) {
        $error = "Security Rule: Password must be at least 12 characters.";
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        try {
            $checkEmail = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $checkEmail->execute([$email]);
            
            if ($checkEmail->fetch()) {
                $error = "This email is already registered.";
            } else {
               
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                
                $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
                if ($stmt->execute([$email, $hashedPassword])) {
                    $success = "Registration successful! You can now log in.";
                }
            }
        } catch (PDOException $e) {
            $error = "Registration failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hardened Registration</title>
    <style>
        body { font-family: sans-serif; background: #f4ece8; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .register-card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 350px; }
        h2 { color: #6f4e37; text-align: center; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #6f4e37; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        button:hover { background: #5a3e2b; }
        .error { color: #d9534f; font-size: 14px; margin-bottom: 10px; text-align: center; }
        .success { color: #28a745; font-size: 14px; margin-bottom: 10px; text-align: center; }
    </style>
</head>
<body>

<div class="register-card">
    <h2>Create Account</h2>

    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success"><?php echo $success; ?></div>
    <?php endif; ?>

    <form method="POST" action="register.php">
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password (Min 12 characters)" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Register Now</button>
    </form>
    
    <p style="text-align: center; font-size: 12px; margin-top: 15px;">
        <a href="login.php" style="color: #6f4e37;">Already have an account? Login here</a>
    </p>
</div>

<script src="js/security.js"></script>
</body>
</html>