<section class="relative h-[80vh] flex items-center justify-center overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1438232992991-995b7058bbb3?q=80&w=2073&auto=format&fit=crop" alt="Church Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/40 dark:bg-black/60 transition-colors duration-300"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-10 text-center text-white px-4 animate-fade-in-up">
        <h1 class="text-4xl md:text-6xl font-bold font-serif mb-6 tracking-tight leading-tight">
            영혼 구원하여<br class="md:hidden" /> 제자 삼는 교회
        </h1>
        <p class="text-lg md:text-xl font-light opacity-90 mb-10 max-w-2xl mx-auto">
            하나님의 사랑이 머무는 곳, 창대교회에 오신 여러분을 환영합니다.
        </p>
        <a href="?page=intro&sub=location" class="inline-block border border-white px-8 py-3 text-sm font-medium hover:bg-white hover:text-charcoal transition-all duration-300">
            오시는 길
        </a>
    </div>
</section>

<!-- Latest News Section -->
<section class="py-20 bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-charcoal dark:text-white mb-4 font-serif">창대소식</h2>
            <div class="w-12 h-1 bg-deepblue mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php
            // 최신 소식 3개 가져오기 (카테고리 'news')
            try {
                // news 테이블 조회
                $stmt = $pdo->query("SELECT * FROM news WHERE published_at <= NOW() ORDER BY published_at DESC LIMIT 3");
                $newsItems = $stmt->fetchAll();
            } catch (PDOException $e) {
                $newsItems = [];
            }

            if (count($newsItems) > 0):
                foreach ($newsItems as $item):
            ?>
                <a href="?page=board_view&cat=news&id=<?= $item['id'] ?>" class="group block bg-white dark:bg-gray-800 shadow-sm hover:shadow-xl transition-all duration-300 p-8 border border-gray-100 dark:border-gray-700 h-full flex flex-col">
                    <div class="mb-4 text-sm text-deepblue dark:text-blue-400 font-medium">
                        <?= date('Y.m.d', strtotime($item['published_at'])) ?>
                    </div>
                    <h3 class="text-xl font-bold text-charcoal dark:text-white mb-3 group-hover:text-deepblue dark:group-hover:text-blue-400 transition-colors line-clamp-1">
                        <?= htmlspecialchars($item['title']) ?>
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 line-clamp-3 text-sm leading-relaxed flex-grow">
                        <?= strip_tags($item['content']) ?>
                    </p>
                </a>
            <?php 
                endforeach;
            else:
            ?>
                <div class="col-span-3 text-center py-10 text-gray-500 dark:text-gray-400">
                    등록된 소식이 없습니다.
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>