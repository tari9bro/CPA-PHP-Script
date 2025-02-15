<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Check if the user is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: /../admin/");
    exit;
}
require_once('../../config/index.php');
$currentPage = basename($_SERVER['PHP_SELF']); // Get the current file name
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <link href="/public/css/apps.css" rel="stylesheet"> 
   <!-- css for apps.php-->
    
 <script>   
 function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            sidebar.classList.toggle('collapsed');
        }
      
    </script>
    <style>

*, *:before, *:after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

/* MAIN VARIABLES FOR CUSTOMIZATION */
/* -------------------------------- */
.custom-nav {
  overflow: hidden;
  position: relative;
  left: 50%;
  top: 5%;
  width: auto;
  height: 90px;
  margin-top: -45px;
  background: #fff;
  border-radius: 5px;
  transform: translate3d(-50%, 0, 0);
  box-shadow: 0 10px 35px rgba(0, 0, 0, 0.2);
}
.custom-nav__cb {
  z-index: -1000;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
  pointer-events: none;
}
.custom-nav__content {
  position: relative;
  width: 90px;
  height: 100%;
  transition: width 1s cubic-bezier(0.49, -0.3, 0.68, 1.23);
}
.custom-nav__cb:checked ~ .custom-nav__content {
  transition: width 1s cubic-bezier(0.48, 0.43, 0.29, 1.3);
  width: 410px;
}
.custom-nav__items {
  position: relative;
  width: 410px;
  height: 100%;
  padding-left: 20px;
  padding-right: 110px;
  list-style-type: none;
  font-size: 0;
}
.custom-nav__item {
  display: inline-block;
  vertical-align: top;
  width: 70px;
  text-align: center;
  color: #6C7784;
  font-size: 14px;
  line-height: 90px;
  font-family: Helvetica, Arial, sans-serif;
  font-weight: bold;
  perspective: 1000px;
  transition: color 0.3s;
  cursor: pointer;
}
.custom-nav__item:hover {
  color: #00bdea;
}
.custom-nav__item-text {
  display: block;
  height: 100%;
  transform: rotateY(-70deg);
  opacity: 0;
  transition: transform 0.7s cubic-bezier(0.48, 0.43, 0.7, 2.5), opacity 0.7s;
}
.custom-nav__cb:checked ~ .custom-nav__content .custom-nav__item-text {
  transform: rotateY(0);
  opacity: 1;
  transition: transform 0.7s cubic-bezier(0.48, 0.43, 0.7, 2.5), opacity 0.2s;
}
.custom-nav__item:nth-child(1) .custom-nav__item-text {
  transition-delay: 0.3s;
}
.custom-nav__cb:checked ~ .custom-nav__content .custom-nav__item:nth-child(1) .custom-nav__item-text {
  transition-delay: 0s;
}
.custom-nav__item:nth-child(2) .custom-nav__item-text {
  transition-delay: 0.2s;
}
.custom-nav__cb:checked ~ .custom-nav__content .custom-nav__item:nth-child(2) .custom-nav__item-text {
  transition-delay: 0.1s;
}
.custom-nav__item:nth-child(3) .custom-nav__item-text {
  transition-delay: 0.1s;
}
.custom-nav__cb:checked ~ .custom-nav__content .custom-nav__item:nth-child(3) .custom-nav__item-text {
  transition-delay: 0.2s;
}
.custom-nav__item:nth-child(4) .custom-nav__item-text {
  transition-delay: 0s;
}
.custom-nav__cb:checked ~ .custom-nav__content .custom-nav__item:nth-child(4) .custom-nav__item-text {
  transition-delay: 0.3s;
}
.custom-nav__btn {
  position: absolute;
  right: 0;
  top: 0;
  width: 90px;
  height: 90px;
  padding: 36px 31px;
  cursor: pointer;
}
.custom-nav__btn:before, .custom-nav__btn:after {
  content: "";
  display: block;
  width: 28px;
  height: 4px;
  border-radius: 2px;
  background: #096DD3;
  transform-origin: 50% 50%;
  transition: transform 1s cubic-bezier(0.48, 0.43, 0.29, 1.3), background-color 0.3s;
}
.custom-nav__btn:before {
  margin-bottom: 10px;
}
.custom-nav__btn:hover:before, .custom-nav__btn:hover:after {
  background: #00bdea;
}
.custom-nav__cb:checked ~ .custom-nav__btn:before {
  transform: translateY(7px) rotate(-225deg);
}
.custom-nav__cb:checked ~ .custom-nav__btn:after {
  transform: translateY(-7px) rotate(225deg);
}
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        #sidebar {
            width: 15%; /* 1/5 of the width */
            background:linear-gradient(0deg, #0f0, #07fff400);
            background-color: #343a40;
            color: white;
            transition: width 0.3s, font-size 0.3s;
        }
        #sidebar.collapsed {
            width: 60px;
        }
         #content {
    overflow-y: auto;
    height: calc(100vh - 10px); /* Adjust if needed */
    width: 85%; /* Default width when sidebar is expanded */
    transition: width 0.3s;
}

#sidebar.collapsed + #content {
    width: calc(100% - 60px); /* Adjust for collapsed sidebar width */
}


        
        .sidebar-item {
            padding: 15px;
            cursor: pointer;
            display: block;
            color: white;
            text-decoration: none;
            transition: font-size 0.3s;
        }
        .sidebar-item:hover {
            background-color: #00ffe554;
            color: #00f1ff;
        }
        .sidebar-item.active {
            background-color: #5151516b;
            color: #00f1ff;
        }
        #toggle-sidebar {
            cursor: pointer;
            padding: 10px;
            text-align: center;
            color: white;
        }
        /* Smaller text when sidebar is collapsed */
        #sidebar.collapsed .sidebar-item {
            font-size: 0.7rem; /* Smaller text when collapsed */
            text-align: center;
        }
        #sidebar.collapsed .sidebar-item i {
            font-size: 1.2rem;
        }
        #sidebar .sidebar-item i {
            margin-right: 10px;
        }
        /* Hide the text when collapsed, only show icons */
        #sidebar.collapsed .sidebar-item span {
            display: none;
        }
    </style>
</head>

<body>

<!-- Sidebar -->
<div id="sidebar">
      <div id="toggle-sidebar" onclick="toggleSidebar()">☰</div>
    <a class="sidebar-item <?php echo ($currentPage == 'index.php') ? 'active' : ''; ?>" href="/admin/dashboard/">
        <i class="bi bi-house"></i> <span>Home</span>
    </a>

    <a class="sidebar-item <?php echo ($currentPage == 'apps.php') ? 'active' : ''; ?>" href="/admin/dashboard/apps.php">
        <i class="bi bi-app"></i> <span>Apps</span>
    </a>

    <a class="sidebar-item <?php echo ($currentPage == 'admins.php') ? 'active' : ''; ?>" href="/admin/dashboard/admins.php">
        <i class="bi bi-people"></i> <span>Admins</span>
    </a>

    <a class="sidebar-item <?php echo ($currentPage == 'logout.php') ? 'active' : ''; ?>" href="/admin/dashboard/logout.php">
        <i class="bi bi-box-arrow-right"></i> <span>Logout</span>
    </a>
</div>


    <!-- Main Content -->
   
   <div id="content" >
