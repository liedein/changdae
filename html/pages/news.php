<?php
/**
 * 창대소식 상세 보기 페이지 (news.php)
 */
$id = $_GET['id'] ?? null;
$category = 'news'; 

// 데이터 가져오기 (functions.php의 getBoardPost 함수 사용)
$data = getBoardPost($pdo, $category, $id);

if (!$data || !$data['current']) {
    echo "<div class='text-center py-20 dark:text-gray-300 font-sans'>등록된 소식이 없습니다.</div>";
} else {
    $post = $data['current'];
    $prevPost = $data['prev'];
    $nextPost = $data['next'];
?>

<div class="max-w-3xl mx-auto px-4 py-12 md:py-20">
    <article class="bg-white dark:bg-slate-800 shadow-sm sm:shadow-md sm:rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700">
        
        <header class="p-8 md:p-12 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
            <div class="flex items-center gap-2 mb-4">
                <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-[10px] font-bold uppercase tracking-widest rounded-full">Church News</span>
                <span class="text-slate-400 dark:text-slate-500 text-xs font-medium">|</span>
                <time class="text-slate-500 dark:text-slate-400 text-xs font-medium"><?= date('Y. m. d', strtotime($post['published_at'])) ?></time>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-800 dark:text-white leading-tight mb-0">
                <?= htmlspecialchars($post['title']) ?>
            </h1>
        </header>

        <div class="p-8 md:p-12">
            <?php if (!empty($post['youtube_url'])): ?>
                <div class="mb-10 aspect-video rounded-xl overflow-hidden shadow-lg">
                    <?php 
                        // 유튜브 URL에서 ID 추출 로직
                        $youtube_id = '';
                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $post['youtube_url'], $match)) {
                            $youtube_id = $match[1];
                        }
                    ?>
                    <?php if ($youtube_id): ?>
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/<?= $youtube_id ?>" frameborder="0" allowfullscreen></iframe>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="prose prose-slate dark:prose-invert max-w-none 
                        prose-headings:font-bold prose-p:leading-relaxed prose-p:text-slate-600 dark:prose-p:text-slate-300 
                        text-base md:text-lg">
                <?= $post['content'] ?>
            </div>
        </div>
    </article>

    <nav class="mt-10 flex flex-col sm:flex-row gap-4 justify-between items-stretch">
        <div class="flex-1">
            <?php if ($prevPost): ?>
                <a href="?page=news&id=<?= $prevPost['id'] ?>" class="group h-full flex items-center p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:border-blue-500 transition-all shadow-sm">
                    <svg class="w-5 h-5 mr-4 text-slate-400 group-hover:text-blue-500 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <div class="flex flex-col">
                        <span class="text-[10px] text-blue-500 font-bold uppercase mb-1">이전 소식</span>
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-300 line-clamp-1"><?= htmlspecialchars($prevPost['title']) ?></span>
                    </div>
                </a>
            <?php else: ?>
                <div class="h-full p-5 bg-slate-50 dark:bg-slate-800/30 border border-slate-100 dark:border-slate-700 rounded-xl opacity-50">
                    <span class="text-[10px] text-slate-400 font-bold uppercase">이전 소식이 없습니다</span>
                </div>
            <?php endif; ?>
        </div>

        <div class="flex-1">
            <?php if ($nextPost): ?>
                <a href="?page=news&id=<?= $nextPost['id'] ?>" class="group h-full flex items-center justify-between p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:border-blue-500 transition-all shadow-sm text-right">
                    <div class="flex flex-col items-end">
                        <span class="text-[10px] text-blue-500 font-bold uppercase mb-1">다음 소식</span>
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-300 line-clamp-1"><?= htmlspecialchars($nextPost['title']) ?></span>
                    </div>
                    <svg class="w-5 h-5 ml-4 text-slate-400 group-hover:text-blue-500 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            <?php else: ?>
                <div class="h-full p-5 bg-slate-50 dark:bg-slate-800/30 border border-slate-100 dark:border-slate-700 rounded-xl opacity-50 text-right">
                    <span class="text-[10px] text-slate-400 font-bold uppercase">다음 소식이 없습니다</span>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <div class="mt-12 text-center">
        <a href="?page=news" class="inline-flex items-center px-6 py-2 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-full text-sm font-bold hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            전체 목록 보기
        </a>
    </div>
</div>
<?php } ?>