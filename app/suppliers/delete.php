<?php
require_once __DIR__ . '/../core.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = intval($_POST['id']);

    if ($id > 0) {
        $sql = "DELETE FROM suppliers WHERE id = $id";

        if ($conn->query($sql) && $conn->affected_rows > 0) {
            redirect('index.php', ['status' => "deleted"]);
            exit();
        } else {
            redirect('index.php', ['status' => "not_found"]);
            exit();
        }
    }
}
