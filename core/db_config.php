<?php
// db.php - Database connection logic

// Load database configuration from .env file
$envFile = 'config/.env';
if (!file_exists($envFile)) {
    die("Error: .env file not found");
}

$env = parse_ini_file($envFile);
if ($env === false) {
    die("Error loading .env file");
}

// Check if all necessary keys are present
if (!isset($env['DB_HOST'], $env['DB_NAME'], $env['DB_USER'], $env['DB_PASS'])) {
    die("Error: .env file is missing some configuration values");
}

// Remove surrounding quotes if present
$db_host = trim($env['DB_HOST'], "'");
$db_name = trim($env['DB_NAME'], "'");
$db_username = trim($env['DB_USER'], "'");
$db_password = trim($env['DB_PASS'], "'");

// Create a connection to MySQL
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
