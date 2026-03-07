<?php
/**
 * 목회칼럼 상세 보기 페이지 (column.php)
 */
$id = $_GET['id'] ?? null;
$category = 'column'; 

// 데이터 가져오기 (functions.php의 getBoardPost 함수 사용)
$data = getBoardPost($pdo, $category, $id);

// ID가 없을 경우 최신 칼럼 자동 로드
if (!$id && (!$data || !$data['current'])) {
    $stmt = $pdo->prepare("SELECT id FROM `column` ORDER BY published_at DESC LIMIT 1");
    $stmt->execute();
    $latest = $stmt->fetch();
    if ($latest) {
        $id = $latest['id'];
        $data = getBoardPost($pdo, $category, $id);
    }
}

if (!$data || !$data['current']) {
    echo "<div class='text-center py-20 dark:text-gray-300 font-sans'>등록된 칼럼이 없습니다.</div>";
} else {
    $post = $data['current'];
    $prevPost = $data['prev'];
    $nextPost = $data['next'];
?>

<div class="max-w-3xl mx-auto px-4 py-12 md:py-20">
    <article class="bg-white dark:bg-slate-800 shadow-sm sm:shadow-md sm:rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700">
        
        <header class="p-8 md:p-12 border-b border-slate-100 dark:border-slate-700 text-center">
            <div class="flex justify-center items-center gap-2 mb-6">
                <span class="w-8 h-[1px] bg-slate-300"></span>
                <span class="text-blue-600 dark:text-blue-400 text-xs font-bold tracking-[0.2em] uppercase">Pastor's Column</span>
                <span class="w-8 h-[1px] bg-slate-300"></span>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-800 dark:text-white leading-snug mb-4">
                <?= htmlspecialchars($post['title']) ?>
            </h1>
            <time class="text-slate-400 dark:text-slate-500 text-sm font-medium">
                <?= date('Y년 m월 d일', strtotime($post['published_at'])) ?>
            </time>
        </header>

        <div class="p-8 md:p-12">
            <div class="prose prose-slate dark:prose-invert max-w-none 
                        prose-p:leading-loose prose-p:text-slate-600 dark:prose-p:text-slate-300 
                        prose-p:mb-6 text-base md:text-lg font-serif">
                <?= $post['content'] ?>
            </div>
        </div>
    </article>

    <nav class="mt-10 flex flex-col sm:flex-row gap-4 justify-between items-stretch">
        <div class="flex-1">
            <?php if ($prevPost): ?>
                <a href="?page=column&id=<?= $prevPost['id'] ?>" class="group h-full flex items-center p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:border-blue-500 transition-all shadow-sm">
                    <svg class="w-5 h-5 mr-4 text-slate-400 group-hover:text-blue-500 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <div class="flex flex-col">
                        <span class="text-[10px] text-blue-500 font-bold uppercase mb-1">이전 칼럼</span>
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-300 line-clamp-1"><?= htmlspecialchars($prevPost['title']) ?></span>
                    </div>
                </a>
            <?php endif; ?>
        </div>

        <div class="flex-1">
            <?php if ($nextPost): ?>
                <a href="?page=column&id=<?= $nextPost['id'] ?>" class="group h-full flex items-center justify-between p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:border-blue-500 transition-all shadow-sm text-right">
                    <div class="flex flex-col items-end">
                        <span class="text-[10px] text-blue-500 font-bold uppercase mb-1">다음 칼럼</span>
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-300 line-clamp-1"><?= htmlspecialchars($nextPost['title']) ?></span>
                    </div>
                    <svg class="w-5 h-5 ml-4 text-slate-400 group-hover:text-blue-500 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="mt-12 text-center">
        <a href="?page=column" class="inline-flex items-center px-6 py-2 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-200 rounded-full text-sm font-bold hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">
            전체 칼럼 목록
        </a>
    </div>
</div>
<?php } ?>