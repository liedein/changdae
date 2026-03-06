<?php
$id = $_GET['id'] ?? null;
$category = 'bulletin'; 

// 데이터 가져오기 (functions.php에 정의된 함수 사용)
$data = getBoardPost($pdo, $category, $id);

if (!$data || !$data['current']) {
    echo "<div class='text-center py-20 dark:text-gray-300'>등록된 주보가 없습니다.</div>";
} else {
    $post = $data['current'];
    $prevPost = $data['prev'];
    $nextPost = $data['next'];
?>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 md:p-8 border-b border-gray-200 dark:border-gray-700 text-center">
            <p class="text-sm text-blue-600 dark:text-blue-400 mb-2 font-bold uppercase tracking-widest">Weekly Bulletin</p>
            <h1 class="text-2xl md:text-3xl font-bold text-charcoal dark:text-white mb-3"><?= htmlspecialchars($post['title']) ?></h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                발행일: <?= date('Y년 m월 d일', strtotime($post['published_at'])) ?>
            </p>
        </div>

        <div class="p-4 md:p-6 bg-gray-50 dark:bg-gray-900">
            <?php 
            if (!empty($post['image_files'])):
                $images = json_decode($post['image_files'], true);
                if (is_array($images)):
                    foreach ($images as $image): 
                        // 경로 최적화: uploads 바로 아래 혹은 bulletins 폴더 아래인지 확인
                        $imagePath = (strpos($image, 'bulletins/') === false) ? "bulletins/" . $image : $image;
            ?>
                        <div class="mb-6 last:mb-0">
                            <img src="/uploads/<?= htmlspecialchars($imagePath) ?>" 
                                 alt="주보 이미지" 
                                 class="w-full h-auto shadow-md rounded-sm border border-gray-200 dark:border-gray-700"
                                 loading="lazy">
                        </div>
            <?php 
                    endforeach;
                endif;
            endif; 
            ?>
        </div>
    </div>

    <div class="mt-8 flex justify-between items-center border-t border-gray-200 dark:border-gray-700 pt-8">
        <div class="w-1/2 flex justify-start">
            <?php if ($prevPost): ?>
                <a href="?page=bulletin&id=<?= $prevPost['id'] ?>" class="group flex items-center text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    <div class="flex flex-col items-start">
                        <span class="text-xs text-gray-400">이전 주보</span>
                        <span class="text-sm font-medium hidden sm:block"><?= htmlspecialchars($prevPost['title']) ?></span>
                    </div>
                </a>
            <?php endif; ?>
        </div>
        
        <div class="w-1/2 flex justify-end text-right">
            <?php if ($nextPost): ?>
                <a href="?page=bulletin&id=<?= $nextPost['id'] ?>" class="group flex items-center text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                    <div class="flex flex-col items-end">
                        <span class="text-xs text-gray-400">다음 주보</span>
                        <span class="text-sm font-medium hidden sm:block"><?= htmlspecialchars($nextPost['title']) ?></span>
                    </div>
                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php } ?>