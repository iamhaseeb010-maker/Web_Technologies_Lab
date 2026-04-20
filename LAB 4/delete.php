<?php
/**
 * Abdul Haseeb | Lab 4: Delete Student Record
 * This script processes the deletion and redirects back to the dashboard.
 */

require_once 'db.php';

// 1. Verify ID presence and validity
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int)$_GET['id'];

if ($id <= 0) {
    header('Location: index.php?error=invalid_id');
    exit;
}

try {
    $pdo = getPDO();
    
    // 2. Execute the deletion
    $stmt = $pdo->prepare('DELETE FROM students WHERE id = ?');
    $stmt->execute([$id]);

    // 3. Check if a row was actually deleted (the ID might not exist in DB)
    if ($stmt->rowCount() > 0) {
        header('Location: index.php?deleted=1');
    } else {
        header('Location: index.php?error=not_found');
    }
    exit;

} catch (PDOException $e) {
    // 4. Handle foreign key constraints or DB errors
    header('Location: index.php?error=db_failure');
    exit;
}