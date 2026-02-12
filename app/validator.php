<?php
function sanitizeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function validateRegistration($email, $password) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format.";
    }
   
    if (strlen($password) < 12) {
        return "Security Rule: Password must be at least 12 characters.";
    }
    return true;
}