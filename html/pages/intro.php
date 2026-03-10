<?php
$sub = $_GET['sub'] ?? 'vision';
?>

<?php if ($sub === 'vision'): ?>
    <div class="bg-slate-50 dark:bg-slate-900">
        <section class="max-w-[1800px] mx-auto px-4 py-16 md:py-24">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Vision & Philosophy</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white mb-6">비전과 철학</h2>
                <div class="w-12 h-1 bg-blue-500 mx-auto mb-8 rounded-full"></div>
                <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed text-lg">
                    창대교회의 비전과 목회 철학을 소개합니다.
                </p>
            </div>
            <div class="text-center py-20">
                <p class="text-gray-600 dark:text-gray-400">준비 중인 페이지입니다.</p>
            </div>
        </section>
    </div>
<?php elseif ($sub === 'staff'): ?>
    <div class="bg-slate-50 dark:bg-slate-900">
        <section class="max-w-[1800px] mx-auto px-4 py-16 md:py-24">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Serving People</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white mb-6">섬기는 사람들</h2>
                <div class="w-12 h-1 bg-blue-500 mx-auto mb-8 rounded-full"></div>
                <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed text-lg">
                    창대교회를 섬기는 교역자들을 소개합니다.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
                <?php
                $staffs = [
                    ['name' => '김은택', 'role' => '담임목사', 'img' => 'https://placehold.co/400x500/1a365d/ffffff?text=Pastor'],
                    ['name' => '김성진', 'role' => '원로목사', 'img' => 'https://placehold.co/400x500/e2e8f0/64748b?text=Staff'],
                    ['name' => '손재용', 'role' => '장로', 'img' => 'https://placehold.co/400x500/e2e8f0/64748b?text=Staff'],
                    // 필요 시 추가
                ];
                ?>
                <?php foreach ($staffs as $staff): ?>
                <div class="group">
                    <div class="aspect-[4/5] w-full overflow-hidden rounded-lg bg-gray-200 dark:bg-gray-700 mb-4">
                        <img src="<?= $staff['img'] ?>" alt="<?= $staff['name'] ?>" class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <h3 class="text-xl font-bold text-charcoal dark:text-white"><?= $staff['name'] ?></h3>
                    <p class="text-sm font-medium text-deepblue dark:text-blue-400 mb-1"><?= $staff['role'] ?></p>
                    <?php if (!empty($staff['email'])): ?>
                    <a href="mailto:<?= $staff['email'] ?>" class="text-sm text-gray-500 hover:text-gray-800 dark:hover:text-gray-300 transition-colors"><?= $staff['email'] ?></a>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
<?php elseif ($sub === 'cell'): ?>
    <div class="bg-slate-50 dark:bg-slate-900">
        <section class="max-w-[1800px] mx-auto px-4 py-16 md:py-24">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Cell Groups</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white mb-6">목장</h2>
                <div class="w-12 h-1 bg-blue-500 mx-auto mb-8 rounded-full"></div>
                <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed text-lg">
                    성도들이 삶을 나누고 함께 기도하며 사랑을 실천하는 가족 공동체입니다.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
                <?php
                $cells = [
                    ['name' => '온유목장', 'leader' => '김철수 목자', 'desc' => '매주 금요일 저녁 8시', 'img' => 'https://placehold.co/400x300/f3f4f6/9ca3af?text=Cell+Group'],
                    ['name' => '화평목장', 'leader' => '이영희 목자', 'desc' => '매주 토요일 오후 5시', 'img' => 'https://placehold.co/400x300/f3f4f6/9ca3af?text=Cell+Group'],
                    ['name' => '충성목장', 'leader' => '박민수 목자', 'desc' => '매주 주일 오후 2시', 'img' => 'https://placehold.co/400x300/f3f4f6/9ca3af?text=Cell+Group'],
                    ['name' => '사랑목장', 'leader' => '최지혜 목자', 'desc' => '매주 목요일 오전 11시', 'img' => 'https://placehold.co/400x300/f3f4f6/9ca3af?text=Cell+Group'],
                    ['name' => '기쁨목장', 'leader' => '정다윗 목자', 'desc' => '매주 금요일 저녁 9시', 'img' => 'https://placehold.co/400x300/f3f4f6/9ca3af?text=Cell+Group'],
                ];
                ?>
                <?php foreach ($cells as $cell): ?>
                <div class="group bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden border border-gray-100 dark:border-gray-700">
                    <div class="aspect-video w-full overflow-hidden bg-gray-200 dark:bg-gray-700">
                        <img src="<?= $cell['img'] ?>" alt="<?= $cell['name'] ?>" class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-charcoal dark:text-white mb-1"><?= $cell['name'] ?></h3>
                        <p class="text-deepblue dark:text-blue-400 font-medium mb-3"><?= $cell['leader'] ?></p>
                        <p class="text-sm text-gray-500 dark:text-gray-400"><?= $cell['desc'] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
