<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

// Load database configuration from .env file
$envFile = '../config/.env';

if (!file_exists($envFile)) {
    die("Error: .env file not found");
}

$env = parse_ini_file($envFile);
if ($env === false) {
    die("Error loading .env file");
}

// Check if all necessary keys are present
if (!isset($env['DB_HOST'], $env['DB_NAME'], $env['DB_USER'], $env['DB_PASS'], $env['DOMAIN_NAME'])) {
    die("Error: .env file is missing some configuration values");
}

// Remove surrounding quotes if present
$db_host = trim($env['DB_HOST'], "'");
$db_name = trim($env['DB_NAME'], "'");
$db_username = trim($env['DB_USER'], "'");
$db_password = trim($env['DB_PASS'], "'");
$domain_name = trim($env['DOMAIN_NAME'], "'"); // Domain name from .env

// Create connection to MySQL
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for adding new apps
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_app'])) {
    $app_name = $_POST['app_name'];
    $platform = $_POST['platform'];
    $icon_url = $_POST['icon_url'];
    
    // Check if internal link is selected
    $is_internal = isset($_POST['is_internal']) && $_POST['is_internal'] == 'true';

    if ($is_internal) {
        // Internal link: use domain name as prefix
        $download_url = $domain_name . $_POST['download_url'];
    } else {
        // External link: use only the provided URL
        $download_url = $_POST['download_url'];
    }

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("INSERT INTO apps (app_name, platform, icon_url, download_url) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $app_name, $platform, $icon_url, $download_url);

    if ($stmt->execute()) {
        $success = "App added successfully.";
    } else {
        $error = "Error adding app: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch the list of apps
$sql = "SELECT id, app_name, platform, icon_url, download_url FROM apps";
$result = $conn->query($sql);

$apps = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $apps[] = $row;
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Framework7 CSS -->
    <link rel="stylesheet" href="https://unpkg.com/framework7/framework7-bundle.min.css">
    
    <style>
        /* Custom styling for the logo and menu */
        .panel .logo {
            text-align: center;
            padding: 20px 0;
        }
        .panel .logo img {
            max-width: 80%;
        }
        .panel .menu-items {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .panel .menu-items li {
            padding: 10px 20px;
            text-align: left;
        }
        .panel .menu-items li a {
            text-decoration: none;
            font-size: 16px;
            color: #000;
        }
        .panel .menu-items li a:hover {
            color: #007aff;
        }
    </style>
</head>
<body>
    <!-- Framework7 App root element -->
    <div id="app">
        <!-- Left panel with cover effect -->
        <div class="panel panel-left panel-cover">
            <!-- Logo -->
            <div class="logo">
                <img src="/path/to/your-logo.png" alt="Website Logo">
            </div>
            
            <!-- Menu items -->
            <ul class="menu-items">
                <li><a href="/admin/dashboard.php">Home</a></li>
                <li><a href="/admin/apps.php">Apps</a></li>
                <li><a href="/admin/admins.php">Admins</a></li>
                <li><a href="/logout.php">Logout</a></li>
            </ul>
        </div>
        
        <!-- Your main content here -->
        <div class="view view-main">
            <header>
                <h1>Admin Dashboard</h1>
                <a href="index.php">Logout</a>
            </header>
            <div class="container">
                <h2>Manage Apps</h2>

                <!-- Success/Error message display -->
                <?php if (isset($success)): ?>
                    <p class="success"><?php echo htmlspecialchars($success); ?></p>
                <?php endif; ?>
                <?php if (isset($error)): ?>
                    <p class="error"><?php echo htmlspecialchars($error); ?></p>
                <?php endif; ?>

                <!-- Form for adding new app -->
                <form action="" method="post">
                    <h3>Add New App</h3>
                    <label for="app_name">App Name:</label>
                    <input type="text" id="app_name" name="app_name" required>
                    
                    <label for="platform">Platform:</label>
                    <input type="text" id="platform" name="platform" required>
                    
                    <label for="icon_url">Icon URL:</label>
                    <input type="text" id="icon_url" name="icon_url" required>
                    
                    <!-- Toggle button for internal/external link -->
                    <label for="is_internal">Link Type:</label>
                    <input type="checkbox" id="is_internal" name="is_internal" value="true" onchange="toggleLinkType()" checked>
                    <label for="is_internal" id="labelText"> Internal link (if you're using og.php direct internal link</label>

                    <label for="download_url">Locker URL:</label>
                    <input type="text" id="download_url" name="download_url" placeholder="Example: <?php echo $domain_name; ?>" required>

                    <input type="submit" name="add_app" value="Add App">
                </form>

                <!-- Display list of existing apps -->
                <h3>Existing Apps</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Platform</th>
                            <th>Icon</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($apps as $app): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($app['id']); ?></td>
                                <td><?php echo htmlspecialchars($app['app_name']); ?></td>
                                <td><?php echo htmlspecialchars($app['platform']); ?></td>
                                <td><img src="<?php echo htmlspecialchars($app['icon_url']); ?>" alt="Icon" style="width: 50px;"></td>
                                <td><a href="<?php echo htmlspecialchars($app['download_url']); ?>" target="_blank">Download</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Framework7 JS -->
    <script src="https://unpkg.com/framework7/framework7-bundle.min.js"></script>
    <script>
        // Initialize the Framework7 app
        var app = new Framework7({
            root: '#app',
            theme: 'auto', // Automatically set the theme
            panel: {
                swipe: true, // Enable swipe open for the panel
            },
        });

        // Function to toggle between internal and external link placeholders
        function toggleLinkType() {
            const toggleSwitch = document.getElementById('is_internal');
            const downloadUrlInput = document.getElementById('download_url');
            const domainName = '<?php echo $domain_name; ?>';
            const labelText = document.getElementById('labelText');
            if (toggleSwitch.checked) {
                labelText.innerText = " Internal link (if you're using og.php direct internal link) ";
                downloadUrlInput.placeholder = `Example: ${domainName}`;
            } else {
                labelText.innerText = " External link ";
                downloadUrlInput.placeholder = `Example: ${domainName} + og.php?u=/cl/i/6dll8j`;
            }
        }
    </script>
</body>
</html>
