<?php
/**
 * Abdul Haseeb | Lab 4: Database Configuration & Auto-Setup
 * This script handles PDO connections and ensures the environment is ready.
 */

// --- Configuration ---
define('DB_HOST', 'localhost');
define('DB_NAME', 'crud_system');
define('DB_USER', 'student_admin'); // Ensure this user has CREATE privileges
define('DB_PASS', 'password123');

/**
 * Returns a PDO instance.
 * Automatically creates the Database and Table if they don't exist.
 */
function getPDO()
{
    static $pdo = null;
    if ($pdo !== null) return $pdo;

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $dsnWithDb = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    
    try {
        // Attempt primary connection
        $pdo = new PDO($dsnWithDb, DB_USER, DB_PASS, $options);
        ensureTableExists($pdo);
        return $pdo;
        
    } catch (PDOException $e) {
        // Error Code 1049: Unknown Database
        if ((int)$e->getCode() === 1049 || str_contains($e->getMessage(), 'Unknown database')) {
            return setupDatabaseAndTable($options);
        }

        // Generic Connection Error
        handleConnectionError($e->getMessage());
    }
}

/**
 * Creates the database and student table from scratch.
 */
function setupDatabaseAndTable($options)
{
    try {
        // Connect to MySQL server without a specific database
        $dsnNoDb = "mysql:host=" . DB_HOST . ";charset=utf8mb4";
        $tempPdo = new PDO($dsnNoDb, DB_USER, DB_PASS, $options);
        
        // 1. Create Database
        $tempPdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        
        // 2. Reconnect with DB selected
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS, $options);
        
        // 3. Create Table
        ensureTableExists($pdo);
        
        return $pdo;
    } catch (PDOException $e) {
        handleConnectionError("Auto-setup failed: " . $e->getMessage());
    }
}

/**
 * SQL Schema for the students table.
 */
function ensureTableExists($pdo)
{
    $sql = "CREATE TABLE IF NOT EXISTS `students` (
        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `first_name` VARCHAR(100) NOT NULL,
        `last_name` VARCHAR(100) NOT NULL,
        `email` VARCHAR(150) NOT NULL,
        `dob` DATE DEFAULT NULL,
        `course` VARCHAR(150) DEFAULT NULL,
        `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        UNIQUE KEY `email_unique` (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    $pdo->exec($sql);
}

/**
 * Clean error reporting.
 */
function handleConnectionError($msg)
{
    http_response_code(500);
    // In a real project, you'd log this instead of echoing it
    die("<div style='font-family:sans-serif; padding:20px; color:#991b1b; background:#fef2f2; border:1px solid #fee2e2; border-radius:12px;'>
            <h3 style='margin-top:0;'>Database Connection Issue</h3>
            <p>$msg</p>
            <small>Check your DB_USER and DB_PASS in <b>db.php</b></small>
         </div>");
}