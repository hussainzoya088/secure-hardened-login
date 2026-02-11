<?php
// 1. Load config and check session
require_once __DIR__ . '/../app/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// 2. Load the modular header (CSS + Sidebar)
// Note: Using require_once ensures the page crashes if the file is missing 
// so you don't get a "messy" broken page.
require_once __DIR__ . '/../app/header.php'; 
?>

<div class="card">
    <h1>👤 User Profile</h1>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
    <p><strong>Account Status:</strong> <span style="color: green;">Hardened & Active</span></p>
    <hr>
    <p>This data is pulled from the session, which was secured during the login process using <code>session_regenerate_id</code>.</p>
</div>

<?php 
// Close the main-content div opened in header.php
echo '</div></body></html>'; 
?>