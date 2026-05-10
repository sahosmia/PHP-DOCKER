<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/db.php'; 

require_once __DIR__ . '/src/helpers.php';

define('APP_NAME', 'My CRM');
define('BASE_URL', 'http://localhost/your-project-folder/');