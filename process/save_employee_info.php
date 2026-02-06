<?php
// =====================================================
// EMPLOYEE INSERT PROCESS (MYSQLI SECURE VERSION)
// =====================================================

// 🔹 Loads DB connection ($con)
require_once 'config.php';

// 🔹 Server upload limits (fallback if php.ini can't be changed)
ini_set('upload_max_filesize', '8M');
ini_set('post_max_size', '9M');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // ==================================================
    // 🔹 SANITIZE FUNCTION (Prevents XSS)
    // ==================================================
    function clean($data) {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    // ==================================================
    // 🔹 COLLECT FORM DATA
    // DEBUG: If values are empty → check input "name" attributes
    // ==================================================
    $first_name   = clean($_POST['first_name'] ?? '');
    $middle_name  = clean($_POST['middle_name'] ?? '');
    $last_name    = clean($_POST['last_name'] ?? '');
    $company      = clean($_POST['company'] ?? '');
    $department   = clean($_POST['department'] ?? '');
    $contract     = clean($_POST['contract_type'] ?? '');
    $satellite    = clean($_POST['satellite'] ?? '');
    $salary_rate  = clean($_POST['salary_rate'] ?? '');
    $allowance     = clean($_POST['allowance'] ?? '');

    // 🔹 Remove non-numbers
    $sss        = preg_replace('/[^0-9]/', '', $_POST['sss'] ?? '');
    $philhealth = preg_replace('/[^0-9]/', '', $_POST['philhealth'] ?? '');
    $pagibig    = preg_replace('/[^0-9]/', '', $_POST['pagibig'] ?? '');

    // ==================================================
    // 🔹 UNIVERSAL UPLOAD FUNCTION
    // DEBUG GUIDE:
    // - "File too large" → size limit exceeded
    // - "Invalid file type" → extension blocked
    // - "Upload failed" → folder permission problem
    // ==================================================
    function uploadFile($file, $folder, $maxSizeMB) {

        // DEBUG: No file uploaded
        if (!isset($file) || $file['error'] !== 0) {
            return null;
        }

        // 🔹 FILE SIZE CHECK
        $maxSize = $maxSizeMB * 1024 * 1024;
        if ($file['size'] > $maxSize) {
            die("DEBUG: '{$file['name']}' exceeds {$maxSizeMB}MB limit.");
        }

        // 🔹 EXTENSION CHECK
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExt)) {
            die("DEBUG: Invalid file type '{$file['name']}'");
        }

        // 🔹 CREATE FOLDER IF NOT EXISTS
        // DEBUG: If upload fails → folder permission issue
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        // 🔹 UNIQUE FILE NAME
        $newName = uniqid('emp_', true) . "." . $ext;
        $fullPath = $folder . $newName;

        // 🔹 MOVE FILE TO SERVER
        if (!move_uploaded_file($file['tmp_name'], $fullPath)) {
            die("DEBUG: Failed moving '{$file['name']}'");
        }

        return $fullPath; // store full directory path in DB
    }

    // ==================================================
    // 🔹 UPLOAD FILES
    // DEBUG: If photo missing → check input name="upload"
    // ==================================================
    $photo    = uploadFile($_FILES['upload'], "employee_photo/", 3); // 3MB
    $psa_file = uploadFile($_FILES['psa_file'], "file_folder/", 5);  // 5MB
    $nbi_file = uploadFile($_FILES['nbi_file'], "file_folder/", 5);  // 5MB
    $medical  = uploadFile($_FILES['medical_file'], "file_folder/", 5); // 5MB

    // ==================================================
    // 🔹 DATABASE INSERT (SQL INJECTION SAFE)
    // DEBUG: If prepare fails → column mismatch or DB issue
    // ==================================================
    $stmt = $con->prepare("INSERT INTO employees 
        (first_name, middle_name, last_name, company, department, contract_type, satellite_office,
         sss_no, philhealth_no, pagibig_no, photo_dir, psa_doc, nbi_doc, medical_doc, salary_rate, allowance)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("DEBUG: Prepare failed → " . $con->error);
    }

    $stmt->bind_param(
        "ssssssssssssssdd",
        $first_name,
        $middle_name,
        $last_name,
        $company,
        $department,
        $contract,
        $satellite,
        $sss,
        $philhealth,
        $pagibig,
        $photo,
        $psa_file,
        $nbi_file,
        $medical,
        $salary_rate,
        $allowance  
    );

    // 🔹 EXECUTE INSERT
    if ($stmt->execute()) {
        echo "<script>
                alert('Employee added successfully.');
                window.location.href = '../employee_info?company_id=" . urlencode($_POST['company']) . "';
              </script>";
    } else {
        // DEBUG: Shows DB error in server logs
        error_log("DB Error: " . $stmt->error);
        echo "<script>alert('Database error. Check logs.');</script>";
    }

    $stmt->close();
    $con->close();
}
?>
