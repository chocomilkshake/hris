<!DOCTYPE html>
<?php
/**
 * --------------------------------------------------
 * Main Dashboard Page
 * --------------------------------------------------
 * This file:
 * - Loads the autoloader
 * - Initializes the layout class
 * - Assembles the page using reusable layout components
 *
 * DEBUG TIPS:
 * - Blank page → check autoloader.php
 * - Layout not rendering → check layout class methods
 */

// Load class autoloader (must exist and be correct)
require_once 'autoloader.php';

// Instantiate layout class
$layout = new layout();
// Page title (passed to <head>)
$title = 'Add Department';
?>

<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="/assets/"
    data-template="vertical-menu-template-free">

<!-- Page HEAD section -->
<!-- If CSS/JS is missing, debug inside layout->head() -->
<?php $layout->head($title); ?>

<body>

    <!-- Layout wrapper (required by Sneat template) -->
    <div class="layout-wrapper layout-content-navbar">

        <!-- Layout container -->
        <div class="layout-container">

            <!-- Sidebar / Menu -->
            <!-- DEBUG: Menu not showing? Check sideMenu() -->
            <?php $layout->sideMenu(); ?>

            <!-- Top Navbar -->
            <!-- DEBUG: Dropdown not working? Check Bootstrap JS -->
            <?php $layout->navbar(); ?>

            <!-- Content wrapper -->
            <div class="content-wrapper">

                <!-- Main page content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <!-- 
            PLACE YOUR PAGE CONTENT HERE

            DEBUG TIPS:
            - Content overflow issues → check container classes
            - Page spacing issues → container-p-y class
          -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4">
                            <span class="text-muted fw-light">Settings /</span> Add Department
                        </h4>

                        <div class="row">
                            <div class="col-md-12">
                                <!-- Navigation Tabs -->
                                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="department">
                                            <i class="bx bx-arrow-back me-1"></i> Back
                                        </a>
                                    </li>
                                </ul>


                                <div class="card mb-4">
                                    <h5 class="card-header">Department Details</h5>
                                    <!-- Account -->
                                    <div class="card-body">
                                        <!-- Account Form -->
                                        <form id="formAccountSettings" method="POST" action="process/save_department.php" enctype="multipart/form-data">
                                            <!-- Profile Photo Upload Section -->


                                            <!-- Form Fields -->
                                            <div class="card-body">
                                                <div class="row">


                                                    <!-- First Name field -->
                                                    <div class="mb-3 col-md-9">
                                                        <label for="department" class="form-label">Department<span class="text-danger">*</span></label>
                                                        <input
                                                            class="form-control"
                                                            type="text"
                                                            id="department"
                                                            name="department"
                                                            placeholder="Department"
                                                            autofocus
                                                            required />
                                                    </div>


                                                </div>

                                                <!-- Save Changes Button -->
                                                <div class="mt-2">
                                                    <button type="submit" class="btn btn-primary me-2">submit</button>
                                                </div>
                                            </div>
                                            <!-- /Account -->
                                        </form>
                                        <!-- / Content -->
                                        <div class="content-backdrop fade"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- / Content wrapper -->

                        <!-- Footer -->
                        <footer class="content-footer footer bg-footer-theme">
                            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">

                                <!-- Copyright -->
                                <div class="mb-2 mb-md-0">
                                    ©
                                    <script>
                                        // Dynamically show current year
                                        document.write(new Date().getFullYear());
                                    </script>
                                    , made with CREMPCO by I.T. Dept.
                                </div>

                                <!-- Optional footer links (currently disabled) -->
                                <!--
          <div>
            <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
            <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>
            <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
               target="_blank" class="footer-link me-4">Documentation</a>
            <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
               target="_blank" class="footer-link me-4">Support</a>
          </div>
          -->

                            </div>
                        </footer>
                        <!-- / Footer -->

                        <!-- Backdrop for modals and menus -->
                        <div class="content-backdrop fade"></div>

                    </div>
                    <!-- / Layout container -->

                </div>
                <!-- / Layout wrapper -->

                <!-- Overlay for mobile menu -->
                <div class="layout-overlay layout-menu-toggle"></div>

                <!-- Footer scripts -->
                <!-- DEBUG: JS errors? Check layout->jScript() -->
                <?php $layout->jScript(); ?>

</body>

</html>