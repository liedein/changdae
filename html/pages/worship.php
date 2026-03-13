<?php
/**
 * 주일예배 상세 보기 페이지 (worship.php)
 */
$sub = $_GET['sub'] ?? 'sermon';
$id = $_GET['id'] ?? null;

?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<?php
if ($sub === 'sermon' || $sub === 'worship'):
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

<div class="max-w-5xl mx-auto px-4 py-10 md:py-20">
    <div class="text-center mb-10" data-aos="fade-up">
        <span class="inline-block px-4 py-1.5 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-xs font-bold uppercase tracking-[0.2em] rounded-full mb-6 shadow-sm border border-red-100 dark:border-red-800">Sunday Worship Service</span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white leading-tight mb-6">
            <?= htmlspecialchars($post['title']) ?>
        </h1>
        <div class="w-12 h-1 bg-red-500 mx-auto mb-8 rounded-full"></div>
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

    <div class="mb-16 relative group" data-aos="fade-up" data-aos-delay="100">
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

    <nav class="flex flex-col sm:flex-row gap-4 justify-between items-center border-t border-slate-100 dark:border-slate-800 pt-12" data-aos="fade-up" data-aos-delay="200">
    
        <div class="w-full sm:w-auto flex justify-start">
            <?php if ($prevPost): ?>
                <a href="?page=worship&sub=sermon&id=<?= $prevPost['id'] ?>" class="w-full md:w-auto group flex items-center p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl hover:border-red-500 transition-all shadow-sm md:max-w-md">
                    <svg class="w-6 h-6 mr-4 text-slate-300 group-hover:text-red-500 transform group-hover:-translate-x-1 transition-transform shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <div class="flex flex-col overflow-hidden">
                        <span class="text-sm text-red-500 font-bold uppercase mb-1">
                            <?= isset($prevPost['published_at']) ? date('Y. m. d', strtotime($prevPost['published_at'])) : '이전글' ?>
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
                <a href="?page=worship&sub=sermon&id=<?= $nextPost['id'] ?>" class="w-full md:w-auto group flex items-center justify-between p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl hover:border-red-500 transition-all shadow-sm md:max-w-md">
                    <div class="flex flex-col items-end overflow-hidden">
                        <span class="text-sm text-red-500 font-bold uppercase mb-1">
                            <?= isset($nextPost['published_at']) ? date('Y. m. d', strtotime($nextPost['published_at'])) : '다음글' ?>
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
<?php
    }
elseif ($sub === 'videos'):
    $mode = $_GET['mode'] ?? 'view';
    $page_num = isset($_GET['page_num']) ? max(1, intval($_GET['page_num'])) : 1;

    if ($mode === 'view'): // --- 상세 보기 (기본) ---
        $category = 'videos';
        // ID 없으면 최신글 로드
        $data = getBoardPost($pdo, $category, $id);
        
        if (!$data || !$data['current']) {
            echo "<div class='text-center py-20 dark:text-gray-300 font-sans'>등록된 영상이 없습니다.</div>";
        } else {
            $post = $data['current'];
            $prevPost = $data['prev'];
            $nextPost = $data['next'];
            $youtube_id = '';
            if (!empty($post['youtube_url'])) {
                if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $post['youtube_url'], $match)) {
                    $youtube_id = $match[1];
                }
            }
