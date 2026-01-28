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
$title = 'Employee Info';
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
                  <a class="nav-link active" href="add_employee_info">
                    <i class="bx bx-user me-1"></i> Add Employee Info
                  </a>
                </li>
              </ul>

              <!-- Responsive Table -->
              <div class="card">
                <h5 class="card-header">Company List</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr class="text-nowrap">
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Satellite</th>
                        <th>Position</th>
                        <th>Contract</th>
                        <th>Payroll Frequency</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        
                        <td scope="row">1</td>
                        <td><img src="" alt=""> 2x2 </td>
                        <td>Employee Name</td>
                        <td>Manila</td>
                        <td>Office Staff</td>
                        <td>TEC</td>
                        <td>Monthly</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="employee_info.php"><i class="bx bx-edit-alt me-1"></i> View</a>
                              <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Responsive Table -->


            </div>
            <!-- / Content wrapper -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">

                <!-- Copyright -->
                <div class="mb-2 mb-md-0">

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