<?php 
require_once __DIR__ . '/includes/header.php';
// Temporarily comment out DB queries until tables are confirmed
?>

<div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">System Dashboard</h1>
        <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">Live Updates</span>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Stats Card -->
        <div class="p-6 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl text-white shadow-blue-200 shadow-lg">
            <p class="text-blue-100 text-sm uppercase font-bold">Total Products</p>
            <h2 class="text-4xl font-black mt-2">0</h2>
        </div>

        <div class="p-6 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl text-white shadow-emerald-200 shadow-lg">
            <p class="text-emerald-100 text-sm uppercase font-bold">Total Suppliers</p>
            <h2 class="text-4xl font-black mt-2">0</h2>
        </div>

        <div class="p-6 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl text-white shadow-orange-200 shadow-lg">
            <p class="text-orange-100 text-sm uppercase font-bold">Low Stock Alert</p>
            <h2 class="text-4xl font-black mt-2">0</h2>
        </div>
    </div>
</div>

<?php 
require_once __DIR__ . '/includes/footer.php';
?>