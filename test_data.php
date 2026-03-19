<?php
require_once 'includes/db.php';
$stmt = $conn->query("SELECT * FROM messages");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Messages in DB:\n";
print_r($rows);
?>
