<?php

session_start();

// Redirect if not logged in
/**if (!isset($_SESSION['user_id'])) {
    header("Location: index");
    exit;
}**/

// Autoloader
spl_autoload_register(function ($className) {
    $file = __DIR__ . '/class/' . $className . '.class.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// DB config
include 'process/config.php';
