<?php
$category = $_GET['cat'] ?? 'news'; // news, bulletin, sermon
$id = $_GET['id'] ?? null;

$data = getBoardPost($pdo, $category, $id);
$post = $data['current'];

if (!$post) {
    echo "<div class='text-center py-20'>등록된 게시물이 없습니다.</div>";
    return;
}
?>

<!-- 뷰어 UI -->
<article class="max-w-4xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold mb-4"><?= htmlspecialchars($post['title']) ?></h1>
    <div class="text-sm text-gray-500 mb-8"><?= date('Y.m.d', strtotime($post['published_at'])) ?></div>

    <!-- 설교일 경우 유튜브 출력 -->
    <?php if ($category === 'sermon' && $post['youtube_url']): ?>
        <div class="aspect-video mb-8">
            <iframe src="<?= getYoutubeEmbedUrl($post['youtube_url']) ?>" class="w-full h-full" allowfullscreen></iframe>
        </div>
    <?php endif; ?>

    <!-- 주보일 경우 이미지 리스트 출력 -->
    <?php if ($category === 'bulletin' && $post['image_files']): ?>
        <?php $images = json_decode($post['image_files']); ?>
        <div class="flex flex-col gap-4">
            <?php foreach ($images as $img): ?>
                <img src="/uploads/<?= $img ?>" alt="주보 이미지" class="w-full shadow-lg zoomable-image cursor-zoom-in">
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- 일반 본문 -->
    <div class="prose dark:prose-invert max-w-none mb-12">
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </div>

    <!-- 이전/다음 네비게이션 -->
    <div class="border-t border-gray-200 dark:border-gray-700 pt-6 flex justify-between">
        <div>
            <?php if ($data['prev']): ?>
                <a href="?page=board_view&cat=<?= $category ?>&id=<?= $data['prev']['id'] ?>" class="text-deepblue hover:underline">
                    &larr; 이전: <?= htmlspecialchars($data['prev']['title']) ?>
                </a>
            <?php endif; ?>
        </div>
        <div>
            <?php if ($data['next']): ?>
                <a href="?page=board_view&cat=<?= $category ?>&id=<?= $data['next']['id'] ?>" class="text-deepblue hover:underline">
                    다음: <?= htmlspecialchars($data['next']['title']) ?> &rarr;
                </a>
            <?php endif; ?>
        </div>
    </div>
</article>