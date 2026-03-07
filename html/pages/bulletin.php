<?php
$id = $_GET['id'] ?? null;
$category = 'bulletin'; 

// 데이터 가져오기
$data = getBoardPost($pdo, $category, $id);

if (!$data || !$data['current']) {
    echo "<div class='text-center py-20 dark:text-gray-300 font-sans'>등록된 주보가 없습니다.</div>";
} else {
    $post = $data['current'];
    $prevPost = $data['prev'];
    $nextPost = $data['next'];
?>

<div class="max-w-4xl mx-auto py-0 sm:py-12">
    <div class="bg-white dark:bg-gray-800 shadow-none sm:shadow-lg sm:rounded-lg overflow-hidden border-b sm:border border-gray-200 dark:border-gray-700">
        <div class="p-6 md:p-8 text-center bg-white dark:bg-gray-800">
            <p class="text-xs text-blue-600 dark:text-blue-400 mb-2 font-bold uppercase tracking-widest">Weekly Bulletin</p>
            <h1 class="text-xl md:text-3xl font-bold text-slate-800 dark:text-white mb-2"><?= htmlspecialchars($post['title']) ?></h1>
            <p class="text-xs text-slate-500 dark:text-slate-400">
                발행일: <?= date('Y년 m월 d일', strtotime($post['published_at'])) ?>
            </p>
        </div>

        <div class="p-0 bg-slate-100 dark:bg-gray-900 flex flex-col">
            <?php 
            if (!empty($post['image_files'])):
                $images = json_decode($post['image_files'], true);
                if (is_array($images)):
                    foreach ($images as $image): 
                        $imagePath = (strpos($image, 'bulletins/') === false) ? "bulletins/" . $image : $image;
            ?>
                        <div class="w-full m-0 p-0 leading-[0] overflow-hidden">
                            <img src="/uploads/<?= htmlspecialchars($imagePath) ?>" 
                                 alt="주보 이미지" 
                                 class="w-full h-auto block border-none shadow-none" 
                                 loading="lazy">
                        </div>
            <?php 
                    endforeach;
                endif;
            endif; 
            ?>
        </div>
    </div>

    <div class="mt-8 px-4 sm:px-0 flex justify-between items-center border-t border-gray-200 dark:border-gray-700 pt-8 pb-12">
        <div class="w-1/2 flex justify-start">
            <?php if ($prevPost): ?>
                <a href="?page=bulletin&id=<?= $prevPost['id'] ?>" class="group flex items-center text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    <div class="flex flex-col items-start">
                        <div class="flex flex-col items-start">
                            <span class="text-[10px] text-blue-500 font-bold mb-1">이전 주보</span>
                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-300"><?= htmlspecialchars($prevPost['title']) ?></span>
                        </div>
                    </div>
                </a>
            <?php endif; ?>
        </div>
        
        <div class="w-1/2 flex justify-end text-right">
            <?php if ($nextPost): ?>
                <a href="?page=bulletin&id=<?= $nextPost['id'] ?>" class="group flex items-center text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                    <div class="flex flex-col items-end">
                        <span class="text-[10px] text-gray-400 uppercase">Next</span>
                        <span class="text-sm font-medium hidden sm:block"><?= htmlspecialchars($nextPost['title']) ?></span>
                    </div>
                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php } ?>