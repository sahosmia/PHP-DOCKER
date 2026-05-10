<?php require_once '../includes/header.php'; ?>

<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Add New Supplier</h2>
        <a href="index.php" class="text-blue-600 hover:underline text-sm">Back to List</a>
    </div>

    <?php
    $errors = $_SESSION['errors'] ?? [];
    $old = $_SESSION['old_data'] ?? [];
    ?>

    <form action="store.php" method="POST" class="space-y-4">
        <div>
            <label class="block text-sm font-medium">Supplier Name *</label>
            <input type="text" name="name" value="<?= $old['name'] ?? '' ?>"
                class="mt-1 block w-full px-4 py-2 border <?= error_class('name') ?> rounded-md">

            <?= show_error('name') ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Contact Person</label>
                <input type="text" name="contact_person" value="<?= $old['contact_person'] ?? '' ?>"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">Phone Number</label>
                <input type="text" name="phone" value="<?= $old['phone'] ?? '' ?>"
                    class="mt-1 block w-full px-4 py-2 border <?= error_class('phone') ?> rounded-md">

                <?= show_error('phone') ?>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium">Email Address</label>
            <input type="email" name="email" value="<?= $old['email'] ?? '' ?>"
                class="mt-1 block w-full px-4 py-2 border <?= error_class('email') ?> rounded-md">

            <?= show_error('email') ?>
        </div>

        <div>
            <label class="block text-sm font-medium">Address</label>
            <textarea name="address" rows="3" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md"><?= $old['address'] ?? '' ?></textarea>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md font-semibold hover:bg-blue-700 transition">
                Save Supplier
            </button>
        </div>
    </form>
</div>

<?php
unset($_SESSION['errors'], $_SESSION['old_data']);
?>

<?php require_once '../includes/footer.php'; ?>