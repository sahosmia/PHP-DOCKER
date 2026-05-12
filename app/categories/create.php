<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Add New Category</h2>
        <a href="index.php" class="text-blue-600 hover:underline text-sm">Back to List</a>
    </div>

    <?php
    $errors = $_SESSION['errors'] ?? [];
    $old = $_SESSION['old_data'] ?? [];
    ?>

    <form action="store.php" method="POST" class="space-y-4">
        <div>
            <label class="block text-sm font-medium">Category Name *</label>
            <input type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>"
                class="mt-1 block w-full px-4 py-2 border <?= error_class('name') ?> rounded-md">
            <?= show_error('name') ?>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md font-semibold hover:bg-blue-700 transition">
                Save Category
            </button>
        </div>
    </form>
</div>

<?php
unset($_SESSION['errors'], $_SESSION['old_data']);
?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
