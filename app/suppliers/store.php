<?php
require_once __DIR__ . '/../core.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    $name = trim($_POST['name']);
    if (empty($name)) {
        $errors['name'] = "Supplier name is required.";
    }

    $email = trim($_POST['email']);
    if (empty($email)) {
        $errors['email'] = "Supplier email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    $phone = trim($_POST['phone']);
    if (empty($phone)) {
        $errors['phone'] = "Phone number is required.";
    } elseif (!preg_match('/^[0-9+ ]+$/', $phone)) {
        $errors['phone'] = "Phone number is invalid.";
    }

    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_data'] = $_POST;
        header("Location: create.php");
        exit();
    }

    $name = mysqli_real_escape_string($conn, $name);
    $contact = mysqli_real_escape_string($conn, $_POST['contact_person'] ?? '');
    $phone = mysqli_real_escape_string($conn, $phone);
    $email = mysqli_real_escape_string($conn, $email);
    $address = mysqli_real_escape_string($conn, $_POST['address'] ?? '');

    $sql = "INSERT INTO suppliers (name, contact_person, phone, email, address) 
            VALUES ('$name', '$contact', '$phone', '$email', '$address')";

    if ($conn->query($sql)) {
        unset($_SESSION['errors']);
        unset($_SESSION['old_data']);
        header("Location: index.php?status=success");
        exit();
    } else {
        echo "Database Error: " . $conn->error;
    }
}