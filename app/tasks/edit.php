<?php
require_once '../core.php';

$id = intval($_GET['id'] ?? 0);
$task = null;

if ($id > 0) {
    $sql = "SELECT * FROM tasks WHERE id = $id LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $task = $result->fetch_assoc();
    } else {
        redirect('index.php', ['status' => 'error', 'msg' => 'Task not found!']);
    }
} else {
    redirect('index.php');
}

$projects_result = $conn->query("SELECT id, name FROM projects ORDER BY name ASC");
$categories_result = $conn->query("SELECT id, name FROM categories ORDER BY name ASC");

require_once '../includes/header.php';
?>

<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-100">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Task</h2>
        <a href="index.php" class="text-blue-600 hover:underline text-sm">Back to List</a>
    </div>

    <?php
    $old = $_SESSION['old_data'] ?? [];
    ?>

    <form action="update.php" method="POST" class="space-y-4">
        <input type="hidden" name="id" value="<?= $id ?>">

        <div>
            <label class="block text-sm font-medium">Task Title *</label>
            <input type="text" name="title"
                   value="<?= htmlspecialchars($old['title'] ?? $task['title']) ?>"
                   class="mt-1 block w-full px-4 py-2 border <?= error_class('title') ?> rounded-md">
            <?= show_error('title') ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Project *</label>
                <select name="project_id" class="mt-1 block w-full px-4 py-2 border <?= error_class('project_id') ?> rounded-md">
                    <option value="">Select Project</option>
                    <?php while ($project = $projects_result->fetch_assoc()): ?>
                        <option value="<?= $project['id'] ?>" <?= ($old['project_id'] ?? $task['project_id']) == $project['id'] ? 'selected' : '' ?>>
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
                        <option value="<?= $category['id'] ?>" <?= ($old['category_id'] ?? $task['category_id']) == $category['id'] ? 'selected' : '' ?>>
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
                    <option value="low" <?= ($old['priority'] ?? $task['priority']) == 'low' ? 'selected' : '' ?>>Low</option>
                    <option value="medium" <?= ($old['priority'] ?? $task['priority']) == 'medium' ? 'selected' : '' ?>>Medium</option>
                    <option value="high" <?= ($old['priority'] ?? $task['priority']) == 'high' ? 'selected' : '' ?>>High</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium">Status</label>
                <select name="status" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                    <option value="todo" <?= ($old['status'] ?? $task['status']) == 'todo' ? 'selected' : '' ?>>Todo</option>
                    <option value="doing" <?= ($old['status'] ?? $task['status']) == 'doing' ? 'selected' : '' ?>>Doing</option>
                    <option value="done" <?= ($old['status'] ?? $task['status']) == 'done' ? 'selected' : '' ?>>Done</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium">Due Date</label>
            <input type="date" name="due_date" value="<?= htmlspecialchars($old['due_date'] ?? $task['due_date']) ?>"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md font-semibold hover:bg-blue-700 transition">
                Update Task
            </button>
        </div>
    </form>
</div>

<?php
unset($_SESSION['errors'], $_SESSION['old_data']);
require_once '../includes/footer.php';
?>
