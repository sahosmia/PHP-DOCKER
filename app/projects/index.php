<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../db.php';

$sql = "SELECT p.*, c.name as client_name
        FROM projects p
        LEFT JOIN clients c ON p.client_id = c.id
        ORDER BY p.id DESC";
$result = $conn->query($sql);
?>

<div class="max-w-6xl mx-auto bg-white p-6 rounded-xl shadow-md border border-gray-100">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Project List</h2>
        <a href="create.php" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
            + Add New Project
        </a>
    </div>

    <?= show_status_message() ?>

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Project Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Timeline</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm font-semibold text-gray-800"><?= htmlspecialchars($row['name']) ?></td>
                            <td class="px-6 py-4 text-sm text-gray-600"><?= htmlspecialchars($row['client_name'] ?? 'N/A') ?></td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <span class="px-2 py-1 rounded text-xs font-bold
                                    <?= $row['status'] == 'active' ? 'bg-green-100 text-green-700' : ($row['status'] == 'completed' ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700') ?>">
                                    <?= strtoupper($row['status']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <?= $row['start_date'] ?: 'N/A' ?> to <?= $row['end_date'] ?: 'N/A' ?>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="edit.php?id=<?= $row['id'] ?>" class="text-blue-500 hover:text-blue-700">
                                        Edit
                                    </a>
                                    <form action="delete.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?')">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                            No projects found. <a href="create.php" class="text-blue-600 underline">Add your first project</a>.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
