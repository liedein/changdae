<?php
$sub = $_GET['sub'] ?? 'vision';
?>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<?php if ($sub === 'vision'): ?>
    <div class="bg-slate-50 dark:bg-slate-900">
        <section class="max-w-7xl mx-auto px-4 py-10 md:py-20">
            <div class="text-center mb-6" data-aos="fade-up">
                <span class="inline-block px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Vision & Philosophy</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white mb-6">비전과 철학</h2>
                <div class="w-12 h-1 bg-blue-500 mx-auto mb-6 rounded-full"></div>
                <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed text-xl">
                    창대교회의 비전과 목회 철학입니다.
                </p>
            </div>
            <img src="/assets/img/vision.jpg" alt="창대교회 비전과 철학" class="w-full max-w-5xl mx-auto rounded-lg shadow-lg dark:shadow-black/20" data-aos="fade-up" data-aos-delay="200">
        </section>
    </div>
<?php elseif ($sub === 'staff'): ?>
    <div class="bg-slate-50 dark:bg-slate-900">
        <section class="max-w-7xl mx-auto px-4 py-10 md:py-20">
            <div class="text-center mb-6" data-aos="fade-up">
                <span class="inline-block px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Serving People</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white mb-6">섬기는 사람들</h2>
                <div class="w-12 h-1 bg-blue-500 mx-auto mb-6 rounded-full"></div>
                <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed text-xl">
                    창대교회를 섬기는 분들을 소개합니다.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
                <?php
                $staffs = [
                    ['name' => '김은택', 'role' => '담임목사', 'img' => 'https://placehold.co/400x500/1e40af/ffffff?text=Pastor'],
                    ['name' => '김성진', 'role' => '원로목사', 'img' => 'https://placehold.co/400x500/1e40af/ffffff?text=Staff'],
                    ['name' => '손재용', 'role' => '장로', 'img' => 'https://placehold.co/400x500/1e40af/ffffff?text=Staff'],
                    ['name' => '김옥진', 'role' => '은퇴장로', 'img' => 'https://placehold.co/400x500/1e40af/ffffff?text=Staff'],
                    ['name' => '진숙영', 'role' => '중고등부 디렉터', 'img' => 'https://placehold.co/400x500/1e40af/ffffff?text=Staff'],
                    ['name' => '유경아', 'role' => 'GST주일학교 디렉터', 'img' => '\assets\img\staff_yga.jpg'],
                    ['name' => '이명희', 'role' => 'GST유년부 디렉터', 'img' => 'https://placehold.co/400x500/1e40af/ffffff?text=Staff'],
                    // 필요 시 추가
                ];
                ?>
                <?php $delay = 0; foreach ($staffs as $staff): ?>
                <div class="group" data-aos="fade-up" data-aos-delay="<?= $delay * 100 ?>">
                    <div class="aspect-[4/5] w-full overflow-hidden rounded-lg bg-gray-200 dark:bg-gray-700 mb-4">
                        <img src="<?= $staff['img'] ?>" alt="<?= $staff['name'] ?>" class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <h3 class="text-2xl font-bold text-charcoal dark:text-white"><?= $staff['name'] ?></h3>
                    <p class="text-lg font-medium text-deepblue dark:text-blue-400 mb-1"><?= $staff['role'] ?></p>
                </div>
                <?php $delay++; endforeach; ?>
            </div>
        </section>
    </div>