?>
        <div class="max-w-5xl mx-auto px-4 py-10 md:py-20">
            <div class="text-center mb-10" data-aos="fade-up">
                <span class="inline-block px-4 py-1.5 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-xs font-bold uppercase tracking-[0.2em] rounded-full mb-6 shadow-sm border border-red-100 dark:border-red-800">Special Videos</span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white leading-tight mb-6"><?= htmlspecialchars($post['title']) ?></h1>
                <div class="w-12 h-1 bg-red-500 mx-auto mb-8 rounded-full"></div>
                <div class="inline-flex flex-wrap justify-center items-center gap-4 md:gap-8 bg-slate-50 dark:bg-slate-800/50 p-4 md:p-6 rounded-2xl border border-slate-100 dark:border-slate-700">
                    <div class="flex items-center gap-2">
                        <span class="text-slate-400 dark:text-slate-500 font-medium text-sm">분류</span>
                        <span class="text-slate-800 dark:text-white font-bold text-base md:text-lg"><?= htmlspecialchars($post['category'] ?? '영상') ?></span>
                    </div>
                    <div class="hidden md:block w-px h-4 bg-slate-200 dark:bg-slate-600"></div>
                    <div class="flex items-center gap-2">
                        <span class="text-slate-400 dark:text-slate-500 font-medium text-sm">날짜</span>
                        <span class="text-slate-800 dark:text-white font-bold text-base md:text-lg"><?= date('Y. m. d', strtotime($post['published_at'])) ?></span>
                    </div>
                </div>
            </div>
            <div class="mb-8 relative group" data-aos="fade-up" data-aos-delay="100">
                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-600 to-red-600 rounded-3xl blur opacity-25 group-hover:opacity-40 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative aspect-video rounded-2xl overflow-hidden shadow-2xl bg-black border border-slate-200 dark:border-slate-700">
                    <?php if ($youtube_id): ?>
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/<?= $youtube_id ?>?rel=0&modestbranding=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <?php else: ?>
                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-500"><svg class="w-16 h-16 mb-4 opacity-20" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg><span>등록된 영상 주소가 없습니다.</span></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if (!empty($post['content'])): ?><div class="prose prose-slate dark:prose-invert max-w-none mb-16 text-center" data-aos="fade-up" data-aos-delay="200"><?= $post['content'] ?></div><?php endif; ?>
            
            <!-- 모바일: 위아래 꽉 채워서 (flex-col, w-full) -->
            <nav class="flex flex-col md:flex-row gap-4 justify-between items-center border-t border-slate-100 dark:border-slate-800 pt-12" data-aos="fade-up" data-aos-delay="200">
                <div class="w-full md:w-auto flex justify-start">
                    <?php if ($prevPost): ?>
                        <a href="?page=worship&sub=videos&id=<?= $prevPost['id'] ?>" class="w-full md:w-auto group flex items-center p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl hover:border-indigo-500 transition-all shadow-sm max-w-none md:max-w-md">
                            <svg class="w-6 h-6 mr-4 text-slate-300 group-hover:text-red-500 transform group-hover:-translate-x-1 transition-transform shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            <div class="flex flex-col overflow-hidden"><span class="text-sm text-red-500 font-bold uppercase mb-1">이전 영상</span><span class="text-base font-bold text-slate-700 dark:text-slate-300 truncate"><?= htmlspecialchars($prevPost['title']) ?></span></div>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="w-full md:w-auto flex justify-end text-right">
                    <?php if ($nextPost): ?>
                        <a href="?page=worship&sub=videos&id=<?= $nextPost['id'] ?>" class="w-full md:w-auto group flex items-center justify-between p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl hover:border-indigo-500 transition-all shadow-sm max-w-none md:max-w-md">
                            <div class="flex flex-col items-end overflow-hidden"><span class="text-sm text-red-500 font-bold uppercase mb-1">다음 영상</span><span class="text-base font-bold text-slate-700 dark:text-slate-300 truncate"><?= htmlspecialchars($nextPost['title']) ?></span></div>
                            <svg class="w-6 h-6 ml-4 text-slate-300 group-hover:text-red-500 transform group-hover:translate-x-1 transition-transform shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    <?php endif; ?>
                </div>
            </nav>
            <div class="mt-12 text-center" data-aos="fade-up" data-aos-delay="300">
                <a href="?page=worship&sub=videos&mode=list" class="inline-flex items-center px-6 py-2 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-full text-sm font-bold hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    전체 영상 목록
                </a>
            </div>
        </div>
