<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-charcoal dark:text-white mb-4">목장</h2>
        <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            창대교회의 소그룹 공동체인 목장을 소개합니다.<br>
            목장은 성도들이 삶을 나누고 함께 기도하며 사랑을 실천하는 가족 공동체입니다.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
        <?php
        $cells = [
            ['name' => '온유목장', 'leader' => '김철수 목자', 'desc' => '매주 금요일 저녁 8시', 'img' => 'https://placehold.co/400x300/f3f4f6/9ca3af?text=Cell+Group'],
            ['name' => '화평목장', 'leader' => '이영희 목자', 'desc' => '매주 토요일 오후 5시', 'img' => 'https://placehold.co/400x300/f3f4f6/9ca3af?text=Cell+Group'],
            ['name' => '충성목장', 'leader' => '박민수 목자', 'desc' => '매주 주일 오후 2시', 'img' => 'https://placehold.co/400x300/f3f4f6/9ca3af?text=Cell+Group'],
            ['name' => '사랑목장', 'leader' => '최지혜 목자', 'desc' => '매주 목요일 오전 11시', 'img' => 'https://placehold.co/400x300/f3f4f6/9ca3af?text=Cell+Group'],
            ['name' => '기쁨목장', 'leader' => '정다윗 목자', 'desc' => '매주 금요일 저녁 9시', 'img' => 'https://placehold.co/400x300/f3f4f6/9ca3af?text=Cell+Group'],
        ];
        ?>
        <?php foreach ($cells as $cell): ?>
        <div class="group bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden border border-gray-100 dark:border-gray-700">
            <div class="aspect-video w-full overflow-hidden bg-gray-200 dark:bg-gray-700">
                <img src="<?= $cell['img'] ?>" alt="<?= $cell['name'] ?>" class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-charcoal dark:text-white mb-1"><?= $cell['name'] ?></h3>
                <p class="text-deepblue dark:text-blue-400 font-medium mb-3"><?= $cell['leader'] ?></p>
                <p class="text-sm text-gray-500 dark:text-gray-400"><?= $cell['desc'] ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>