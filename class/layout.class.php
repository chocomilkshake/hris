<?php
/**
 * Layout Class
 * --------------------------------------------------
 * Handles reusable UI components:
 * - <head> section
 * - Navbar
 * - Sidebar Menu
 * - Footer scripts
 *
 * NOTE:
 * If a page breaks visually, check:
 * 1. Missing method calls (head, navbar, sideMenu, footer, jScript)
 * 2. Incorrect asset paths
 * 3. JS/CSS not loading (check browser console)
 */
class layout
{

    /**
     * Renders the <head> section of the page
     *
     * @param string $title - Page title suffix
     *
     * DEBUG TIPS:
     * - If CSS/JS not working → check asset paths
     * - If title not changing → ensure $title is passed
     */
    public function head($title)
    {
?>
        <head>
            <!-- Character encoding -->
            <meta charset="utf-8" />

            <!-- Responsive viewport -->
            <meta
                name="viewport"
                content="width=device-width, initial-scale=1.0, user-scalable=no,
                minimum-scale=1.0, maximum-scale=1.0" />

            <!-- Dynamic page title -->
            <title>HRIS - <?php echo $title; ?></title>

            <!-- Page description (optional for SEO) -->
            <meta name="description" content="" />

            <!-- Favicon -->
            <link rel="icon" type="image/x-icon" href="assets/img/favicon/logo.png" />

            <!-- Google Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com" />
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
            <link
                href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
                rel="stylesheet" />

            <!-- Icon fonts -->
            <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

            <!-- Core CSS (DO NOT REMOVE – layout will break) -->
            <link rel="stylesheet" href="assets/vendor/css/core.css" />
            <link rel="stylesheet" href="assets/vendor/css/theme-default.css" />
            <link rel="stylesheet" href="assets/css/demo.css" />

            <!-- Vendor CSS -->
            <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
            <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />

            <!-- Helper JS (required before config.js) -->
            <script src="assets/vendor/js/helpers.js"></script>

            <!-- Theme configuration -->
            <script src="assets/js/config.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        </head>
<?php
    }

    /**
     * Renders the top navigation bar
     *
     * DEBUG TIPS:
     * - Dropdown not opening → check Bootstrap JS
     * - Menu icon not clickable → menu.js missing
     */
    public function navbar()
    {
?>
        <!-- Layout main container -->
        <div class="layout-page">

            <!-- Top Navbar -->
            <nav
                class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached
                align-items-center bg-navbar-theme"
                id="layout-navbar">

                <!-- Mobile menu toggle -->
                <div class="layout-menu-toggle navbar-nav me-3 d-xl-none">
                    <a class="nav-link px-0" href="javascript:void(0)">
                        <i class="bx bx-menu bx-sm"></i>
                    </a>
                </div>

                <!-- Right navbar content -->
                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                    <!-- Search bar -->
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <i class="bx bx-search fs-4"></i>
                            <input
                                type="text"
                                class="form-control border-0 shadow-none"
                                placeholder="Search..."
                                aria-label="Search..." />
                        </div>
                    </div>

                    <!-- User actions -->
                    <ul class="navbar-nav flex-row align-items-center ms-auto">

                        <!-- User dropdown -->
                        <li class="nav-item dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="../assets/img/avatars/1.png" class="rounded-circle" />
                                </div>
                            </a>

                            <!-- Dropdown menu -->
                            <ul class="dropdown-menu dropdown-menu-end">

                                <!-- User info -->
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <img src="../assets/img/avatars/1.png" class="rounded-circle" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <span class="fw-semibold">John Doe</span>
                                                <small class="text-muted">Admin</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li><div class="dropdown-divider"></div></li>

                                <!-- Logout -->
                                <li>
                                    <a class="dropdown-item" href="auth-login-basic.html">
                                        <i class="bx bx-power-off me-2"></i>
                                        Log Out
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <!-- /User -->
                    </ul>
                </div>
            </nav>
            <!-- /Navbar -->
<?php
    }

    /**
     * Sidebar / Left Menu
     *
     * DEBUG TIPS:
     * - Active class controls highlighted menu
     * - Menu toggle issues → check menu.js
     */
    public function sideMenu()
    {
?>
        <!-- Sidebar Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

            <!-- App title -->
            <div class="app-brand demo">
                <h4>CREMPCO HRIS</h4>
            </div>

            <div class="menu-inner-shadow"></div>

            <!-- Menu items -->
            <ul class="menu-inner py-1">

                <!-- Dashboard -->
                <li class="menu-item active">
                    <a href="index.php" class="menu-link">
                        <i class="menu-icon bx bx-home-circle"></i>
                        <div>Dashboard</div>
                    </a>
                </li>

                <!-- Account Settings -->
                <li class="menu-header small text-uppercase">
                    <span>Account Setting</span>
                </li>

                <!-- Menu with sub-items -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon bx bx-dock-top"></i>
                        <div>Accounts</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="accounts.php" class="menu-link">
                                Account
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-header small text-uppercase">
                    <span>201 Record</span>
                </li>

                <!-- Menu with sub-items -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon bx bx-user"></i>
                        <div>Employee Info</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="company.php" class="menu-link">
                                Company
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-header small text-uppercase">
                    <span>Settings</span>
                </li>

                <!-- Menu with sub-items -->
                <li class="menu-item">
                    
                        <li class="menu-item">
                            <a href="company.php" class="menu-link">
                                <i class="menu-icon bx bx-buildings"></i>
                                Satellite Office
                            </a>
                            <a href="company.php" class="menu-link">
                                <i class="menu-icon bx bxs-group"></i>
                                Department
                            </a>
                        </li>
                </li>

            </ul>
        </aside>
        <!-- /Sidebar -->
<?php
    }

    /**
     * scripts
     *
     * DEBUG TIPS:
     * - If dropdowns, charts, or menu fail → check here
     * - JS errors usually originate from missing files below
     */
    public function jScript()
    {
?>
        <!-- Core JS -->
        <script src="assets/vendor/libs/jquery/jquery.js"></script>
        <script src="assets/vendor/libs/popper/popper.js"></script>
        <script src="assets/vendor/js/bootstrap.js"></script>
        <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="assets/vendor/js/menu.js"></script>

        <!-- Vendor JS -->
        <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

        <!-- Main JS -->
        <script src="assets/js/main.js"></script>

        <!-- Page-specific JS -->
        <script src="assets/js/dashboards-analytics.js"></script>

        <!-- Page JS -->
        <script src="assets/js/pages-account-settings-account.js"></script>

        <!-- GitHub Buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
<?php
    }
}
