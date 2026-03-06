<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-charcoal dark:text-white mb-4">섬기는 사람들</h2>
        <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">창대교회를 섬기는 교역자들을 소개합니다.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
        <?php
        $staffs = [
            ['name' => '김은택', 'role' => '담임목사', 'img' => 'https://placehold.co/400x500/1a365d/ffffff?text=Pastor', 'email' => 'sireuntaek@naver.com'],
            ['name' => '이부교', 'role' => '부목사', 'img' => 'https://placehold.co/400x500/e2e8f0/64748b?text=Staff', 'email' => 'staff1@example.com'],
            ['name' => '박전도', 'role' => '전도사', 'img' => 'https://placehold.co/400x500/e2e8f0/64748b?text=Staff', 'email' => 'staff2@example.com'],
            // 필요 시 추가
        ];
        ?>
        <?php foreach ($staffs as $staff): ?>
        <div class="group">
            <div class="aspect-[4/5] w-full overflow-hidden rounded-lg bg-gray-200 dark:bg-gray-700 mb-4">
                <img src="<?= $staff['img'] ?>" alt="<?= $staff['name'] ?>" class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
            </div>
            <h3 class="text-xl font-bold text-charcoal dark:text-white"><?= $staff['name'] ?></h3>
            <p class="text-sm font-medium text-deepblue dark:text-blue-400 mb-1"><?= $staff['role'] ?></p>
            <?php if (!empty($staff['email'])): ?>
            <a href="mailto:<?= $staff['email'] ?>" class="text-sm text-gray-500 hover:text-gray-800 dark:hover:text-gray-300 transition-colors"><?= $staff['email'] ?></a>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>