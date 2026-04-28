<?php
$path = __DIR__ . '/../database/database.sqlite';
if (!file_exists($path)) {
    echo "Database file not found: $path\n";
    exit(1);
}
try {
    $db = new PDO('sqlite:' . $path);
    $res = $db->query("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name");
    echo "Tables:\n";
    foreach ($res as $row) {
        echo " - " . $row['name'] . "\n";
    }
    // Count links rows
    $count = $db->query("SELECT COUNT(*) AS c FROM links")->fetch(PDO::FETCH_ASSOC);
    echo "\nlinks count: " . ($count['c'] ?? '0') . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
