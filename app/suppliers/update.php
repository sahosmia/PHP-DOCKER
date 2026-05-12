<?php
require_once __DIR__ . '/../core.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $id = intval($_POST['id']);

    $name = trim($_POST['name']);
    if (empty($name)) $errors['name'] = "Name is required.";

    $email = trim($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = "Valid email required.";

    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_data'] = $_POST;
        redirect("edit.php", ['id' => $id]);
    }

    $name = mysqli_real_escape_string($conn, $name);
    $contact = mysqli_real_escape_string($conn, $_POST['contact_person']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $email);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $sql = "UPDATE suppliers SET 
            name = '$name', 
            contact_person = '$contact', 
            phone = '$phone', 
            email = '$email', 
            address = '$address' 
            WHERE id = $id";

    if ($conn->query($sql)) {
        redirect('index.php', ['status' => 'updated']);
    } else {
        echo "Error updating record: " . $conn->error;
    }
}