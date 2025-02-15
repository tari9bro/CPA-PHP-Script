<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup</title>
    <link rel="stylesheet" href="/public/css/setup.css">
</head>
<body>
    <header>
        <h1>Setup</h1>
    </header>
    <div class="container">
        <h2>Database Setup</h2>

        <?php
        // Check if the setup.lock file exists
        if (file_exists('../config/setup.lock')) {
            header("Location: index.php");
            exit;
        }

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Collect form data
            $db_host = $_POST['db_host'];
            $db_name = $_POST['db_name'];
            $db_username = $_POST['db_username'];
            $db_password = $_POST['db_password'];
            $admin_username = $_POST['admin_username'];
            $admin_password = $_POST['admin_password'];
            $domain_name = $_POST['domain_name']; // New domain name input

            // Create connection to MySQL for database creation
            $conn = new mysqli($db_host, $db_username, $db_password);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Create database
            $sql = "CREATE DATABASE IF NOT EXISTS $db_name";
            if ($conn->query($sql) !== TRUE) {
                die("Error creating database: " . $conn->error);
            }

            // Select the database
            $conn->select_db($db_name);

            // Create admin_users table
            $sql = "CREATE TABLE IF NOT EXISTS admin_users (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) NOT NULL,
                password VARCHAR(255) NOT NULL
            )";
            if ($conn->query($sql) !== TRUE) {
                die("Error creating table admin_users: " . $conn->error);
            }

            // Create apps table
            $sql = "CREATE TABLE IF NOT EXISTS apps (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                app_name VARCHAR(100) NOT NULL,
                platform VARCHAR(50) NOT NULL,
                icon_url VARCHAR(255) NOT NULL,
                download_url VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
            if ($conn->query($sql) !== TRUE) {
                die("Error creating table apps: " . $conn->error);
            }

            // Insert the initial admin user
            $admin_password_hash = password_hash($admin_password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO admin_users (username, password) VALUES ('$admin_username', '$admin_password_hash')";
            if ($conn->query($sql) !== TRUE) {
                die("Error creating admin user: " . $conn->error);
            }

            // Create the .env file with single quotes around values, including the domain name
            $env_content = "DB_HOST='$db_host'\nDB_NAME='$db_name'\nDB_USER='$db_username'\nDB_PASS='$db_password'\nDOMAIN_NAME='$domain_name'\n";
            file_put_contents('../config/.env', $env_content);

            // Create a lock file to prevent the script from running again
            file_put_contents('../config/setup.lock', 'locked');

            // Close connection
            $conn->close();

            // Redirect to adminlogin.php
            header("Location: index.php");
            exit;
        }
        ?>

        <!-- Form for database, domain, and admin user setup -->
        <h2>Database and Admin User Setup</h2>
        <form action="" method="post">
            <h3>Database Information</h3>
            <label for="db_host">Database Host:</label>
            <input type="text" id="db_host" name="db_host" required>
            
            <label for="db_name">Database Name:</label>
            <input type="text" id="db_name" name="db_name" required>
            
            <label for="db_username">Database Username:</label>
            <input type="text" id="db_username" name="db_username" required>
            
            <label for="db_password">Database Password:</label>
            <input type="password" id="db_password" name="db_password" required>

            <h3>Domain Information</h3>
            <label for="domain_name">Domain Name:</label>
            <input type="text" id="domain_name" name="domain_name" required>

            <h3>Admin User Information</h3>
            <label for="admin_username">Admin Username:</label>
            <input type="text" id="admin_username" name="admin_username" required>
            
            <label for="admin_password">Admin Password:</label>
            <input type="password" id="admin_password" name="admin_password" required>

            <input type="submit" value="Set Up">
        </form>
    </div>
</body>
</html>
