<?php
$sub = $_GET['sub'] ?? 'missionary';
$id = $_GET['id'] ?? null;
?>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<?php if ($sub === 'missionary'): ?>
<!-- 파송 및 후원선교사 -->
<div class="bg-slate-50 dark:bg-slate-900">
    <section class="max-w-7xl mx-auto px-4 py-10 md:py-20">
        <div class="text-center mb-8" data-aos="fade-up">
            <span class="inline-block px-3 py-1 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Missionaries</span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white mb-6">파송 및 후원선교사</h2>
            <div class="w-12 h-1 bg-indigo-500 mx-auto mb-8 rounded-full"></div>
            <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed text-lg">
                땅 끝까지 이르러 내 증인이 되리라 하신 주님의 지상명령을 따라 창대교회가 함께 동역하며 후원하는 선교사님들입니다.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
            <?php
            $missionaries = [
                ['name' => '김정민 목사', 'country' => '멕시코 과달라하라', 'org' => '(연수지) 파송 선교사', 'img' => 'https://placehold.co/400x500/3730a3/ffffff?text=Missionary'],
                ['name' => '이민찬 선교사', 'country' => '러시아 연해주 지역', 'org' => '후원 선교사', 'img' => 'https://placehold.co/400x500/3730a3/ffffff?text=Missionary'],
                ['name' => '정필우 선교사', 'country' => '인도 북인도 지역', 'org' => '후원 선교사', 'img' => 'https://placehold.co/400x500/3730a3/ffffff?text=Missionary'],
                ['name' => '형남권 선교사', 'country' => '탄자니아 팡가웨 지역', 'org' => '후원 선교사', 'img' => 'https://placehold.co/400x500/3730a3/ffffff?text=Missionary'],
                ['name' => 'GST', 'country' => '탄자니아 팡가웨 은혜신학교', 'org' => '후원 기관 (로마니/에녹/록키/형남권/조세프/마틴/젝키)', 'img' => 'https://placehold.co/400x500/3730a3/ffffff?text=Missionary'],
            ];
            ?>
            <?php $delay = 0; foreach ($missionaries as $missionary): ?>
            <div class="group" data-aos="fade-up" data-aos-delay="<?= $delay * 100 ?>">
                <div class="aspect-[4/5] w-full overflow-hidden rounded-lg bg-gray-200 dark:bg-gray-700 mb-4 relative">
                    <img src="<?= $missionary['img'] ?>" alt="<?= $missionary['name'] ?>" class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                    <!-- 국가/지역 뱃지 -->
                    <div class="absolute top-4 left-4 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-bold text-deepindigo dark:text-indigo-400 shadow-sm">
                        <?= $missionary['country'] ?>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-charcoal dark:text-white"><?= $missionary['name'] ?></h3>
                <p class="text-base font-medium text-gray-500 dark:text-gray-400 mb-1"><?= $missionary['org'] ?></p>
                <div class="mt-2">
                    <button class="text-base text-deepindigo dark:text-indigo-400 font-medium hover:underline">기도편지 보기 &rarr;</button>
                </div>
            </div>
            <?php $delay++; endforeach; ?>
        </div>
    </section>
</div>

<?php elseif ($sub === 'neighbor'): ?>
<!-- 이웃섬김 -->
<div class="bg-slate-50 dark:bg-slate-900">
    <section class="max-w-7xl mx-auto px-4 py-10 md:py-20">
        <div class="text-center mb-8" data-aos="fade-up">
            <span class="inline-block px-3 py-1 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Serving Neighbors</span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white mb-6">이웃섬김</h2>
            <div class="w-12 h-1 bg-indigo-500 mx-auto mb-8 rounded-full"></div>
            <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed text-lg">
                지역 사회와 함께하는 창대교회의 나눔 사역입니다.
            </p>
        </div>
        <div class="text-center py-16" data-aos="fade-up" data-aos-delay="100">
            <p class="text-gray-600 dark:text-gray-400">준비 중인 페이지입니다.</p>
        </div>
    </section>
</div>

