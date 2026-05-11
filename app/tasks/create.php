<?php
require_once '../core.php';
require_once '../includes/header.php';

$projects_result = $conn->query("SELECT id, name FROM projects ORDER BY name ASC");
$categories_result = $conn->query("SELECT id, name FROM categories ORDER BY name ASC");
?>

<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Add New Task</h2>
        <a href="index.php" class="text-blue-600 hover:underline text-sm">Back to List</a>
    </div>

    <?php
    $errors = $_SESSION['errors'] ?? [];
    $old = $_SESSION['old_data'] ?? [];
    ?>

    <form action="store.php" method="POST" class="space-y-4">
        <div>
            <label class="block text-sm font-medium">Task Title *</label>
            <input type="text" name="title" value="<?= htmlspecialchars($old['title'] ?? '') ?>"
                class="mt-1 block w-full px-4 py-2 border <?= error_class('title') ?> rounded-md">
            <?= show_error('title') ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Project *</label>
                <select name="project_id" class="mt-1 block w-full px-4 py-2 border <?= error_class('project_id') ?> rounded-md">
                    <option value="">Select Project</option>
                    <?php while ($project = $projects_result->fetch_assoc()): ?>
                        <option value="<?= $project['id'] ?>" <?= ($old['project_id'] ?? '') == $project['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($project['name']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <?= show_error('project_id') ?>
            </div>
            <div>
                <label class="block text-sm font-medium">Category</label>
                <select name="category_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                    <option value="">Select Category</option>
                    <?php while ($category = $categories_result->fetch_assoc()): ?>
                        <option value="<?= $category['id'] ?>" <?= ($old['category_id'] ?? '') == $category['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Priority</label>
                <select name="priority" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                    <option value="low" <?= ($old['priority'] ?? '') == 'low' ? 'selected' : '' ?>>Low</option>
                    <option value="medium" <?= ($old['priority'] ?? 'medium') == 'medium' ? 'selected' : '' ?>>Medium</option>
                    <option value="high" <?= ($old['priority'] ?? '') == 'high' ? 'selected' : '' ?>>High</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium">Status</label>
                <select name="status" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                    <option value="todo" <?= ($old['status'] ?? 'todo') == 'todo' ? 'selected' : '' ?>>Todo</option>
                    <option value="doing" <?= ($old['status'] ?? '') == 'doing' ? 'selected' : '' ?>>Doing</option>
                    <option value="done" <?= ($old['status'] ?? '') == 'done' ? 'selected' : '' ?>>Done</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium">Due Date</label>
            <input type="date" name="due_date" value="<?= htmlspecialchars($old['due_date'] ?? '') ?>"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md font-semibold hover:bg-blue-700 transition">
                Save Task
            </button>
        </div>
    </form>
</div>

<?php
unset($_SESSION['errors'], $_SESSION['old_data']);
require_once '../includes/footer.php';
?>
