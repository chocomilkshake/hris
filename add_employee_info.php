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
$title = 'Employee Information';
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
              <span class="text-muted fw-light">Employee /</span> Add Employee Information
            </h4>

            <div class="row">
              <div class="col-md-12">
                <!-- Navigation Tabs -->
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                  <li class="nav-item">
                    <a class="nav-link active" href="employee_info">
                      <i class="bx bx-arrow-back me-1"></i> Back
                    </a>
                  </li>
                </ul>


                <div class="card mb-4">
                  <h5 class="card-header">Profile Details</h5>
                  <!-- Account -->
                  <div class="card-body">
                    <!-- Account Form -->
                    <form id="formAccountSettings" method="POST" action="process/save_employee_info.php" enctype="multipart/form-data">

                      <!-- Profile Photo Upload Section -->
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <!-- Default Avatar -->
                        <img
                          src="assets/img/avatars/default.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar" />

                        <div class="button-wrapper">
                          <!-- Upload new profile photo -->
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="upload"
                              name="upload"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpeg"
                              required />
                          </label>

                          <!-- Reset profile photo to default -->
                          <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                          </button>

                          <!-- Allowed file formats note -->
                          <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                        </div>
                      </div>
                  </div>
                  <hr class="my-0" />

                  <!-- Form Fields -->
                  <div class="card-body">
                    <div class="row">
                      <!-- Username field -->
                      <div class="mb-3 col-md-6">
                        <label for="id-number" class="form-label">ID Number</label>
                        <input
                          class="form-control"
                          type="text"
                          id="id-number"
                          name="id-number"
                          placeholder="Id Number"
                          autofocus
                          readonly />
                      </div>

                      <!-- First Name field -->
                      <div class="mb-3 col-md-6">
                        <label for="first-name" class="form-label">First Name<span class="text-danger">*</span></label>
                        <input
                          class="form-control"
                          type="text"
                          id="first-name"
                          name="first-name"
                          placeholder="first Name"
                          autofocus
                          required />
                      </div>

                      <!-- Middle Name field -->
                      <div class="mb-3 col-md-6">
                        <label for="middle-name" class="form-label">Middle Name</label>
                        <input
                          class="form-control"
                          type="text"
                          id="middle-name"
                          name="middle-name"
                          placeholder="Middle Name" />
                      </div>

                      <!-- Last Name field -->
                      <div class="mb-3 col-md-6">
                        <label for="last-name" class="form-label">Last Name<span class="text-danger">*</span></label>
                        <input
                          class="form-control"
                          type="text"
                          name="last-name"
                          id="last-name"
                          placeholder="Last Name"
                          required />
                      </div>

                      <!-- Department dropdown -->
                      <div class="mb-3 col-md-6">
                        <label for="department" class="form-label">Department<span class="text-danger">*</span></label>
                        <select id="department" name="department" class="select2 form-select" required>
                          <option value="">Select Department</option>
                          <option value="admin">HSW</option>
                          <option value="encoder">Skilled</option>
                        </select>
                      </div>

                      <!-- Type of Contract dropdown -->
                      <div class="mb-3 col-md-6">
                        <label for="contract-type" class="form-label">Contract Type<span class="text-danger">*</span></label>
                        <select id="contract-type" name="contract-type" class="select2 form-select" required>
                          <option value="">Select Contract Type</option>
                          <option value="admin">Training</option>
                          <option value="encoder">On Call</option>
                          <option value="">TEC</option>
                          <option value="">Provisionary</option>
                          <option value="">Regular</option>
                        </select>
                      </div>

                      <!-- Satellite Office dropdown -->
                      <div class="mb-3 col-md-6">
                        <label for="satellite" class="form-label">Satellite Office<span class="text-danger">*</span></label>
                        <select id="satellite" name="satellite" class="select2 form-select" required>
                          <option value="">Select Satellite Office</option>
                          <?php
                          // Populate satellite options from database
                          $getData = new get_data();
                          $getData->satellite($con); 
                          ?>
                        </select>
                      </div>

                      <!-- SSS No. field -->
                      <div class="mb-3 col-md-6">
                        <label for="sss" class="form-label">SSS Number<span class="text-danger">*</span></label>
                        <input
                          class="form-control"
                          type="text"
                          name="sss"
                          id="sss"
                          placeholder="SSS Number"
                          required />
                      </div>

                      <!-- PhilHealth No. field -->
                      <div class="mb-3 col-md-6">
                        <label for="philhealth" class="form-label">PhilHealth<span class="text-danger">*</span></label>
                        <input
                          class="form-control"
                          type="text"
                          name="philhealth"
                          id="philhealth"
                          placeholder="PhilHealth Number"
                          required />
                      </div>

                      <!-- Pag-Ibig N field -->
                      <div class="mb-3 col-md-6">
                        <label for="pagibig" class="form-label">Pag-Ibig<span class="text-danger">*</span></label>
                        <input
                          class="form-control"
                          type="text"
                          name="pagibig"
                          id="pagibig"
                          placeholder="Pag-Ibig Number"
                          required />
                      </div>

                      <div class="mb-3">
                        <label for="formFile" class="form-label">PSA Birth Certificate</label>
                        <input class="form-control" type="file" id="formFile" name="psa_file" />
                      </div>

                      <div class="mb-3">
                        <label for="formFile" class="form-label">NBI Clearance</label>
                        <input class="form-control" type="file" id="formFile" name="nbi_file" />
                      </div>

                      <div class="mb-3">
                        <label for="formFile" class="form-label">Medical Exam Document</label>
                        <input class="form-control" type="file" id="formFile" name="medical_file" />
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