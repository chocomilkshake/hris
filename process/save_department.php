<?php
// =====================================================
// EMPLOYEE INSERT PROCESS (MYSQLI SECURE VERSION)
// Purpose: Insert department with auto-generated code
// =====================================================

// 🔹 Load database connection ($con)
require_once 'config.php';

// 🔹 Ensure script only runs on POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // ==================================================
    // 🔹 SANITIZE FUNCTION
    // Purpose: Prevent XSS by cleaning user input
    // ==================================================
    function clean($data)
    {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    // ==================================================
    // 🔹 AUTO CODE GENERATOR FUNCTION
    // Example:
    //   "Skilled" → SK-001
    //   "Information Tech" → IT-002
    // ==================================================
    function generateCode($con, $name, $table = 'departments', $codeColumn = 'code')
    {
        // 🔹 Step 1: Create prefix from department name
        // Split words and take first letter of each
        $words = preg_split('/\s+/', trim($name));
        $prefix = '';

        foreach ($words as $word) {
            $prefix .= strtoupper($word[0]); // First letter, uppercase
        }

        // 🔹 Step 2: Get the last inserted code with the same prefix
        $stmt = $con->prepare("
            SELECT $codeColumn
            FROM $table
            WHERE $codeColumn LIKE CONCAT(?, '-%')
            ORDER BY $codeColumn DESC
            LIMIT 1
        ");

        $stmt->bind_param("s", $prefix);
        $stmt->execute();
        $result = $stmt->get_result();

        $lastNumber = 0;

        // 🔹 If a previous code exists, extract its numeric part
        if ($row = $result->fetch_assoc()) {
            $lastNumber = (int) substr($row[$codeColumn], -3);
        }

        // 🔹 Step 3: Increment number and format (001, 002, 003…)
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        // 🔹 Final generated code
        return $prefix . '-' . $newNumber;
    }

    // ==================================================
    // 🔹 COLLECT & CLEAN FORM DATA
    // DEBUG TIP:
    // If empty → check form input name="department"
    // ==================================================
    $department = clean($_POST['department'] ?? '');

    // 🔹 Generate department code automatically
    $code = generateCode($con, $department);

    // ==================================================
    // 🔹 DATABASE INSERT (SQL INJECTION SAFE)
    // Inserts department name and generated code
    // ==================================================
    $stmt = $con->prepare("
        INSERT INTO departments (code, department)
        VALUES (?, ?)
    ");

    // 🔹 Check prepare status
    if (!$stmt) {
        die("DEBUG: Prepare failed → " . $con->error);
    }

    // 🔹 Bind parameters
    $stmt->bind_param("ss", $code, $department);

    // ==================================================
    // 🔹 EXECUTE INSERT
    // ==================================================
    if ($stmt->execute()) {

        // ✅ Success feedback
        echo "<script>
                alert('Department added successfully.');
                window.location.href = '../department';
              </script>";

    } else {

        // ❌ Log error for debugging (not shown to user)
        error_log('DB Error: ' . $stmt->error);
        echo "<script>alert('Database error. Check logs.');</script>";
    }

    // 🔹 Clean up resources
    $stmt->close();
    $con->close();
}
