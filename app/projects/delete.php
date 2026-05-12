<?php
require_once __DIR__ . '/../core.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);

    $sql = "DELETE FROM projects WHERE id = $id";

    if ($conn->query($sql)) {
        header("Location: index.php?status=deleted");
        exit();
    } else {
        header("Location: index.php?status=error&msg=" . urlencode($conn->error));
        exit();
    }
}
