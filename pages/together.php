<?php
$sub = $_GET['sub'] ?? 'missionary';
?>

<?php if ($sub === 'missionary'): ?>
    <div class="max-w-7xl mx-auto px-4 py-12 animate-fade-in-up">
        <h2 class="text-3xl font-bold text-center mb-12 font-serif text-charcoal dark:text-white">파송 및 후원선교사</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Placeholder Data -->
            <?php for($i=1; $i<=4; $i++): ?>
            <div class="group relative overflow-hidden rounded-lg shadow-lg aspect-[3/4] bg-gray-200">
                <img src="https://placehold.co/400x500/e2e8f0/1e293b?text=Missionary+<?= $i ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                    <h3 class="text-white text-xl font-bold mb-1">선교사 <?= $i ?></h3>
                    <p class="text-gray-300 text-sm">파송 국가</p>
                </div>
                <div class="absolute bottom-0 left-0 right-0 bg-white/90 dark:bg-gray-800/90 p-4 md:hidden backdrop-blur-sm">
                    <h3 class="text-charcoal dark:text-white font-bold">선교사 <?= $i ?></h3>
                    <p class="text-gray-600 dark:text-gray-300 text-xs">파송 국가</p>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>

<?php elseif ($sub === 'neighbor'): ?>
    <div class="max-w-7xl mx-auto px-4 py-12 animate-fade-in-up">
        <h2 class="text-3xl font-bold text-center mb-12 font-serif text-charcoal dark:text-white">이웃섬김</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <!-- Gallery Placeholders -->
            <?php for($i=1; $i<=6; $i++): ?>
            <div class="relative group overflow-hidden rounded-lg shadow-md aspect-square bg-gray-200 cursor-pointer">
                <img src="https://placehold.co/600x600/e2e8f0/1e293b?text=Serving+<?= $i ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <span class="text-white font-bold text-lg border border-white px-4 py-2 rounded-sm">활동 사진 <?= $i ?></span>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
<?php endif; ?>