<?php
        }
    else: // --- 목록 보기 (mode=list) ---
        $limit = 10;
        $offset = ($page_num - 1) * $limit;
        
        $v_cat_filter = $_GET['v_cat'] ?? 'all';
        $v_cats = ['간증', '찬양', '행사', '기타'];
        
        // Count Query
        $countSql = "SELECT COUNT(*) FROM videos WHERE published_at <= NOW()";
        $countParams = [];

        // List Query
        $sql = "SELECT id, title, published_at, category FROM videos WHERE published_at <= NOW()";
        $params = [];

        if ($v_cat_filter !== 'all' && in_array($v_cat_filter, $v_cats)) {
            $countSql .= " AND category = ?";
            $sql .= " AND category = ?";
            $countParams[] = $v_cat_filter;
            $params[] = $v_cat_filter;
        }
        $sql .= " ORDER BY published_at DESC LIMIT $limit OFFSET $offset";
        
        // Total Count
        $stmt = $pdo->prepare($countSql);
        $stmt->execute($countParams);
        $total_posts = $stmt->fetchColumn();

        // List
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $posts = $stmt->fetchAll();
?>
    <div class="max-w-5xl mx-auto px-4 py-10 md:py-20">
        <div class="text-center mb-10" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-xs font-bold uppercase tracking-[0.2em] rounded-full mb-6 shadow-sm border border-red-100 dark:border-red-800">Special Videos</span>
            <h1 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white leading-tight mb-6">특별영상</h1>
            <div class="w-12 h-1 bg-red-500 mx-auto mb-8 rounded-full"></div>
        </div>
        <div class="flex justify-center flex-wrap gap-2 mb-8" data-aos="fade-up" data-aos-delay="100">
            <a href="?page=worship&sub=videos&mode=list&v_cat=all" class="px-4 py-2 text-sm font-bold rounded-full transition-colors <?= $v_cat_filter === 'all' ? 'bg-red-500 text-white shadow' : 'bg-white dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-100' ?>">전체</a>
            <?php foreach($v_cats as $vc): ?>
            <a href="?page=worship&sub=videos&mode=list&v_cat=<?= urlencode($vc) ?>" class="px-4 py-2 text-sm font-bold rounded-full transition-colors <?= $v_cat_filter === $vc ? 'bg-red-500 text-white shadow' : 'bg-white dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-100' ?>"><?= $vc ?></a>
            <?php endforeach; ?>
        </div>
        <div class="bg-white dark:bg-slate-800 shadow-sm sm:shadow-md sm:rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700" data-aos="fade-up" data-aos-delay="200">
            <table class="w-full text-base text-left text-gray-500 dark:text-gray-400">
                <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"><tr><th scope="col" class="px-6 py-3 w-40">일자</th><th scope="col" class="px-6 py-3">제목</th></tr></thead>
                <tbody>
                <?php if (count($posts) > 0): foreach ($posts as $post): ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400"><?= date('Y-m-d', strtotime($post['published_at'])) ?></td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white"><a href="?page=worship&sub=videos&id=<?= $post['id'] ?>" class="hover:underline"><?= htmlspecialchars($post['title']) ?></a></th>
                    </tr>
                <?php endforeach; else: ?>
                    <tr><td colspan="2" class="text-center p-8 text-slate-500">등록된 영상이 없습니다.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="mt-8 flex items-center justify-between">
            <div class="w-24">
                <?php if ($page_num > 1): ?>
                    <a href="?page=worship&sub=videos&mode=list&v_cat=<?= urlencode($v_cat_filter) ?>&page_num=<?= $page_num - 1 ?>" class="inline-flex items-center px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-md text-sm font-medium text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700">이전</a>
                <?php endif; ?>
            </div>
            
            <a href="?page=worship&sub=videos" class="px-6 py-2 bg-red-500 text-white rounded-full text-sm font-bold hover:bg-red-600 shadow-md transition-colors">최신 영상 보기</a>
            
            <div class="w-24 text-right">
                <?php if ($total_posts > $page_num * $limit): ?>
                    <a href="?page=worship&sub=videos&mode=list&v_cat=<?= urlencode($v_cat_filter) ?>&page_num=<?= $page_num + 1 ?>" class="inline-flex items-center px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-md text-sm font-medium text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700">다음</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php
    endif;
