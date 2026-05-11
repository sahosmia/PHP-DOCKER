<?php
require_once '../core.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    $name = trim($_POST['name']);
    if (empty($name)) {
        $errors['name'] = "Project name is required.";
    }

    $client_id = intval($_POST['client_id']);
    if ($client_id <= 0) {
        $errors['client_id'] = "Please select a client.";
    }

    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_data'] = $_POST;
        header("Location: create.php");
        exit();
    }

    $name = mysqli_real_escape_string($conn, $name);
    $description = mysqli_real_escape_string($conn, $_POST['description'] ?? '');
    $status = mysqli_real_escape_string($conn, $_POST['status'] ?? 'active');
    $start_date = $_POST['start_date'] ? mysqli_real_escape_string($conn, $_POST['start_date']) : null;
    $end_date = $_POST['end_date'] ? mysqli_real_escape_string($conn, $_POST['end_date']) : null;

    $sql = "INSERT INTO projects (client_id, name, description, status, start_date, end_date)
            VALUES ('$client_id', '$name', '$description', '$status', " . ($start_date ? "'$start_date'" : "NULL") . ", " . ($end_date ? "'$end_date'" : "NULL") . ")";

    if ($conn->query($sql)) {
        unset($_SESSION['errors']);
        unset($_SESSION['old_data']);
        header("Location: index.php?status=success");
        exit();
    } else {
        echo "Database Error: " . $conn->error;
    }
}
