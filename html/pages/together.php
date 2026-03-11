<?php
$sub = $_GET['sub'] ?? 'missionary';
$id = $_GET['id'] ?? null;
?>

<?php if ($sub === 'missionary'): ?>
<!-- 파송 및 후원선교사 -->
<div class="bg-slate-50 dark:bg-slate-900">
    <section class="max-w-7xl mx-auto px-4 py-16 md:py-24">
        <div class="text-center mb-16">
            <span class="inline-block px-3 py-1 bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Missionaries</span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white mb-6">파송 및 후원선교사</h2>
            <div class="w-12 h-1 bg-purple-500 mx-auto mb-8 rounded-full"></div>
            <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed text-lg">
                땅 끝까지 이르러 내 증인이 되리라 하신 주님의 지상명령을 따라 창대교회가 함께 동역하며 후원하는 선교사님들입니다.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
            <?php
            $missionaries = [
                ['name' => '김정민 목사', 'country' => '멕시코 과달라하라', 'org' => '(연수지) 파송 선교사', 'img' => 'https://placehold.co/400x500/1a365d/ffffff?text=Missionary'],
                ['name' => '이민찬 선교사', 'country' => '러시아 연해주 지역', 'org' => '후원 선교사', 'img' => 'https://placehold.co/400x500/1a365d/ffffff?text=Missionary'],
                ['name' => '정필우 선교사', 'country' => '인도 북인도 지역', 'org' => '후원 선교사', 'img' => 'https://placehold.co/400x500/1a365d/ffffff?text=Missionary'],
                ['name' => '형남권 선교사', 'country' => '탄자니아 팡가웨 지역', 'org' => '후원 선교사', 'img' => 'https://placehold.co/400x500/1a365d/ffffff?text=Missionary'],
                ['name' => 'GST', 'country' => '탄자니아 팡가웨 은혜신학교', 'org' => '후원 기관 (로마니/에녹/록키/형남권/조세프/마틴/젝키)', 'img' => 'https://placehold.co/400x500/1a365d/ffffff?text=Missionary'],
            ];
            ?>
            <?php foreach ($missionaries as $missionary): ?>
            <div class="group">
                <div class="aspect-[4/5] w-full overflow-hidden rounded-lg bg-gray-200 dark:bg-gray-700 mb-4 relative">
                    <img src="<?= $missionary['img'] ?>" alt="<?= $missionary['name'] ?>" class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                    <!-- 국가/지역 뱃지 -->
                    <div class="absolute top-4 left-4 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-bold text-deepblue dark:text-blue-400 shadow-sm">
                        <?= $missionary['country'] ?>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-charcoal dark:text-white"><?= $missionary['name'] ?></h3>
                <p class="text-base font-medium text-gray-500 dark:text-gray-400 mb-1"><?= $missionary['org'] ?></p>
                <div class="mt-2">
                    <button class="text-base text-deepblue dark:text-blue-400 font-medium hover:underline">기도편지 보기 &rarr;</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<?php elseif ($sub === 'neighbor'): ?>
<!-- 이웃섬김 -->
<div class="bg-slate-50 dark:bg-slate-900">
    <section class="max-w-7xl mx-auto px-4 py-16 md:py-24">
        <div class="text-center mb-16">
            <span class="inline-block px-3 py-1 bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Serving Neighbors</span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white mb-6">이웃섬김</h2>
            <div class="w-12 h-1 bg-purple-500 mx-auto mb-8 rounded-full"></div>
            <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed text-lg">
                지역 사회와 함께하는 창대교회의 나눔 사역입니다.
            </p>
        </div>
        <div class="text-center py-20">
            <p class="text-gray-600 dark:text-gray-400">준비 중인 페이지입니다.</p>
        </div>
    </section>
</div>

