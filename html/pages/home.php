<?php
/**
 * home.php - 메인 페이지
 * 상단: 옐로우 히어로 / 하단: 화이트 예배 영상 (단일)
 */

$category = 'sermon'; 

// 1. DB에서 최신 설교 1개 가져오기
try {
    $stmt = $pdo->prepare("SELECT * FROM $category WHERE published_at <= NOW() ORDER BY published_at DESC LIMIT 1");
    $stmt->execute();
    $post = $stmt->fetch();
} catch (PDOException $e) {
    $post = null;
}

// 2. 유튜브 ID 추출 (이 로직이 있어야 에러가 안 납니다)
$youtube_id = '';
if ($post && !empty($post['youtube_url'])) {
    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $post['youtube_url'], $match)) {
        $youtube_id = $match[1];
    }
}
?>

<?php // --- 히어로 섹션 --- ?>
<section class="relative min-h-[85vh] bg-[#FFD400] flex flex-col justify-center px-6 md:px-20 overflow-hidden">
    <div class="relative z-10">
        <h1 class="text-5xl md:text-[8vw] font-black leading-[0.9] text-black uppercase tracking-tighter mb-8 break-keep">
            영혼 구원하여<br>제자 삼는 교회
        </h1>
        <p class="text-xl md:text-2xl font-bold text-black mb-12 max-w-2xl">
            하나님의 사랑이 머무는 곳, 창대교회에 오신 여러분을 환영합니다.
        </p>
        <a href="?page=location" class="inline-block bg-black text-white px-10 py-5 rounded-full font-black text-sm uppercase tracking-widest hover:scale-105 transition-all border-2 border-black">
            오시는 길 →
        </a>
    </div>
</section>

<?php // --- 최신 설교 영상 섹션 --- ?>
<section class="py-24 bg-white dark:bg-[#1a1a1a] border-t-4 border-black dark:border-[#FFD400] transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="flex flex-col md:flex-row justify-between items-baseline mb-12 border-b-4 border-black dark:border-[#FFD400] pb-6">
            <h2 class="text-6xl md:text-8xl font-black text-black dark:text-[#FFD400] tracking-tighter italic uppercase">Sunday</h2>
            <p class="text-xl font-bold text-black dark:text-white mt-4 md:mt-0 uppercase tracking-widest">Worship Service</p>
        </div>

        <?php if ($post): ?>
            <div class="mb-10">
                <div class="relative aspect-video w-full bg-black border-[3px] border-black dark:border-[#FFD400] shadow-[20px_20px_0px_0px_#FFD400] overflow-hidden">
                    <?php if ($youtube_id): ?>
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/<?= $youtube_id ?>?rel=0&modestbranding=1" frameborder="0" allowfullscreen></iframe>
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center text-white font-black uppercase tracking-tighter text-2xl font-black">No Video Address</div>
                    <?php endif; ?>
                </div>
                
                <div class="mt-10 grid grid-cols-1 md:grid-cols-3 border-t-2 border-l-2 border-black dark:border-[#FFD400]">
                    <div class="p-8 border-r-2 border-b-2 border-black dark:border-[#FFD400] bg-white dark:bg-[#262626]">
                        <span class="block text-[10px] font-black uppercase mb-2 text-gray-400">Subject</span>
                        <h3 class="text-3xl font-black text-black dark:text-white leading-none"><?= htmlspecialchars($post['title']) ?></h3>
                    </div>
                    <div class="p-8 border-r-2 border-b-2 border-black dark:border-[#FFD400] bg-white dark:bg-[#262626]">
                        <span class="block text-[10px] font-black uppercase mb-2 text-gray-400">Passage</span>
                        <p class="text-2xl font-bold text-black dark:text-white italic leading-none"><?= htmlspecialchars($post['passage']) ?></p>
                    </div>
                    <div class="p-8 border-r-2 border-b-2 border-black dark:border-[#FFD400] bg-white dark:bg-[#262626]">
                        <span class="block text-[10px] font-black uppercase mb-2 text-gray-400">Preacher</span>
                        <p class="text-2xl font-bold text-black dark:text-white italic leading-none"><?= htmlspecialchars($post['preacher']) ?></p>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-8">
                    <span class="text-2xl font-black text-black dark:text-[#FFD400] italic">
                        <?= date('Y / m / d', strtotime($post['published_at'])) ?>
                    </span>
                    <a href="?page=worship" class="text-sm font-black uppercase border-b-4 border-[#FFD400] dark:text-white hover:bg-[#FFD400] hover:text-black transition-colors">
                        Archive →
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="py-20 text-center font-black text-gray-300 text-3xl italic uppercase">No Sermon Found</div>
        <?php endif; ?>
    </div>
</section>