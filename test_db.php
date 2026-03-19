<?php
require_once 'includes/db.php';
$stmt = $conn->query("SHOW TABLES");
$tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
echo "Tables:\n";
print_r($tables);

foreach ($tables as $table) {
    if (strpos(strtolower($table), 'mess') !== false || strpos(strtolower($table), 'mass') !== false) {
        $stmt = $conn->query("DESCRIBE $table");
        echo "\nColumns in $table:\n";
        print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
    }
}
?>
