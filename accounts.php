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
$title = 'Dashboard';
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

          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">

              <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                  <a class="nav-link active" href="add_accounts">
                    <i class="bx bx-user me-1"></i> Add Account
                  </a>
                </li>
              </ul>

              <div class="card">
                <h5 class="card-header">Accounts</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="sortableTable">
                    <thead>
                      <tr>
                        <th>#
                          <button class="btn btn-sm p-0 ms-1 sort-btn" onclick="sortTable(0)">
                            <span class="sort-arrow">↕</span>
                          </button>
                        </th>
                        <th>Name
                          <button class="btn btn-sm p-0 ms-1 sort-btn" onclick="sortTable(1)">
                            <span class="sort-arrow">↕</span>
                          </button>
                        </th>
                        <th>Username
                          <button class="btn btn-sm p-0 ms-1 sort-btn" onclick="sortTable(2)">
                            <span class="sort-arrow">↕</span>
                          </button>
                        </th>
                        <th>Account Type
                          <button class="btn btn-sm p-0 ms-1 sort-btn" onclick="sortTable(3)">
                            <span class="sort-arrow">↕</span>
                          </button>
                        </th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php $account->account_table_list($con) ?>
                    </tbody>
                  </table>
                </div>
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