<?php elseif ($sub === 'column'): ?>
<div class="bg-slate-50 dark:bg-slate-900">
    <section class="max-w-7xl mx-auto px-4 py-10 md:py-20">
        <div class="text-center mb-8" data-aos="fade-up">
            <span class="inline-block px-3 py-1 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Pastoral Column</span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white mb-6">목회칼럼</h2>
            <div class="w-12 h-1 bg-indigo-500 mx-auto mb-8 rounded-full"></div>
        </div>
        <?php
        $mode = $_GET['mode'] ?? 'view';
        $page_num = isset($_GET['page_num']) ? max(1, intval($_GET['page_num'])) : 1;
        $category = 'column'; 
        
        if ($mode === 'view') { // --- 상세 보기 (기본) ---
            // ID 없으면 최신글 로드
            $data = getBoardPost($pdo, $category, $id);
            
            if (!$data || !$data['current']) {
                echo "<div class='text-center py-20 dark:text-gray-300 font-sans'>요청하신 칼럼을 찾을 수 없습니다.</div>";
            } else {
                $post = $data['current'];
                $prevPost = $data['prev'];
                $nextPost = $data['next'];
        ?>
            <div class="max-w-3xl mx-auto">
                <article class="bg-white dark:bg-slate-800 shadow-sm sm:shadow-md sm:rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700" data-aos="fade-up" data-aos-delay="100">
                    <header class="p-6 md:p-10 border-b border-slate-100 dark:border-slate-700 text-center">
                        <h1 class="text-2xl md:text-3xl font-extrabold text-slate-800 dark:text-white leading-snug mb-4"><?= htmlspecialchars($post['title']) ?></h1>
                        <time class="text-slate-400 dark:text-slate-500 text-base font-medium"><?= date('Y년 m월 d일', strtotime($post['published_at'])) ?></time>
                    </header>
                    <div class="p-6 md:p-10">
                        <div class="prose prose-slate dark:prose-invert max-w-none prose-p:text-slate-600 dark:prose-p:text-slate-300 text-lg md:text-xl font-serif"><?= $post['content'] ?></div>
                    </div>
                </article>

                <!-- 모바일: 위아래 꽉 채워서 (flex-col, w-full) -->
                <nav class="mt-10 flex flex-col md:flex-row gap-4 justify-between items-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-full md:w-auto">
                        <?php if ($prevPost): ?>
                            <a href="?page=together&sub=column&id=<?= $prevPost['id'] ?>" class="group flex items-center p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:border-indigo-500 transition-all shadow-sm w-full md:w-auto">
                                <svg class="w-5 h-5 mr-4 text-slate-400 group-hover:text-indigo-500 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                <div class="flex flex-col"><span class="text-sm text-indigo-500 font-bold uppercase mb-1">이전 칼럼</span><span class="text-base font-semibold text-slate-700 dark:text-slate-300 line-clamp-1"><?= htmlspecialchars($prevPost['title']) ?></span></div>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="w-full md:w-auto">
                        <?php if ($nextPost): ?>
                            <a href="?page=together&sub=column&id=<?= $nextPost['id'] ?>" class="group flex items-center justify-end p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:border-indigo-500 transition-all shadow-sm text-right w-full md:w-auto">
                                <div class="flex flex-col items-end"><span class="text-sm text-indigo-500 font-bold uppercase mb-1">다음 칼럼</span><span class="text-base font-semibold text-slate-700 dark:text-slate-300 line-clamp-1"><?= htmlspecialchars($nextPost['title']) ?></span></div>
                                <svg class="w-5 h-5 ml-4 text-slate-400 group-hover:text-indigo-500 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </nav>

                <div class="mt-12 text-center" data-aos="fade-up" data-aos-delay="300">
                    <a href="?page=together&sub=column&mode=list" class="inline-flex items-center px-6 py-2 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-200 rounded-full text-sm font-bold hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">전체 칼럼 목록</a>
                </div>
            </div>
            <?php }
        } else { // --- 목록 보기 (mode=list) ---
            $limit = 10;
            $offset = ($page_num - 1) * $limit;

            // Count
            $countStmt = $pdo->prepare("SELECT COUNT(*) FROM `column` WHERE published_at <= NOW()");
            $countStmt->execute();
            $total_posts = $countStmt->fetchColumn();

            // List
            $stmt = $pdo->prepare("SELECT id, title, published_at FROM `column` WHERE published_at <= NOW() ORDER BY published_at DESC LIMIT :limit OFFSET :offset");
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $posts = $stmt->fetchAll();
        ?>
            <div class="max-w-3xl mx-auto">
                <div class="bg-white dark:bg-slate-800 shadow-sm sm:shadow-md sm:rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700" data-aos="fade-up" data-aos-delay="100">
                    <table class="w-full text-base text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr><th scope="col" class="px-6 py-3 w-40">일자</th><th scope="col" class="px-6 py-3">제목</th></tr>
                        </thead>
                        <tbody>
                        <?php if (count($posts) > 0): foreach ($posts as $post): ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 text-gray-500 dark:text-gray-400"><?= date('Y-m-d', strtotime($post['published_at'])) ?></td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white"><a href="?page=together&sub=column&id=<?= $post['id'] ?>" class="hover:underline"><?= htmlspecialchars($post['title']) ?></a></th>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr><td colspan="2" class="text-center p-8 text-slate-500">등록된 칼럼이 없습니다.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 flex items-center justify-between">
                    <div class="w-24">
                        <?php if ($page_num > 1): ?>
                            <a href="?page=together&sub=column&mode=list&page_num=<?= $page_num - 1 ?>" class="inline-flex items-center px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-md text-sm font-medium text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700">이전</a>
                        <?php endif; ?>
                    </div>
                    
                    <a href="?page=together&sub=column" class="px-6 py-2 bg-indigo-600 text-white rounded-full text-sm font-bold hover:bg-indigo-700 shadow-md transition-colors">최신 칼럼 보기</a>
                    
                    <div class="w-24 text-right">
                        <?php if ($total_posts > $page_num * $limit): ?>
                            <a href="?page=together&sub=column&mode=list&page_num=<?= $page_num + 1 ?>" class="inline-flex items-center px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-md text-sm font-medium text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700">다음</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
</div>

<?php else: ?>
<!-- 기본 페이지 -->
<div class="max-w-7xl mx-auto px-4 py-16 text-center">
    <h2 class="text-2xl font-bold mb-4">준비 중입니다</h2>
    <p class="text-gray-600">해당 페이지를 준비하고 있습니다.</p>
</div>

<?php endif; ?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: true, offset: 50 });
</script>