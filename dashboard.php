<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Protect the dashboard page, require login
if (!is_logged_in()) {
    redirect("auth.html?error=" . urlencode("Please log in to access your dashboard."));
}

$user_id = $_SESSION['user_id'];

// Fetch user data
$stmt = $conn->prepare("SELECT username, email, created_at FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    // If user is not found, destroy session and force login
    session_destroy();
    redirect("auth.html");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Golden Palm Resort</title>
    <!-- Basic styling for the backend dashboard to keep it simple -->
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; margin: 0; padding: 0; }
        .navbar { background-color: #0f2824; color: white; padding: 15px 20px; display: flex; justify-content: space-between; }
        .navbar a { color: #d4af37; text-decoration: none; font-weight: bold; }
        .container { max-width: 800px; margin: 40px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #0f2824; }
        .info-card { background: #e9ecef; padding: 15px; border-radius: 5px; margin-top: 20px;}
        .info-card p { margin: 5px 0; }
        .btn { display: inline-block; background-color: #d4af37; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; margin-top: 20px;}
        .btn:hover { background-color: #b5952f; }
    </style>
</head>
<body>
    <div class="navbar">
        <div>Golden Palm Resort - User Panel</div>
        <div>
            <a href="index.html">Back to Home</a> | 
            <a href="auth/logout.php">Logout</a>
        </div>
    </div>
    
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h1>
        <p>This is your personalized dashboard.</p>
        
        <div class="info-card">
            <h3>Your Profile Information</h3>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Account Created:</strong> <?php echo htmlspecialchars(date('F j, Y', strtotime($user['created_at']))); ?></p>
        </div>
        
        <p style="margin-top: 30px; color: #666; font-size: 0.9em;">
            <em>Note: Room bookings integration will appear here in the future.</em>
        </p>
    </div>
</body>
</html>
