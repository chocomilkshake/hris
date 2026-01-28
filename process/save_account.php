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
$account_type = validateText($_POST['account_type'] ?? '', 20);
$username     = validateText($_POST['username'] ?? '', 50);
$password     = $_POST['password'] ?? '';
$first_name   = validateText($_POST['firstName'] ?? '', 50);
$last_name    = validateText($_POST['lastName'] ?? '', 50);
$branch      = validateText($_POST['branch'] ?? '', 150);


// --- Secure password hash ---
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

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
        $fileSize <= 800 * 1024
    ) {

        // Generate safe unique filename
        $newFileName = uniqid("IMG_", true) . '.' . $fileExtension;

        // Main upload folder
        $uploadFolder = __DIR__ . "/../img/avatars/";
        if (!is_dir($uploadFolder)) {
            mkdir($uploadFolder, 0777, true);
        }

        // Backup folder
        $backupFolder = __DIR__ . "/../img/backup_uploads/";
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
            $image_dir = "assets/img/avatars/" . $newFileName;
        } else {
            error_log("Upload failed for file: " . $fileName);
            die("File upload error.");
        }
    } else {
        die("Invalid file type or file too large.");
    }
}

// --- Insert into DB securely ---
$stmt = $con->prepare("INSERT INTO `account`(`account_type`, `username`, `password`, `first_name`, `last_name`, `satellite`, `image_dir`) 
                            VALUES 
                            (?,?,?,?,?,?,?)");

$stmt->bind_param(
    "sssssss",
    $account_type,
    $username,
    $hashedPassword,
    $first_name,
    $last_name,
    $branch,
    $image_dir
);

if ($stmt->execute()) {
    echo "<script>
                alert('Account created successfully.');
                window.location.href = '../add_ac  counts';
         </script>";
} else {
    error_log("DB Error: " . $stmt->error);
    echo "<script>alert('Error creating account. Please try again later.');</script>";
}
