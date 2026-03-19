<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = sanitize_input($_POST['firstName'] ?? '');
    $last_name = sanitize_input($_POST['lastName'] ?? '');
    $email = sanitize_input($_POST['email'] ?? '');
    $phone = sanitize_input($_POST['phone'] ?? ''); // Ignoring for DB insertion as per schema
    $message = sanitize_input($_POST['message'] ?? '');

    // Combine names
    $full_name = trim($first_name . " " . $last_name);

    // Validate inputs
    if (empty($first_name) || empty($last_name) || empty($email) || empty($message)) {
        // Here we ideally send back an error. 
        // For simplicity, redirecting with a query param
        redirect("contact.html?error=" . urlencode("All fields are required."));
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        redirect("contact.html?error=" . urlencode("Invalid email format."));
    }

    // Insert message into database
    $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    
    if ($stmt->execute([$full_name, $email, $message])) {
        // Success
        redirect("contact.html?success=" . urlencode("Your message has been sent successfully!"));
    } else {
        // Error
        redirect("contact.html?error=" . urlencode("Failed to send message. Please try again later."));
    }
} else {
    redirect("contact.html");
}
?>