<?php elseif ($sub === 'cell'): ?>
    <div class="bg-slate-50 dark:bg-slate-900">
        <section class="max-w-7xl mx-auto px-4 py-10 md:py-20">
            <div class="text-center mb-6" data-aos="fade-up">
                <span class="inline-block px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Cell Groups</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white mb-6">목장</h2>
                <div class="w-12 h-1 bg-blue-500 mx-auto mb-6 rounded-full"></div>
                <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed text-xl">
                    성도들이 삶을 나누고 함께 기도하며 사랑을 실천하는 가족 공동체입니다.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
                <?php
                $cells = [
                    ['name' => '러시아목장', 'leader' => '김옥진 목자 | 신미옥 목우', 'img' => 'https://placehold.co/400x350/f3f4f6/9ca3af?text=Cell+Group'],
                    ['name' => '멕시코목장', 'leader' => '손재용 목자 | 진숙영 목우', 'img' => 'https://placehold.co/400x350/f3f4f6/9ca3af?text=Cell+Group'],
                    ['name' => '인도목장', 'leader' => '최홍범 목자 | 최정헌 목우', 'img' => 'https://placehold.co/400x350/f3f4f6/9ca3af?text=Cell+Group'],
                    ['name' => '탄자니아목장', 'leader' => '한민성 목자 | 박혜리 목우', 'img' => 'https://placehold.co/400x350/f3f4f6/9ca3af?text=Cell+Group'],
                    ['name' => '과달라하라목장', 'leader' => '김미희 목자', 'img' => 'https://placehold.co/400x350/f3f4f6/9ca3af?text=Cell+Group'],
                    ['name' => '팡가웨목장', 'leader' => '진숙영 디렉터', 'img' => 'https://placehold.co/400x350/f3f4f6/9ca3af?text=Cell+Group'],
                    ['name' => 'GST주일학교', 'leader' => '유경아 디렉터', 'img' => 'https://placehold.co/400x350/f3f4f6/9ca3af?text=Cell+Group'],
                    ['name' => 'GST유년부', 'leader' => '이명희 디렉터', 'img' => 'https://placehold.co/400x350/f3f4f6/9ca3af?text=Cell+Group'],
                ];
                ?>
                <?php $delay = 0; foreach ($cells as $cell): ?>
                <div class="group bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden border border-gray-100 dark:border-gray-700" data-aos="fade-up" data-aos-delay="<?= $delay * 100 ?>">
                    <div class="aspect-video w-full overflow-hidden bg-gray-200 dark:bg-gray-700">
                        <img src="<?= $cell['img'] ?>" alt="<?= $cell['name'] ?>" class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-charcoal dark:text-white mb-1"><?= $cell['name'] ?></h3>
                        <p class="text-lg text-deepblue dark:text-blue-400 font-medium mb-3"><?= $cell['leader'] ?></p>
                        <p class="text-lg text-gray-500 dark:text-gray-400"><?= $cell['desc'] ?? '' ?></p>
                    </div>
                </div>
                <?php $delay++; endforeach; ?>
            </div>
        </section>
    </div>
