<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../src/helpers.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex">

    <!-- Include Sidebar -->
    <?php include_once 'sidebar.php'; ?>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-h-screen overflow-x-hidden">

        <!-- Top Bar -->
        <header class="bg-white shadow-sm py-4 px-8 flex justify-between items-center sticky top-0 z-10">
            <h2 class="text-xl font-semibold text-gray-700">Admin Dashboard</h2>
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">A</div>
                <span class="text-sm font-medium text-gray-600">Admin User</span>
            </div>
        </header>

        <!-- Content Area -->
        <div class="p-8">