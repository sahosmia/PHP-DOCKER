<?php
require_once '../core.php';
require_once '../includes/header.php';

$tasks_result = $conn->query("SELECT id, title FROM tasks ORDER BY id DESC");
$selected_task_id = intval($_GET['task_id'] ?? 0);
?>

<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Add New Subtask</h2>
        <a href="index.php" class="text-blue-600 hover:underline text-sm">Back to List</a>
    </div>

    <?php
    $errors = $_SESSION['errors'] ?? [];
    $old = $_SESSION['old_data'] ?? [];
    ?>

    <form action="store.php" method="POST" class="space-y-4">
        <div>
            <label class="block text-sm font-medium">Subtask Title *</label>
            <input type="text" name="title" value="<?= htmlspecialchars($old['title'] ?? '') ?>"
                class="mt-1 block w-full px-4 py-2 border <?= error_class('title') ?> rounded-md">
            <?= show_error('title') ?>
        </div>

        <div>
            <label class="block text-sm font-medium">Parent Task *</label>
            <select name="task_id" class="mt-1 block w-full px-4 py-2 border <?= error_class('task_id') ?> rounded-md">
                <option value="">Select Task</option>
                <?php while ($task = $tasks_result->fetch_assoc()): ?>
                    <option value="<?= $task['id'] ?>" <?= ($old['task_id'] ?? $selected_task_id) == $task['id'] ? 'selected' : '' ?>>
                        #<?= $task['id'] ?> - <?= htmlspecialchars($task['title']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <?= show_error('task_id') ?>
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="is_completed" id="is_completed" value="1" <?= ($old['is_completed'] ?? '') == '1' ? 'checked' : '' ?> class="h-4 w-4 text-blue-600 border-gray-300 rounded">
            <label for="is_completed" class="ml-2 block text-sm text-gray-900">Completed</label>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md font-semibold hover:bg-blue-700 transition">
                Save Subtask
            </button>
        </div>
    </form>
</div>

<?php
unset($_SESSION['errors'], $_SESSION['old_data']);
require_once '../includes/footer.php';
?>
