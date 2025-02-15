<?php
require_once('header.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);




// Handle form submission for adding new apps
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_app'])) {
    $app_name = $_POST['app_name'];
    $platform = $_POST['platform'];
    $icon_url = $_POST['icon_url'];

    // Check if internal link is selected
    $is_internal = isset($_POST['is_internal']) && $_POST['is_internal'] === 'true';

    if ($is_internal) {
        // Internal link: use domain name as prefix
        $download_url = $domain_name . $_POST['download_url'];
    } else {
        // External link: use only the provided URL
        $download_url = $_POST['download_url'];
    }
 error_log("Form submitted.");
    error_log("App Name: " . $_POST['app_name']);
    error_log("Platform: " . $_POST['platform']);
    error_log("Icon URL: " . $_POST['icon_url']);
    error_log("Is Internal: " . (isset($_POST['is_internal']) ? $_POST['is_internal'] : 'not set'));
    error_log("Download URL: " . $_POST['download_url']);
    // Prepare and execute the SQL query
    if (isset($conn)) {
        $stmt = $conn->prepare("INSERT INTO apps (app_name, platform, icon_url, download_url) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $app_name, $platform, $icon_url, $download_url);

        // Check if the statement is prepared successfully
        if ($stmt === false) {
            error_log("Statement preparation failed: " . $conn->error);
            die("Statement preparation error.");
        }

        // Execute the statement and check for errors
        if ($stmt->execute()) {
            $success = "App added successfully.";
        } else {
            $error = "Error adding app: " . $stmt->error;
        }

        // Log the values for debugging
        error_log("SQL Statement: INSERT INTO apps (app_name, platform, icon_url, download_url) VALUES ($app_name, $platform, $icon_url, $download_url)");

        $stmt->close();
    } else {
        error_log("Database connection is not set.");
    }
}

// Fetch the list of apps if the database connection exists
$apps = [];
if (isset($conn)) {
    $sql = "SELECT id, app_name, platform, icon_url, download_url FROM apps";
    $result = $conn->query($sql);

    if ($result === false) {
        error_log("Error executing query: " . $conn->error);
        die("Query error."); // Optionally display a message
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $apps[] = $row;
        }
    }

    // Close connection
    $conn->close();
} else {
    error_log("Database connection is not set.");
}



 ?>

  <nav class="custom-nav">
  <input type="checkbox" class="custom-nav__cb" id="custom-menu-cb"/>
  <div class="custom-nav__content">
    <ul class="custom-nav__items">
      <li class="custom-nav__item">
        <span class="custom-nav__item-text">
          Home
        </span>
      </li>
      <li class="custom-nav__item">
        <span class="custom-nav__item-text">
          Works
        </span>
      </li>
      <li class="custom-nav__item">
        <span class="custom-nav__item-text">
          About
        </span>
      </li>
      <li class="custom-nav__item">
        <span class="custom-nav__item-text">
          Contact
        </span>
      </li>
    </ul>
  </div>
  <label class="custom-nav__btn" for="custom-menu-cb"></label>
</nav>

<div class="container mt-3">
    


    <h2>Manage Apps</h2>

    <!-- Success/Error message display -->
    <?php if (isset($success)): ?>
        <p class="success"><?php echo htmlspecialchars($success); ?></p>
    <?php endif; ?>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <!-- Form for adding new app -->
    <form id="addAppForm" action="" method="post" class="mb-4" onsubmit="">

    <!--<form action="" method="post" class="mb-4">-->
        <h3>Add New App</h3>
        <div class="form-group">
            <label for="app_name">App Name:</label>
            <input type="text" id="app_name" name="app_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="platform">Platform:</label>
            <input type="text" id="platform" name="platform" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="icon_url">Icon URL:</label>
            <input type="text" id="icon_url" name="icon_url" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="is_internal">Link Type:</label>
            <input type="checkbox" id="is_internal" name="is_internal" value="true" onchange="" checked>
            <label for="is_internal" id="labelText"> Internal link (if you're using og.php direct internal link)</label>
        </div>
        <div class="form-group">
            <label for="download_url">Locker URL:</label>
            <input type="text" id="download_url" name="download_url" placeholder="Example: <?php echo htmlspecialchars($domain_name); ?>" class="form-control" required>

        </div>
        <input type="submit" name="add_app" class="btn btn-primary" value="Add App">

    </form>

    <!-- Display list of existing apps -->
    <h3>Existing Apps</h3>
    <div class="overflow-auto" style="max-height: 400px; border: 1px solid #ddd; padding: 10px;">
        <table class="table table-bordered">
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
                <?php if (!empty($apps)): ?>
                    <?php foreach ($apps as $app): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($app['id']); ?></td>
                            <td><?php echo htmlspecialchars($app['app_name']); ?></td>
                            <td><?php echo htmlspecialchars($app['platform']); ?></td>
                            <td><img src="<?php echo htmlspecialchars($app['icon_url']); ?>" alt="Icon" style="width: 50px;"></td>
                            <td><a href="<?php echo htmlspecialchars($app['download_url']); ?>" target="_blank">Download</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">No apps found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>



    </div>
 
</body>
</html>

