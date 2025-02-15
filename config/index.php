<?php
// Define the base path for the project
require_once __DIR__ . '/base.php';
 

// Load the .env file to get environment variables
$envFile = BASE_PATH . 'config/.env'; // Now using BASE_PATH
if (!file_exists($envFile)) {
    error_log("Error: .env file not found");
    die("Configuration error: .env file not found");
} else {
    $env = parse_ini_file($envFile);
    if ($env === false) {
        error_log("Error loading .env file");
        die("Configuration error: Failed to parse .env file");
    }
    
    // Set environment variables
    $db_host = trim($env['DB_HOST'], "'");
    $db_name = trim($env['DB_NAME'], "'");
    $db_username = trim($env['DB_USER'], "'");
    $db_password = trim($env['DB_PASS'], "'");
    $domain_name = trim($env['DOMAIN_NAME'], "'");
    
    // Check for missing keys
    if (!isset($db_host, $db_name, $db_username, $db_password, $domain_name)) {
        error_log("Error: .env file is missing some configuration values");
        die("Configuration error: Missing environment values");
    }
}

// Create connection to MySQL if the environment is loaded properly
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check database connection
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    die("Database connection error.");
}
?>
