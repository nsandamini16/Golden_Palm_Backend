<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitize_input($_POST['username'] ?? '');
    $email = sanitize_input($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validate inputs
    if (empty($username) || empty($email) || empty($password)) {
        redirect("../auth.html?tab=register&error=" . urlencode("All fields are required."));
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        redirect("../auth.html?tab=register&error=" . urlencode("Invalid email format."));
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        redirect("../auth.html?tab=register&error=" . urlencode("Email is already registered."));
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    
    if ($stmt->execute([$username, $email, $hashed_password])) {
        // Success
        redirect("../auth.html?success=" . urlencode("Registration successful. Please log in."));
    } else {
        // Error
        redirect("../auth.html?tab=register&error=" . urlencode("Registration failed. Please try again."));
    }
} else {
    redirect("../auth.html");
}
?>
