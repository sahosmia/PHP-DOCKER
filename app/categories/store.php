<?php
require_once '../core.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    $name = trim($_POST['name']);
    if (empty($name)) {
        $errors['name'] = "Category name is required.";
    }

    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_data'] = $_POST;
        header("Location: create.php");
        exit();
    }

    $name = mysqli_real_escape_string($conn, $name);

    $sql = "INSERT INTO categories (name) VALUES ('$name')";

    if ($conn->query($sql)) {
        unset($_SESSION['errors']);
        unset($_SESSION['old_data']);
        header("Location: index.php?status=success");
        exit();
    } else {
        echo "Database Error: " . $conn->error;
    }
}
