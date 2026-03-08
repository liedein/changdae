<?php
/**
 * 주일예배 상세 보기 페이지 (worship.php)
 */
$id = $_GET['id'] ?? null;
$category = 'sermon'; // DB 테이블명: sermon

// 데이터 가져오기 (functions.php의 getBoardPost 함수 사용)
$data = getBoardPost($pdo, $category, $id);

// ID가 없을 경우 최신 설교 자동 로드
if (!$id && (!$data || !$data['current'])) {
    $stmt = $pdo->prepare("SELECT id FROM sermon ORDER BY published_at DESC LIMIT 1");
    $stmt->execute();
    $latest = $stmt->fetch();
    if ($latest) {
        $id = $latest['id'];
        $data = getBoardPost($pdo, $category, $id);
    }
}

if (!$data || !$data['current']) {
    echo "<div class='text-center py-20 dark:text-gray-300 font-sans'>등록된 예배 영상이 없습니다.</div>";
} else {
    $post = $data['current'];
    $prevPost = $data['prev'];
    $nextPost = $data['next'];

    // 유튜브 ID 추출 로직
    $youtube_id = '';
    if (!empty($post['youtube_url'])) {
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $post['youtube_url'], $match)) {
            $youtube_id = $match[1];
        }
    }
?>

<div class="max-w-5xl mx-auto px-4 py-12 md:py-20">
    <div class="text-center mb-10">
        <span class="inline-block px-4 py-1.5 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-xs font-bold uppercase tracking-[0.2em] rounded-full mb-6 shadow-sm border border-red-100 dark:border-red-800">Sunday Worship Service</span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white leading-tight mb-6">
            <?= htmlspecialchars($post['title']) ?>
        </h1>
        
        <div class="inline-flex flex-wrap justify-center items-center gap-4 md:gap-8 bg-slate-50 dark:bg-slate-800/50 p-4 md:p-6 rounded-2xl border border-slate-100 dark:border-slate-700">
            <div class="flex items-center gap-2">
                <span class="text-slate-400 dark:text-slate-500 font-medium text-sm">본문</span>
                <span class="text-slate-800 dark:text-white font-bold text-base md:text-lg"><?= htmlspecialchars($post['passage']) ?></span>
            </div>
            <div class="hidden md:block w-px h-4 bg-slate-200 dark:bg-slate-600"></div>
            <div class="flex items-center gap-2">
                <span class="text-slate-400 dark:text-slate-500 font-medium text-sm">설교</span>
                <span class="text-slate-800 dark:text-white font-bold text-base md:text-lg"><?= htmlspecialchars($post['preacher']) ?></span>
            </div>
            <div class="hidden md:block w-px h-4 bg-slate-200 dark:bg-slate-600"></div>
            <div class="flex items-center gap-2">
                <span class="text-slate-400 dark:text-slate-500 font-medium text-sm">날짜</span>
                <span class="text-slate-800 dark:text-white font-bold text-base md:text-lg"><?= date('Y. m. d', strtotime($post['published_at'])) ?></span>
            </div>
        </div>
    </div>

    <div class="mb-16 relative group">
        <div class="absolute -inset-1 bg-gradient-to-r from-red-600 to-red-400 rounded-3xl blur opacity-25 group-hover:opacity-40 transition duration-1000 group-hover:duration-200"></div>
        <div class="relative aspect-video rounded-2xl overflow-hidden shadow-2xl bg-black border border-slate-200 dark:border-slate-700">
            <?php if ($youtube_id): ?>
                <iframe class="w-full h-full" src="https://www.youtube.com/embed/<?= $youtube_id ?>?rel=0&modestbranding=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <?php else: ?>
                <div class="w-full h-full flex flex-col items-center justify-center text-slate-500">
                    <svg class="w-16 h-16 mb-4 opacity-20" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
                    <span>등록된 영상 주소가 없습니다.</span>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <nav class="flex flex-col sm:flex-row gap-4 justify-between items-center border-t border-slate-100 dark:border-slate-800 pt-12">
        
        <div class="w-full sm:w-auto flex justify-start">
            <?php if ($prevPost): ?>
                <a href="?page=worship&id=<?= $prevPost['id'] ?>" class="group flex items-center p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl hover:border-red-500 transition-all shadow-sm max-w-xs md:max-w-md">
                    <svg class="w-6 h-6 mr-4 text-slate-300 group-hover:text-red-500 transform group-hover:-translate-x-1 transition-transform shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <div class="flex flex-col overflow-hidden">
                        <span class="text-xs text-red-500 font-bold uppercase mb-1">
                            <?= isset($prevPost['published_at']) ? date('Y. m. d', strtotime($prevPost['published_at'])) : '' ?>
                        </span>
                        <span class="text-base font-bold text-slate-700 dark:text-slate-300 truncate">
                            <?= htmlspecialchars($prevPost['title']) ?>
                        </span>
                    </div>
                </a>
            <?php endif; ?>
        </div>

        <div class="w-full sm:w-auto flex justify-end text-right">
            <?php if ($nextPost): ?>
                <a href="?page=worship&id=<?= $nextPost['id'] ?>" class="group flex items-center justify-between p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl hover:border-red-500 transition-all shadow-sm max-w-xs md:max-w-md">
                    <div class="flex flex-col items-end overflow-hidden">
                        <span class="text-xs text-red-500 font-bold uppercase mb-1">
                            <?= isset($nextPost['published_at']) ? date('Y. m. d', strtotime($nextPost['published_at'])) : '' ?>
                        </span>
                        <span class="text-base font-bold text-slate-700 dark:text-slate-300 truncate">
                            <?= htmlspecialchars($nextPost['title']) ?>
                        </span>
                    </div>
                    <svg class="w-6 h-6 ml-4 text-slate-300 group-hover:text-red-500 transform group-hover:translate-x-1 transition-transform shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </nav>
</div>
<?php } ?>