<?php
$sub = $_GET['sub'] ?? 'missionary';
?>

<?php if ($sub === 'missionary'): ?>
<!-- 파송 및 후원선교사 -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-charcoal dark:text-white mb-4">파송 및 후원선교사</h2>
        <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            땅 끝까지 이르러 내 증인이 되리라 하신 주님의 지상명령을 따라<br>
            창대교회가 함께 동역하며 후원하는 선교사님들입니다.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
        <?php
        $missionaries = [
            ['name' => '김바울 선교사', 'country' => 'A국', 'org' => 'GMS', 'img' => 'https://placehold.co/400x500/1a365d/ffffff?text=Missionary'],
            ['name' => '이디모데 선교사', 'country' => 'B국', 'org' => 'OMF', 'img' => 'https://placehold.co/400x500/1a365d/ffffff?text=Missionary'],
            ['name' => '박에스더 선교사', 'country' => 'C국', 'org' => '인터콥', 'img' => 'https://placehold.co/400x500/1a365d/ffffff?text=Missionary'],
            ['name' => '최요한 선교사', 'country' => 'D국', 'org' => '두란노', 'img' => 'https://placehold.co/400x500/1a365d/ffffff?text=Missionary'],
        ];
        ?>
        <?php foreach ($missionaries as $missionary): ?>
        <div class="group">
            <div class="aspect-[4/5] w-full overflow-hidden rounded-lg bg-gray-200 dark:bg-gray-700 mb-4 relative">
                <img src="<?= $missionary['img'] ?>" alt="<?= $missionary['name'] ?>" class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                <!-- 국가/지역 뱃지 -->
                <div class="absolute top-4 left-4 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-deepblue dark:text-blue-400 shadow-sm">
                    <?= $missionary['country'] ?>
                </div>
            </div>
            <h3 class="text-xl font-bold text-charcoal dark:text-white"><?= $missionary['name'] ?></h3>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1"><?= $missionary['org'] ?></p>
            <div class="mt-2">
                <button class="text-sm text-deepblue dark:text-blue-400 font-medium hover:underline">기도편지 보기 &rarr;</button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php elseif ($sub === 'neighbor'): ?>
<!-- 이웃섬김 -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-charcoal dark:text-white mb-4">이웃섬김</h2>
        <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            지역 사회와 함께하는 창대교회의 나눔 사역입니다.
        </p>
    </div>
    <div class="text-center py-10 bg-gray-50 dark:bg-gray-800 rounded-lg">
        <p class="text-gray-500">준비 중인 페이지입니다.</p>
    </div>
</div>

<?php else: ?>
<!-- 기본 페이지 -->
<div class="max-w-7xl mx-auto px-4 py-20 text-center">
    <h2 class="text-2xl font-bold mb-4">준비 중입니다</h2>
    <p class="text-gray-600">해당 페이지를 준비하고 있습니다.</p>
</div>

<?php endif; ?>