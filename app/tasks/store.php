<?php
require_once '../core.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    $title = trim($_POST['title']);
    if (empty($title)) {
        $errors['title'] = "Task title is required.";
    }

    $project_id = intval($_POST['project_id']);
    if ($project_id <= 0) {
        $errors['project_id'] = "Please select a project.";
    }

    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_data'] = $_POST;
        header("Location: create.php");
        exit();
    }

    $title = mysqli_real_escape_string($conn, $title);
    $category_id = $_POST['category_id'] ? intval($_POST['category_id']) : null;
    $priority = mysqli_real_escape_string($conn, $_POST['priority'] ?? 'medium');
    $status = mysqli_real_escape_string($conn, $_POST['status'] ?? 'todo');
    $due_date = $_POST['due_date'] ? mysqli_real_escape_string($conn, $_POST['due_date']) : null;

    $sql = "INSERT INTO tasks (project_id, category_id, title, priority, status, due_date)
            VALUES ('$project_id', " . ($category_id ? "'$category_id'" : "NULL") . ", '$title', '$priority', '$status', " . ($due_date ? "'$due_date'" : "NULL") . ")";

    if ($conn->query($sql)) {
        unset($_SESSION['errors']);
        unset($_SESSION['old_data']);
        header("Location: index.php?status=success");
        exit();
    } else {
        echo "Database Error: " . $conn->error;
    }
}