<?php elseif ($sub === 'column'): ?>
<div class="bg-slate-50 dark:bg-slate-900">
    <section class="max-w-7xl mx-auto px-4 py-16 md:py-24">
        <div class="text-center mb-16">
            <span class="inline-block px-3 py-1 bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Pastoral Column</span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white mb-6">목회칼럼</h2>
            <div class="w-12 h-1 bg-purple-500 mx-auto mb-8 rounded-full"></div>
        </div>
        <?php
        $category = 'column'; 
        // 데이터 가져오기 (functions.php의 getBoardPost 함수 사용)
        if ($id) { // --- 상세 보기 ---
            $data = getBoardPost($pdo, $category, $id);
            if (!$data || !$data['current']) {
                echo "<div class='text-center py-20 dark:text-gray-300 font-sans'>요청하신 칼럼을 찾을 수 없습니다.</div>";
            } else {
                $post = $data['current'];
                $prevPost = $data['prev'];
                $nextPost = $data['next'];
        ?>
            <div class="max-w-3xl mx-auto">
                <article class="bg-white dark:bg-slate-800 shadow-sm sm:shadow-md sm:rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700">
                    <header class="p-8 md:p-12 border-b border-slate-100 dark:border-slate-700 text-center">
                        <h1 class="text-2xl md:text-3xl font-extrabold text-slate-800 dark:text-white leading-snug mb-4"><?= htmlspecialchars($post['title']) ?></h1>
                        <time class="text-slate-400 dark:text-slate-500 text-base font-medium"><?= date('Y년 m월 d일', strtotime($post['published_at'])) ?></time>
                    </header>
                    <div class="p-8 md:p-12">
                        <div class="prose prose-slate dark:prose-invert max-w-none prose-p:leading-loose prose-p:text-slate-600 dark:prose-p:text-slate-300 prose-p:mb-6 text-lg md:text-lg font-serif"><?= $post['content'] ?></div>
                    </div>
                </article>

                <nav class="mt-10 flex flex-col sm:flex-row gap-4 justify-between items-center">
                    <div class="w-full sm:w-auto">
                        <?php if ($prevPost): ?>
                            <a href="?page=together&sub=column&id=<?= $prevPost['id'] ?>" class="group flex items-center p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:border-blue-500 transition-all shadow-sm">
                                <svg class="w-5 h-5 mr-4 text-slate-400 group-hover:text-blue-500 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                <div class="flex flex-col"><span class="text-sm text-blue-500 font-bold uppercase mb-1">이전 칼럼</span><span class="text-base font-semibold text-slate-700 dark:text-slate-300 line-clamp-1"><?= htmlspecialchars($prevPost['title']) ?></span></div>
                            </a>
                        <?php else: ?>
                            <div class="p-5 bg-slate-50 dark:bg-slate-800/30 border border-slate-100 dark:border-slate-700 rounded-xl opacity-50"><span class="text-base text-slate-400 font-bold uppercase">이전 칼럼이 없습니다</span></div>
                        <?php endif; ?>
                    </div>
                    <div class="w-full sm:w-auto">
                        <?php if ($nextPost): ?>
                            <a href="?page=together&sub=column&id=<?= $nextPost['id'] ?>" class="group flex items-center justify-between p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:border-blue-500 transition-all shadow-sm text-right">
                                <div class="flex flex-col items-end"><span class="text-sm text-blue-500 font-bold uppercase mb-1">다음 칼럼</span><span class="text-base font-semibold text-slate-700 dark:text-slate-300 line-clamp-1"><?= htmlspecialchars($nextPost['title']) ?></span></div>
                                <svg class="w-5 h-5 ml-4 text-slate-400 group-hover:text-blue-500 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        <?php else: ?>
                            <div class="p-5 bg-slate-50 dark:bg-slate-800/30 border border-slate-100 dark:border-slate-700 rounded-xl opacity-50 text-right"><span class="text-base text-slate-400 font-bold uppercase">다음 칼럼이 없습니다</span></div>
                        <?php endif; ?>
                    </div>
                </nav>

                <div class="mt-12 text-center">
                    <a href="?page=together&sub=column" class="inline-flex items-center px-6 py-2 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-200 rounded-full text-sm font-bold hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">전체 칼럼 목록</a>
                </div>
            </div>
            <?php }
        } else { // --- 목록 보기 ---
            $stmt = $pdo->prepare("SELECT id, title, published_at FROM `column` WHERE published_at <= NOW() ORDER BY published_at DESC");
            $stmt->execute();
            $posts = $stmt->fetchAll();
        ?>
            <div class="max-w-3xl mx-auto">
                <div class="bg-white dark:bg-slate-800 shadow-sm sm:shadow-md sm:rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr><th scope="col" class="px-6 py-3 w-40">일자</th><th scope="col" class="px-6 py-3">제목</th></tr>
                        </thead>
                        <tbody>
                        <?php if (count($posts) > 0): foreach ($posts as $post): ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 text-gray-500 dark:text-gray-400"><?= date('Y-m-d', strtotime($post['published_at'])) ?></td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"><a href="?page=together&sub=column&id=<?= $post['id'] ?>" class="hover:underline"><?= htmlspecialchars($post['title']) ?></a></th>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr><td colspan="2" class="text-center p-8 text-slate-500">등록된 칼럼이 없습니다.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>
    </section>
</div>

<?php else: ?>
<!-- 기본 페이지 -->
<div class="max-w-7xl mx-auto px-4 py-20 text-center">
    <h2 class="text-2xl font-bold mb-4">준비 중입니다</h2>
    <p class="text-gray-600">해당 페이지를 준비하고 있습니다.</p>
</div>

<?php endif; ?>