<?php elseif ($sub === 'study'): ?>
    <div class="bg-slate-50 dark:bg-slate-900">
        <section class="max-w-6xl mx-auto px-4 py-10 md:py-20">
            <?php
            // 제목 영역 HTML (모바일/데스크탑 분기 처리를 위해 변수화)
            $studyTitleHtml = '
            <div class="text-center mb-10 lg:mb-6" data-aos="fade-up">
                <span class="inline-block px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Christian Living Study</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white mb-6">삶공부</h2>
                <div class="w-12 h-1 bg-blue-500 mx-auto mb-6 rounded-full"></div>
                <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed text-xl">
                    지식 위주의 공부에서 벗어나 삶의 변화를 목표로 합니다.<br class="hidden md:block">
                    하나님을 경험하고 성경적인 가치관을 세우는 축복의 통로입니다.
                </p>
            </div>';
            ?>
            
            <!-- Mobile Title (lg:hidden) -->
            <div class="block lg:hidden">
                <?= $studyTitleHtml ?>
            </div>

            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Left Image Section -->
                <div class="lg:w-1/3 order-1" data-aos="fade-up" data-aos-delay="200">
                    <div class="sticky top-24">
                        <div class="aspect-square lg:aspect-[1/3] w-full rounded-2xl overflow-hidden shadow-xl bg-gray-200 dark:bg-gray-700">
                            <img src="/assets/img/intro_study.jpg" 
                                alt="삶공부" 
                                class="w-full h-full object-cover object-center hover:scale-105 transition-transform duration-700">
                        </div>
                    </div>
                </div>

                <!-- Right Content Section -->
                <div class="lg:w-2/3 order-2">
                    <!-- Desktop Title (hidden lg:block) -->
                    <div class="hidden lg:block">
                        <?= $studyTitleHtml ?>
                    </div>

                    <div class="space-y-6">
                        <?php
                        $courses = [
                            ['title' => '예수영접모임', 'desc' => '예수님이 누구신지 듣고 그분을 마음에 모십니다.'],
                            ['title' => '행복한 삶', 'desc' => '내가 누구인지, 삶의 진정한 행복은 어디에 있는지 생각해 봅니다.'],
                            ['title' => '회복의 삶', 'desc' => '예수 그리스도 안에서의 회복을 통해 더욱 복음의 삶으로 나아갑니다.'],
                            ['title' => '예비부부의 삶', 'desc' => '나와 상대방을 바로 알고 결혼에 대한 바른 기대와 계획을 갖게 합니다.'],
                            ['title' => '생명의 삶', 'desc' => '복음의 핵심을 공부하며 신앙의 기초를 다집니다.'],
                            ['title' => '경건의 삶', 'desc' => '말씀과 기도가 중심이 되는 경건 생활을 배우고 훈련합니다.'],
                            ['title' => '생명언어의 삶', 'desc' => '언어생활의 변화를 통해 예수님의 인격을 닮아갑니다.'],
                            ['title' => '말씀중보기도의 삶', 'desc' => '하나님의 임재 속에서 기도하는 법을 배웁니다.']
                        ];

                        $delay = 0;
                        foreach ($courses as $course):
                        ?>
                        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-lg transition-shadow flex flex-col md:flex-row md:items-center gap-4 md:gap-8" data-aos="fade-up" data-aos-delay="<?= $delay * 50 ?>">
                            <h3 class="text-2xl font-bold text-slate-800 dark:text-white md:w-[35%] flex-shrink-0">
                                <?= $course['title'] ?>
                            </h3>
                            <p class="text-slate-500 dark:text-slate-400 leading-relaxed text-xl md:w-[65%]">
                                <?= $course['desc'] ?>
                            </p>
                        </div>
                        <?php $delay++; endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php elseif ($sub === 'news'): ?>
    <div class="bg-slate-50 dark:bg-slate-900">
        <section class="max-w-7xl mx-auto px-4 py-10 md:py-20">
            <div class="text-center mb-6" data-aos="fade-up">
                <span class="inline-block px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Church News</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white mb-6">교회소식</h2>
                <div class="w-12 h-1 bg-blue-500 mx-auto mb-6 rounded-full"></div>
                <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed text-xl">
                    창대교회의 새로운 소식을 전해드립니다.
                </p>
            </div>

            <?php
            $id = $_GET['id'] ?? null;
            $mode = $_GET['mode'] ?? 'view'; // view or list
            $page_num = isset($_GET['page_num']) ? max(1, intval($_GET['page_num'])) : 1;
            $category = 'news'; 

            if ($mode === 'view') {
                // 데이터 가져오기 (functions.php의 getBoardPost 함수 사용)
                // ID가 없으면 자동으로 최신글을 가져옴
                $data = getBoardPost($pdo, $category, $id);

                if (!$data || !$data['current']) {
                    echo "<div class='text-center py-20 dark:text-gray-300 font-sans'>등록된 소식이 없습니다.</div>";
                } else {
                    $post = $data['current'];
                    $prevPost = $data['prev'];
                    $nextPost = $data['next'];
            ?>

            <div class="max-w-3xl mx-auto">
                <article class="bg-white dark:bg-slate-800 shadow-sm sm:shadow-md sm:rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700" data-aos="fade-up" data-aos-delay="100">
                    
                    <header class="py-4 px-8 md:py-6 md:px-12 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
                        <h1 class="text-2xl md:text-3xl font-extrabold text-slate-800 dark:text-white leading-tight mb-0">
                            <?= htmlspecialchars($post['title']) ?>
                        </h1>
                    </header>

                    <div class="p-8 md:p-12">
                        <div class="prose prose-slate dark:prose-invert max-w-none font-serif pb-10 md:pb-20 
                                    prose-headings:font-bold prose-p:leading-relaxed prose-p:mb-3 prose-p:text-slate-600 dark:prose-p:text-slate-300 prose-p:text-lg md:prose-p:text-xl">
                            <?= $post['content'] ?>
                        </div>
                    </div>
                </article>

                <!-- 좌우 배치 유지 (Mobile side-by-side) -->
                <nav class="mt-10 flex flex-row gap-4 justify-between items-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-1/2 sm:w-auto flex-1 max-w-sm">
                        <?php if ($prevPost): ?>
                            <a href="?page=intro&sub=news&id=<?= $prevPost['id'] ?>" class="relative group flex items-center w-full px-3 py-6 md:p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:border-blue-500 transition-all shadow-sm overflow-hidden h-full">
                                <!-- 모바일 배경 텍스트 화살표 -->
                                <span class="absolute top-1/2 left-[-1.5rem] -translate-y-1/2 text-[10rem] font-black text-slate-100 dark:text-slate-700 leading-[0] pb-6 md:hidden z-0 select-none group-hover:text-blue-50 dark:group-hover:text-blue-900/20 transition-colors">&lt;</span>
                                <!-- PC 아이콘 -->
                                <svg class="hidden md:block w-5 h-5 mr-4 text-slate-400 group-hover:text-blue-500 transform group-hover:-translate-x-1 transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                <div class="relative z-10 flex flex-col items-start pl-1 md:pl-0">
                                    <span class="text-sm text-blue-500 font-bold uppercase mb-1">이전 소식</span>
                                    <span class="text-base font-semibold text-slate-700 dark:text-slate-300 line-clamp-1 text-left"><?= htmlspecialchars($prevPost['title']) ?></span>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="w-1/2 sm:w-auto flex-1 max-w-sm flex justify-end">
                        <?php if ($nextPost): ?>
                            <a href="?page=intro&sub=news&id=<?= $nextPost['id'] ?>" class="relative group flex items-center justify-end md:justify-end w-full px-3 py-6 md:p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:border-blue-500 transition-all shadow-sm overflow-hidden h-full text-right">
                                <!-- 모바일 배경 텍스트 화살표 -->
                                <span class="absolute top-1/2 right-[-1.5rem] -translate-y-1/2 text-[10rem] font-black text-slate-100 dark:text-slate-700 leading-[0] pb-6 md:hidden z-0 select-none group-hover:text-blue-50 dark:group-hover:text-blue-900/20 transition-colors">&gt;</span>
                                <div class="relative z-10 flex flex-col items-end pr-1 md:pr-0">
                                    <span class="text-sm text-blue-500 font-bold uppercase mb-1">다음 소식</span>
                                    <span class="text-base font-semibold text-slate-700 dark:text-slate-300 line-clamp-1 text-right"><?= htmlspecialchars($nextPost['title']) ?></span>
                                </div>
                                <!-- PC 아이콘 -->
                                <svg class="hidden md:block w-5 h-5 ml-4 text-slate-400 group-hover:text-blue-500 transform group-hover:translate-x-1 transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </nav>

                <div class="mt-12 text-center" data-aos="fade-up" data-aos-delay="300">
                    <a href="?page=intro&sub=news&mode=list" class="inline-flex items-center px-6 py-2 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-full text-sm font-bold hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        전체 소식 목록
                    </a>
                </div>
            </div>
            <?php 
                } 
            } else { 
                // --- 목록 보기 모드 (mode=list) ---
                $limit = 10;
                $offset = ($page_num - 1) * $limit;
                
                // 총 게시물 수
                $countStmt = $pdo->prepare("SELECT COUNT(*) FROM news WHERE published_at <= NOW()");
                $countStmt->execute();
                $total_posts = $countStmt->fetchColumn();
                
                // 목록 조회
                $stmt = $pdo->prepare("SELECT id, title, published_at FROM news WHERE published_at <= NOW() ORDER BY published_at DESC LIMIT :limit OFFSET :offset");
                $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();
                $posts = $stmt->fetchAll();
            ?>
                <div class="max-w-3xl mx-auto">
                    <div class="bg-white dark:bg-slate-800 shadow-sm sm:shadow-md sm:rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 mb-6" data-aos="fade-up" data-aos-delay="100">
                        <ul class="divide-y divide-slate-100 dark:divide-slate-700">
                            <?php if (count($posts) > 0): $delay = 0; foreach ($posts as $post): ?>
                            <li class="group" data-aos="fade-up" data-aos-delay="<?= $delay * 50 ?>">
                                <a href="?page=intro&sub=news&id=<?= $post['id'] ?>" class="block p-6 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                                    <h4 class="font-bold text-slate-800 dark:text-slate-200 group-hover:text-blue-600 dark:group-hover:text-blue-400 text-lg"><?= htmlspecialchars($post['title']) ?></h4>
                                </a>
                            </li>
                            <?php $delay++; endforeach; else: ?>
                                <li class="p-8 text-center text-slate-500">등록된 소식이 없습니다.</li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="w-24">
                            <?php if ($total_posts > $page_num * $limit): ?>
                                <a href="?page=intro&sub=news&mode=list&page_num=<?= $page_num + 1 ?>" class="inline-flex items-center px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-md text-sm font-medium text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700">이전</a>
                            <?php endif; ?>
                        </div>
                        
                        <a href="?page=intro&sub=news" class="px-6 py-2 bg-blue-600 text-white rounded-full text-sm font-bold hover:bg-blue-700 shadow-md transition-colors">최신 소식 보기</a>
                        
                        <div class="w-24 text-right">
                            <?php if ($page_num > 1): ?>
                                <a href="?page=intro&sub=news&mode=list&page_num=<?= $page_num - 1 ?>" class="inline-flex items-center px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-md text-sm font-medium text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700">다음</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </section>
    </div>
<?php elseif ($sub === 'location'): ?>
    <div class="bg-slate-50 dark:bg-slate-900">
        <section class="max-w-7xl mx-auto px-4 py-10 md:py-20">
            <div class="text-center mb-6" data-aos="fade-up">
                <span class="inline-block px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Location</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white mb-6">오시는 길</h2>
                <div class="w-12 h-1 bg-blue-500 mx-auto mb-6 rounded-full"></div>
                <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed text-xl">
                    하나님의 사랑이 머무는 창대교회로 여러분을 초대합니다.
                </p>
            </div>

            <div class="map-wrapper flex flex-col w-full h-[400px] mb-10 shadow-lg" data-aos="fade-up" data-aos-delay="100">
                <div id="daumRoughmapContainer1773408280918" class="root_daum_roughmap root_daum_roughmap_landing w-full grow"></div>

                <div class="bg-[#F9F9F9] border-t border-gray-200 px-3 py-2 flex justify-between items-center shrink-0 h-[36px] z-10">
                    <a href="https://map.kakao.com" target="_blank">
                        <img src="//t1.daumcdn.net/localimg/localimages/07/2018/pc/common/logo_kakaomap.png" alt="카카오맵" class="h-3.5 w-auto">
                    </a>
                    <div class="flex items-center text-base text-gray-600 tracking-tighter font-sans">
                        <a href="https://map.kakao.com/?from=roughmap&q=%EA%B2%BD%EA%B8%B0%EB%8F%84%20%EA%B3%A0%EC%96%91%EC%8B%9C%20%EB%8D%95%EC%96%91%EA%B5%AC%20%EC%A4%91%EC%95%99%EB%A1%9C558%EB%B2%88%EA%B8%B8%207-4&rv=on" target="_blank" class="hover:underline">로드뷰</a>
                        <span class="mx-2 h-2.5 w-px bg-gray-300"></span>
                        <a href="https://map.kakao.com/?from=roughmap&eName=%EA%B2%BD%EA%B8%B0%EB%8F%84%20%EA%B3%A0%EC%96%91%EC%8B%9C%20%EB%8D%95%EC%96%91%EA%B5%AC%20%EC%A4%91%EC%95%99%EB%A1%9C558%EB%B2%88%EA%B8%B8%207-4&eX=463720.62500000146&eY=1145750.625" target="_blank" class="hover:underline font-bold text-black">길찾기</a>
                        <span class="mx-2 h-2.5 w-px bg-gray-300"></span>
                        <a href="https://map.kakao.com/?urlX=463720.62500000146&urlY=1145750.625&name=%EA%B2%BD%EA%B8%B0%EB%8F%84%20%EA%B3%A0%EC%96%91%EC%8B%9C%20%EB%8D%95%EC%96%91%EA%B5%AC%20%EC%A4%91%EC%95%99%EB%A1%9C558%EB%B2%88%EA%B8%B8%207-4&map_type=TYPE_MAP&from=roughmap" target="_blank" class="hover:underline">지도 크게 보기</a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-slate-800 p-8 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 dark:text-white uppercase tracking-tight">주소</h3>
                    </div>
                    <p class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed">
                        경기 고양시 덕양구 중앙로558번길 7-4<br>비전프라자 7층
                    </p>
                </div>

                <a href="tel:031-979-9182" class="group bg-white dark:bg-slate-800 p-8 border border-slate-200 dark:border-slate-700 rounded-2xl hover:border-blue-500 transition-all shadow-sm" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-lg flex items-center justify-center shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 dark:text-white uppercase tracking-tight group-hover:text-blue-600 dark:group-hover:text-blue-400">전화번호</h3>
                    </div>
                    <div>
                        <p class="text-xl font-bold text-slate-800 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400">031-979-9182</p>
                        <p class="text-sm text-slate-400 mt-1 uppercase">Click to call</p>
                    </div>
                </a>

                <div class="bg-white dark:bg-slate-800 p-8 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm" data-aos="fade-up" data-aos-delay="400">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 dark:text-white uppercase tracking-tight">주차</h3>
                    </div>
                    <div>
                        <ul class="text-lg text-slate-600 dark:text-slate-400 space-y-1">
                            <li>• 건물 내 주차장</li>
                            <li>• 롯데마트 별관 주차장</li>
                        </ul>
                        <p class="mt-3 text-[11px] font-bold text-blue-600 bg-blue-50 dark:bg-blue-900/30 dark:text-blue-400 inline-block px-2 py-1 uppercase rounded">롯데마트 별관은 주차 시간을 드립니다</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>
    <script charset="UTF-8">
        new daum.roughmap.Lander({
            "timestamp" : "1773408280918",
            "key" : "j8yax6qhh68",
            "mapWidth" : "100%",
            "mapHeight" : ""
        }).render();
    </script>

    <style>
        /* 1. 카카오 약도 내부 컨테이너들이 부모 높이를 따라가도록 설정 */
        .root_daum_roughmap, 
        .root_daum_roughmap .wrap_map {
            height: 100% !important;
            width: 100% !important;
        }

        /* 카카오 약도 기본 정보창(주소, 전화번호) 숨기기 */
        .root_daum_roughmap .wrap_infos {
            display: none !important;
        }
        
        /* 약도 기본 테두리 제거 및 커스텀 디자인 통합 */
        .root_daum_roughmap {
            border: none !important;
            width: 100% !important;
        }
        
        .root_daum_roughmap .wrap_map {
            height: 100% !important;
        }

        /* 지도 컨테이너 둥근 모서리 적용 */
        .map-wrapper {
            overflow: hidden;
            border: 1px solid #e5e7eb; /* gray-200 */
            border-radius: 0.5rem; /* rounded-lg */
        }
    </style>
<?php else: ?>
    <div class="max-w-7xl mx-auto px-4 py-16 text-center">
        <p class="text-gray-600">페이지를 찾을 수 없습니다.</p>
    </div>
<?php endif; ?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: true, offset: 50 });
</script>