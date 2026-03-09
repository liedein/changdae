<?php
$sub = $_GET['sub'] ?? 'missionary';
$id = $_GET['id'] ?? null;
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

<?php elseif ($sub === 'column'): ?>
    <?php
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
                    <a href="?page=together&sub=column&id=<?= $prevPost['id'] ?>" class="group h-full flex items-center p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:border-blue-500 transition-all shadow-sm">
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
                    <a href="?page=together&sub=column&id=<?= $nextPost['id'] ?>" class="group h-full flex items-center justify-between p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:border-blue-500 transition-all shadow-sm text-right">
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
            <a href="?page=together&sub=column" class="inline-flex items-center px-6 py-2 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-200 rounded-full text-sm font-bold hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">
                전체 칼럼 목록
            </a>
        </div>
    </div>
    <?php } ?>

<?php else: ?>
<!-- 기본 페이지 -->
<div class="max-w-7xl mx-auto px-4 py-20 text-center">
    <h2 class="text-2xl font-bold mb-4">준비 중입니다</h2>
    <p class="text-gray-600">해당 페이지를 준비하고 있습니다.</p>
</div>

<?php endif; ?>