<?php
// Start output buffering
ob_start();

// Include the database connection
require_once 'config/db_config.php';

// Fetch apps from the database using prepared statements
$sql = "SELECT app_name, platform, icon_url, download_url FROM apps";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// Fetch all apps into an array
$apps = [];
while ($row = $result->fetch_assoc()) {
    $apps[] = $row;
}

// Close the database connection
$conn->close();

// Sort the apps array alphabetically by app_name
usort($apps, function ($a, $b) {
    return strcasecmp($a['app_name'], $b['app_name']);
});

// Check if there's a search query
$searchQuery = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';

// Filter apps based on the search query
if (!empty($searchQuery)) {
    $apps = array_filter($apps, function ($app) use ($searchQuery) {
        return strpos(strtolower($app['app_name']), $searchQuery) !== false;
    });
}

// Check if the request is an AJAX call
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

if ($isAjax) {
    // If it's an AJAX request, only return the app results part
    include 'core/body.php';
    ob_end_flush();
    exit;
}
?>

<?php include 'core/header.php'; ?>

<main class="page-content framework7-root">
    <?php include 'core/body.php'; ?>
</main><!-- Page Content -->

<?php include 'core/footer.php'; ?>

<?php ob_end_flush(); ?>
