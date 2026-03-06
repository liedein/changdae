<?php
$id = $_GET['id'] ?? null;
$category = 'bulletin'; // 이 페이지는 주보 전용입니다.

$data = getBoardPost($pdo, $category, $id);

if (!$data || !$data['current']) {
    echo "<div class='text-center py-20'>등록된 주보가 없습니다.</div>";
} else {
    $post = $data['current'];
    $prevPost = $data['prev'];
    $nextPost = $data['next'];
?>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
        <!-- 게시물 헤더 -->
        <div class="p-6 md:p-8 border-b border-gray-200 dark:border-gray-700">
            <p class="text-sm text-deepblue dark:text-blue-400 mb-2 font-medium">주보</p>
            <h1 class="text-2xl md:text-3xl font-bold text-charcoal dark:text-white mb-3 leading-snug"><?= htmlspecialchars($post['title']) ?></h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                게시일: <?= date('Y년 m월 d일', strtotime($post['published_at'])) ?>
            </p>
        </div>

        <!-- 게시물 본문 (이미지) -->
        <div class="p-6 md:p-8">
            <?php 
            if (!empty($post['image_files'])):
                $images = json_decode($post['image_files']);
                if ($images && count($images) > 0):
            ?>
                    <div class="space-y-4">
                        <?php foreach ($images as $image): ?>
                            <img src="/uploads/<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($post['title']) ?> 이미지" class="w-full h-auto object-contain rounded-md border border-gray-200 dark:border-gray-700">
                        <?php endforeach; ?>
                    </div>
            <?php 
                endif;
            endif; 
            ?>
            
            <?php // 주보에 텍스트 내용도 있다면 이미지 하단에 표시 ?>
            <?php if (!empty(strip_tags($post['content']))): ?>
                <div class="prose dark:prose-invert max-w-none mt-8 pt-8 border-t border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 leading-relaxed">
                    <?= $post['content'] ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- 이전/다음 네비게이션 -->
    <div class="mt-10 flex justify-between items-center">
        <div>
            <?php if ($prevPost): ?>
                <a href="?page=bulletin&id=<?= $prevPost['id'] ?>" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    이전 주보
                </a>
            <?php endif; ?>
        </div>
        <div>
            <?php if ($nextPost): ?>
                <a href="?page=bulletin&id=<?= $nextPost['id'] ?>" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    다음 주보
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
}
?>