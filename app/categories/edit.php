<?php
require_once __DIR__ . '/../core.php';

$id = intval($_GET['id'] ?? 0);
$category = null;

if ($id > 0) {
    $sql = "SELECT * FROM categories WHERE id = $id LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $category = $result->fetch_assoc();
    } else {
        redirect('index.php', ['status' => 'error', 'msg' => 'Category not found!']);
    }
} else {
    redirect('index.php');
}

require_once __DIR__ . '/../includes/header.php';
?>

<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-100">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Category</h2>
        <a href="index.php" class="text-blue-600 hover:underline text-sm">Back to List</a>
    </div>

    <?php
    $old = $_SESSION['old_data'] ?? [];
    ?>

    <form action="update.php" method="POST" class="space-y-4">
        <input type="hidden" name="id" value="<?= $id ?>">

        <div>
            <label class="block text-sm font-medium">Category Name *</label>
            <input type="text" name="name"
                   value="<?= htmlspecialchars($old['name'] ?? $category['name']) ?>"
                   class="mt-1 block w-full px-4 py-2 border <?= error_class('name') ?> rounded-md">
            <?= show_error('name') ?>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md font-semibold hover:bg-blue-700 transition">
                Update Category
            </button>
        </div>
    </form>
</div>

<?php
unset($_SESSION['errors'], $_SESSION['old_data']);
require_once __DIR__ . '/../includes/footer.php';
?>
