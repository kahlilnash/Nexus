<?php
// Database Configuration Constants
define('DB_HOST', 'localhost');
define('DB_NAME', 'users');
define('DB_USER', 'root');
define('DB_PASS', '');

// Data Source Name (DSN) Configuration
$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";

// PDO Driver Options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Instantiate the primary database object connection
    $dbh = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    // Display clean termination error to adhere to security standards
    die("Application connection failed: Database structural linkage could not be verified.");
}
?>