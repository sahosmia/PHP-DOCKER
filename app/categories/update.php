<?php
require_once '../core.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $errors = [];

    $name = trim($_POST['name']);
    if (empty($name)) {
        $errors['name'] = "Category name is required.";
    }

    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_data'] = $_POST;
        header("Location: edit.php?id=" . $id);
        exit();
    }

    $name = mysqli_real_escape_string($conn, $name);

    $sql = "UPDATE categories SET name = '$name' WHERE id = $id";

    if ($conn->query($sql)) {
        unset($_SESSION['errors']);
        unset($_SESSION['old_data']);
        header("Location: index.php?status=updated");
        exit();
    } else {
        echo "Database Error: " . $conn->error;
    }
}
