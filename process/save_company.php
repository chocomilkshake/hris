<?php
// --- Input validation functions ---
include_once 'config.php';
function validateText($data, $maxLen = 100)
{
    $data = trim($data);
    return mb_substr($data, 0, $maxLen); // limit length
}

function validateEmail($data)
{
    return filter_var(trim($data), FILTER_VALIDATE_EMAIL) ?: '';
}

function validatePhone($data)
{
    // keep only digits
    return preg_replace('/\D/', '', $data);
}

// --- Collect and validate inputs ---
$company    = validateText($_POST['company'] ?? '', 150);
$address    = validateText($_POST['address'] ?? '', 150);
$region     = validateText($_POST['region'] ?? '', 150);
$province   = validateText($_POST['province'] ?? '', 150);
$city       = validateText($_POST['city'] ?? '', 150);
$barangay   = validateText($_POST['barangay'] ?? '', 150);



// --- Handle file upload ---
$image_dir = null;
if (isset($_FILES['upload']) && $_FILES['upload']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['upload']['tmp_name'];
    $fileName    = basename($_FILES['upload']['name']);
    $fileSize    = $_FILES['upload']['size'];

    // Strict extension and MIME type check
    $allowedExt   = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $fileType     = mime_content_type($fileTmpPath);

    $allowedMime  = ['image/jpeg', 'image/png', 'image/gif'];

    if (
        in_array($fileExtension, $allowedExt) &&
        in_array($fileType, $allowedMime) &&
        $fileSize <= 5000 * 5000
    ) {

        // Generate safe unique filename
        $newFileName = uniqid("IMG_", true) . '.' . $fileExtension;

        // Main upload folder
        $uploadFolder = __DIR__ . "/../company_logo/";
        if (!is_dir($uploadFolder)) {
            mkdir($uploadFolder, 0777, true);
        }

        // Backup folder
        $backupFolder = __DIR__ . "/../company_logo/backup_uploads/";
        if (!is_dir($backupFolder)) {
            mkdir($backupFolder, 0777, true);
        }

        // Destination path
        $dest_path = $uploadFolder . $newFileName;

        // Move file
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            // Copy to backup folder
            copy($dest_path, $backupFolder . $newFileName);

            // Store relative path (avoid exposing real server path)
            $image_dir = "../company_logo/" . $newFileName;
        } else {
            error_log("Upload failed for file: " . $fileName);
            die("File upload error.");
        }
    } else {
        die("Invalid file type or file too large.");
    }
}

// --- Insert into DB securely ---
$stmt = $con->prepare("INSERT INTO `company`(`name`, `address`, `region`, `province`, `city`, `barangay`, `logo_dir`) 
                            VALUES 
                            (?,?,?,?,?,?,?)");

$stmt->bind_param(
    "sssssss",
    $company,
    $address,
    $region,
    $province,
    $city,
    $barangay,
    $image_dir,
     // trash value (0 = not in trash)
);

if ($stmt->execute()) {
    echo "<script>
                alert('Company created successfully.');
                window.location.href = '../add_company';
         </script>";
} else {
    error_log("DB Error: " . $stmt->error);
    echo "<script>alert('Error creating company. Please try again later.');</script>";
}