elseif ($sub === 'bulletin'):
    $mode = $_GET['mode'] ?? 'view';
    $page_num = isset($_GET['page_num']) ? max(1, intval($_GET['page_num'])) : 1;

    if ($mode === 'view'): // --- 상세 보기 (기본) ---
        $category = 'bulletin';
        // ID 없으면 최신 주보 로드
        $data = getBoardPost($pdo, $category, $id);
        
        if (!$data || !$data['current']) {
            echo "<div class='text-center py-20 dark:text-gray-300 font-sans'>등록된 주보가 없습니다.</div>";
        } else {
            $post = $data['current'];
            $prevPost = $data['prev'];
            $nextPost = $data['next'];
?>
        <div class="w-full py-10 md:py-20">
            <div class="max-w-4xl mx-auto px-4 text-center mb-10" data-aos="fade-up">
                <span class="inline-block px-4 py-1.5 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-xs font-bold uppercase tracking-[0.2em] rounded-full mb-6 shadow-sm border border-red-100 dark:border-red-800">Weekly Bulletin</span>
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-800 dark:text-white leading-tight mb-6"><?= htmlspecialchars($post['title']) ?></h1>
                <div class="w-12 h-1 bg-red-500 mx-auto rounded-full"></div>
            </div>
            <div class="max-w-[1800px] mx-auto md:px-4 shadow-lg rounded-none md:rounded-lg overflow-hidden border-y md:border border-gray-200 dark:border-gray-700" data-aos="fade-up" data-aos-delay="100">
                <div class="p-0 bg-slate-100 dark:bg-slate-900 flex flex-col">
                    <?php if (!empty($post['image_files'])): $images = json_decode($post['image_files'], true); if (is_array($images)): foreach ($images as $image): $imagePath = (strpos($image, 'bulletins/') === false) ? "bulletins/" . $image : $image; ?>
                        <div class="w-full m-0 p-0 leading-[0]"><img src="/uploads/<?= htmlspecialchars($imagePath) ?>" alt="주보 이미지" class="w-full h-auto block" loading="lazy"></div>
                    <?php endforeach; endif; endif; ?>
                </div>
            </div>
            <!-- 모바일: 좌우 배치 (flex-row) -->
            <div class="max-w-4xl mx-auto px-4">
                <nav class="mt-12 flex flex-row gap-4 justify-between items-center border-t border-gray-200 dark:border-gray-700 pt-12 pb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="w-1/2 sm:w-auto flex-1 max-w-sm">
                    <?php if ($prevPost): ?>
                        <a href="?page=worship&sub=bulletin&id=<?= $prevPost['id'] ?>" class="relative group flex items-center w-full px-3 py-6 md:p-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:border-red-500 transition-all shadow-sm overflow-hidden h-full">
                            <!-- 모바일 배경 텍스트 화살표 -->
                            <span class="absolute top-1/2 left-[-1.5rem] -translate-y-1/2 text-[10rem] font-black text-slate-100 dark:text-slate-700 leading-[0] pb-6 md:hidden z-0 select-none group-hover:text-red-50 dark:group-hover:text-red-900/20 transition-colors">&lt;</span>
                            <!-- PC 아이콘 -->
                            <svg class="hidden md:block w-5 h-5 mr-3 text-slate-400 group-hover:text-red-500 transform group-hover:-translate-x-1 transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            <div class="relative z-10 flex flex-col items-start pl-1 md:pl-0"><span class="text-sm text-red-500 font-bold uppercase mb-1">이전 주보</span><span class="text-base font-semibold text-slate-700 dark:text-slate-300 line-clamp-1 text-left"><?= htmlspecialchars($prevPost['title']) ?></span></div>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="w-1/2 sm:w-auto flex-1 max-w-sm flex justify-end">
                    <?php if ($nextPost): ?>
                        <a href="?page=worship&sub=bulletin&id=<?= $nextPost['id'] ?>" class="relative group flex items-center justify-end md:justify-between w-full px-3 py-6 md:p-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:border-red-500 transition-all shadow-sm overflow-hidden h-full text-right">
                            <!-- 모바일 배경 텍스트 화살표 -->
                            <span class="absolute top-1/2 right-[-1.5rem] -translate-y-1/2 text-[10rem] font-black text-slate-100 dark:text-slate-700 leading-[0] pb-6 md:hidden z-0 select-none group-hover:text-red-50 dark:group-hover:text-red-900/20 transition-colors">&gt;</span>
                            <div class="relative z-10 flex flex-col items-end pr-1 md:pr-0"><span class="text-sm text-red-500 font-bold uppercase mb-1">다음 주보</span><span class="text-base font-semibold text-slate-700 dark:text-slate-300 line-clamp-1 text-right"><?= htmlspecialchars($nextPost['title']) ?></span></div>
                            <!-- PC 아이콘 -->
                            <svg class="hidden md:block w-5 h-5 ml-3 text-slate-400 group-hover:text-red-500 transform group-hover:translate-x-1 transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    <?php endif; ?>
                </div>
            </nav>
            <div class="mt-12 text-center" data-aos="fade-up" data-aos-delay="300">
                <a href="?page=worship&sub=bulletin&mode=list" class="inline-flex items-center px-6 py-2 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-full text-sm font-bold hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    전체 주보 목록
                </a>
            </div>
            </div>
        </div>
<?php
        }
    else: // --- 목록 보기 (mode=list) ---
        $limit = 10;
        $offset = ($page_num - 1) * $limit;

        // Count
        $countStmt = $pdo->prepare("SELECT COUNT(*) FROM bulletin WHERE published_at <= NOW()");
        $countStmt->execute();
        $total_posts = $countStmt->fetchColumn();

        // List
        $stmt = $pdo->prepare("SELECT id, title FROM bulletin WHERE published_at <= NOW() ORDER BY published_at DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $posts = $stmt->fetchAll();
?>
        <div class="max-w-4xl mx-auto px-4 py-10 md:py-20">
            <div class="text-center mb-10" data-aos="fade-up">
                <h1 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white leading-tight mb-6">주보</h1>
                <div class="w-12 h-1 bg-red-500 mx-auto rounded-full"></div>
            </div>
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:shadow-md sm:rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700" data-aos="fade-up" data-aos-delay="100">
                <ul class="divide-y divide-slate-100 dark:divide-slate-700">
                    <?php if (count($posts) > 0): $delay=0; foreach ($posts as $post): ?>
                    <li class="group" data-aos="fade-up" data-aos-delay="<?= $delay * 50 ?>">
                        <a href="?page=worship&sub=bulletin&id=<?= $post['id'] ?>" class="block p-6 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                            <h4 class="font-bold text-slate-800 dark:text-slate-200 group-hover:text-red-600 dark:group-hover:text-red-400 text-xl"><?= htmlspecialchars($post['title']) ?></h4>
                        </a>
                    </li>
                    <?php $delay++; endforeach; else: ?>
                        <li class="p-8 text-center text-slate-500">등록된 주보가 없습니다.</li>
                    <?php endif; ?>
                </ul>
            </div>
            
            <div class="mt-8 flex items-center justify-between">
                <div class="w-24">
                    <?php if ($page_num > 1): ?>
                        <a href="?page=worship&sub=bulletin&mode=list&page_num=<?= $page_num - 1 ?>" class="inline-flex items-center px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-md text-sm font-medium text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700">이전</a>
                    <?php endif; ?>
                </div>
                
                <a href="?page=worship&sub=bulletin" class="px-6 py-2 bg-red-500 text-white rounded-full text-sm font-bold hover:bg-red-600 shadow-md transition-colors">최신 주보 보기</a>
                
                <div class="w-24 text-right">
                    <?php if ($total_posts > $page_num * $limit): ?>
                        <a href="?page=worship&sub=bulletin&mode=list&page_num=<?= $page_num + 1 ?>" class="inline-flex items-center px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-md text-sm font-medium text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700">다음</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
<?php
    endif;
endif; 
?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: true, offset: 50 });
</script>