<?php elseif ($sub === 'study'): ?>
    <div class="bg-slate-50 dark:bg-slate-900">
        <section class="max-w-6xl mx-auto px-4 py-16 md:py-24">
            <?php
            // 제목 영역 HTML (모바일/데스크탑 분기 처리를 위해 변수화)
            $studyTitleHtml = '
            <div class="text-center mb-12 lg:mb-16">
                <span class="inline-block px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Christian Living Study</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white mb-6">삶공부</h2>
                <div class="w-12 h-1 bg-blue-500 mx-auto mb-8 rounded-full"></div>
                <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed text-lg">
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
                <div class="lg:w-1/3 order-1">
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

                        foreach ($courses as $course):
                        ?>
                        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-lg transition-shadow flex flex-col md:flex-row md:items-center gap-4 md:gap-8">
                            <h3 class="text-xl font-bold text-slate-800 dark:text-white md:w-1/4 flex-shrink-0">
                                <?= $course['title'] ?>
                            </h3>
                            <p class="text-slate-500 dark:text-slate-400 leading-relaxed text-sm md:w-3/4">
                                <?= $course['desc'] ?>
                            </p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php elseif ($sub === 'news'): ?>
    <div class="bg-slate-50 dark:bg-slate-900">
        <section class="max-w-[1800px] mx-auto px-4 py-16 md:py-24">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Church News</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white mb-6">교회소식</h2>
                <div class="w-12 h-1 bg-blue-500 mx-auto mb-8 rounded-full"></div>
                <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed text-lg">
                    창대교회의 새로운 소식을 전해드립니다.
                </p>
            </div>

            <?php
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

            <div class="max-w-3xl mx-auto">
                <article class="bg-white dark:bg-slate-800 shadow-sm sm:shadow-md sm:rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700">
                    
                    <header class="p-8 md:p-12 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-[10px] font-bold uppercase tracking-widest rounded-full">News Detail</span>
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
                            <a href="?page=intro&sub=news&id=<?= $prevPost['id'] ?>" class="group h-full flex items-center p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:border-blue-500 transition-all shadow-sm">
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
                            <a href="?page=intro&sub=news&id=<?= $nextPost['id'] ?>" class="group h-full flex items-center justify-between p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:border-blue-500 transition-all shadow-sm text-right">
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
                    <a href="?page=intro&sub=news" class="inline-flex items-center px-6 py-2 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-full text-sm font-bold hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        전체 목록 보기
                    </a>
                </div>
            </div>
            <?php } ?>
        </section>
    </div>
<?php elseif ($sub === 'location'): ?>
    <div class="bg-slate-50 dark:bg-slate-900">
        <section class="max-w-[1800px] mx-auto px-4 py-16 md:py-24">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Location</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white mb-6">오시는 길</h2>
                <div class="w-12 h-1 bg-blue-500 mx-auto mb-8 rounded-full"></div>
                <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed text-lg">
                    하나님의 사랑이 머무는 창대교회로 여러분을 초대합니다.
                </p>
            </div>

            <div class="mb-10 shadow-lg rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 bg-white">
                <div id="daumRoughmapContainer1772859002282" class="root_daum_roughmap root_daum_roughmap_landing" style="width:100% !important;"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-slate-800 p-8 border border-slate-200 dark:border-slate-700 rounded-2xl flex items-start gap-4 shadow-sm">
                    <div class="w-10 h-10 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-lg flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800 dark:text-white mb-2 uppercase tracking-tight">Address</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">경기 고양시 덕양구 중앙로558번길 7-4<br>비전프라자 7층</p>
                    </div>
                </div>

                <a href="tel:031-979-9182" class="group bg-white dark:bg-slate-800 p-8 border border-slate-200 dark:border-slate-700 rounded-2xl flex items-start gap-4 hover:border-blue-500 transition-all shadow-sm">
                    <div class="w-10 h-10 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-lg flex items-center justify-center shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800 dark:text-white mb-2 uppercase tracking-tight group-hover:text-blue-600 dark:group-hover:text-blue-400">Phone</h3>
                        <p class="text-xl font-bold text-slate-800 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400">031-979-9182</p>
                        <p class="text-[10px] text-slate-400 mt-1 uppercase">Click to call</p>
                    </div>
                </a>

                <div class="bg-white dark:bg-slate-800 p-8 border border-slate-200 dark:border-slate-700 rounded-2xl flex items-start gap-4 shadow-sm">
                    <div class="w-10 h-10 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-lg flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800 dark:text-white mb-2 uppercase tracking-tight">Parking</h3>
                        <ul class="text-sm text-slate-600 dark:text-slate-400 space-y-1">
                            <li>• 건물 내 주차장</li>
                            <li>• 롯데마트 별관 주차장</li>
                        </ul>
                        <p class="mt-3 text-[11px] font-bold text-blue-600 bg-blue-50 dark:bg-blue-900/30 dark:text-blue-400 inline-block px-2 py-1 uppercase rounded">Free Parking Pass</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>
    <script charset="UTF-8">
        new daum.roughmap.Lander({
            "timestamp" : "1772859002282",
            "key" : "iiwsiig44hv",
            "mapWidth" : "100%",
            "mapHeight" : "450"
        }).render();
    </script>

    <style>
        /* 1. 카카오맵 기본 하단 정보 영역(주소, 전화번호 등) 강제 제거 */
        .root_daum_roughmap .wrap_controllers,
        .root_daum_roughmap .hide,
        .root_daum_roughmap .foot_type1 { display: none !important; }
        
        /* 2. 지도 테두리 및 그림자 보정 */
        .root_daum_roughmap { width: 100% !important; border: none !important; padding: 0 !important; }
        .root_daum_roughmap .wrap_map { height: 450px !important; border: none !important; }
    </style>
<?php else: ?>
    <div class="max-w-[1800px] mx-auto px-4 py-20 text-center">
        <p class="text-gray-600">페이지를 찾을 수 없습니다.</p>
    </div>
<?php endif; ?>