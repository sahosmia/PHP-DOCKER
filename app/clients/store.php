<?php
require_once '../core.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    $name = trim($_POST['name']);
    if (empty($name)) {
        $errors['name'] = "Client name is required.";
    }

    $email = trim($_POST['email']);
    if (empty($email)) {
        $errors['email'] = "Client email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    $phone = trim($_POST['phone']);

    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_data'] = $_POST;
        header("Location: create.php");
        exit();
    }

    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);

    $sql = "INSERT INTO clients (name, email, phone) VALUES ('$name', '$email', '$phone')";

    if ($conn->query($sql)) {
        unset($_SESSION['errors']);
        unset($_SESSION['old_data']);
        header("Location: index.php?status=success");
        exit();
    } else {
        if ($conn->errno == 1062) {
            $_SESSION['errors']['email'] = "Email already exists.";
            $_SESSION['old_data'] = $_POST;
            header("Location: create.php");
            exit();
        }
        echo "Database Error: " . $conn->error;
    }
}
