<?php
require_once '../core.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    $title = trim($_POST['title']);
    if (empty($title)) {
        $errors['title'] = "Subtask title is required.";
    }

    $task_id = intval($_POST['task_id']);
    if ($task_id <= 0) {
        $errors['task_id'] = "Please select a parent task.";
    }

    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_data'] = $_POST;
        header("Location: create.php");
        exit();
    }

    $title = mysqli_real_escape_string($conn, $title);
    $is_completed = isset($_POST['is_completed']) ? 1 : 0;

    $sql = "INSERT INTO subtasks (task_id, title, is_completed)
            VALUES ('$task_id', '$title', '$is_completed')";

    if ($conn->query($sql)) {
        unset($_SESSION['errors']);
        unset($_SESSION['old_data']);
        header("Location: index.php?status=success&task_id=$task_id");
        exit();
    } else {
        echo "Database Error: " . $conn->error;
    }
}
