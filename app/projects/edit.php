<?php
require_once '../core.php';

$id = intval($_GET['id'] ?? 0);
$project = null;

if ($id > 0) {
    $sql = "SELECT * FROM projects WHERE id = $id LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $project = $result->fetch_assoc();
    } else {
        redirect('index.php', ['status' => 'error', 'msg' => 'Project not found!']);
    }
} else {
    redirect('index.php');
}

$clients_result = $conn->query("SELECT id, name FROM clients ORDER BY name ASC");

require_once '../includes/header.php';
?>

<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-100">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Project</h2>
        <a href="index.php" class="text-blue-600 hover:underline text-sm">Back to List</a>
    </div>

    <?php
    $old = $_SESSION['old_data'] ?? [];
    ?>

    <form action="update.php" method="POST" class="space-y-4">
        <input type="hidden" name="id" value="<?= $id ?>">

        <div>
            <label class="block text-sm font-medium">Project Name *</label>
            <input type="text" name="name"
                   value="<?= htmlspecialchars($old['name'] ?? $project['name']) ?>"
                   class="mt-1 block w-full px-4 py-2 border <?= error_class('name') ?> rounded-md">
            <?= show_error('name') ?>
        </div>

        <div>
            <label class="block text-sm font-medium">Client *</label>
            <select name="client_id" class="mt-1 block w-full px-4 py-2 border <?= error_class('client_id') ?> rounded-md">
                <option value="">Select Client</option>
                <?php while ($client = $clients_result->fetch_assoc()): ?>
                    <option value="<?= $client['id'] ?>" <?= ($old['client_id'] ?? $project['client_id']) == $client['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($client['name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <?= show_error('client_id') ?>
        </div>

        <div>
            <label class="block text-sm font-medium">Description</label>
            <textarea name="description" rows="3" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md"><?= htmlspecialchars($old['description'] ?? $project['description']) ?></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Status</label>
                <select name="status" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                    <option value="active" <?= ($old['status'] ?? $project['status']) == 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="completed" <?= ($old['status'] ?? $project['status']) == 'completed' ? 'selected' : '' ?>>Completed</option>
                    <option value="on_hold" <?= ($old['status'] ?? $project['status']) == 'on_hold' ? 'selected' : '' ?>>On Hold</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Start Date</label>
                <input type="date" name="start_date" value="<?= htmlspecialchars($old['start_date'] ?? $project['start_date']) ?>"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">End Date</label>
                <input type="date" name="end_date" value="<?= htmlspecialchars($old['end_date'] ?? $project['end_date']) ?>"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md font-semibold hover:bg-blue-700 transition">
                Update Project
            </button>
        </div>
    </form>
</div>

<?php
unset($_SESSION['errors'], $_SESSION['old_data']);
require_once '../includes/footer.php';
?>
