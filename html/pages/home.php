<?php
/**
 * home.php - 메인 페이지 (강화된 히어로 버전)
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

// 2. 유튜브 ID 추출
$youtube_id = '';
if ($post && !empty($post['youtube_url'])) {
    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $post['youtube_url'], $match)) {
        $youtube_id = $match[1];
    }
}
?>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<?php // --- 히어로 섹션 (간격 및 색상 조정 버전) --- ?>
<section class="relative min-h-[90vh] bg-[#FFD400] flex flex-col justify-center px-4 md:px-10 overflow-hidden">
    <div class="absolute top-1/2 left-0 -translate-y-1/2 w-full overflow-hidden opacity-5 pointer-events-none select-none">
        <h1 class="text-[40vw] font-black text-black whitespace-nowrap tracking-tighter uppercase" data-aos="fade-up" data-aos-duration="1500">CHANGDAE</h1>
    </div>

    <div class="relative z-10 w-full mx-auto">
        <div class="flex flex-col w-full space-y-4 md:space-y-0"> 
            <h1 class="text-[18vw] md:text-[10vw] font-black leading-[1.1] md:leading-none text-black uppercase tracking-tighter whitespace-nowrap" data-aos="fade-up" data-aos-delay="100">
                영혼 구원하여
            </h1>
            
            <h1 class="text-[18vw] md:text-[10vw] font-black leading-[1.1] md:leading-none text-[#FFD400] uppercase tracking-tighter self-end text-right whitespace-nowrap mt-4 md:mt-0" 
                data-aos="fade-up" data-aos-delay="300"
                style="text-shadow: -2px -2px 0 #000, 2px -2px 0 #000, -2px 2px 0 #000, 2px 2px 0 #000, -2px 0 0 #000, 2px 0 0 #000, 0 -2px 0 #000, 0 2px 0 #000; padding-bottom: 2vw;">
                제자 삼는 교회
            </h1>
        </div>

        <div class="mt-20 px-[10%] md:px-[60pt] flex flex-col md:flex-row md:items-end justify-between gap-10">
            <p class="text-3xl md:text-4xl font-bold text-black max-w-3xl leading-tight tracking-tight" data-aos="fade-up" data-aos-delay="500">
                하나님의 사랑이 머무는 곳,<br>
                창대교회에 오신 여러분을 환영합니다.
            </p>
            <a href="?page=intro&sub=location" data-aos="fade-up" data-aos-delay="700" class="inline-block bg-black text-white px-12 py-6 rounded-full font-black text-xl uppercase tracking-widest hover:scale-105 hover:bg-white hover:text-black transition-all border-4 border-black shrink-0 shadow-[8px_8px_0px_0px_rgba(255,255,255,0.3)] text-center">
                오시는 길 →
            </a>
        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: true });
</script>

<style>
    /* 모바일에서 글자 크기와 자간 최적화 */
    @media (max-width: 768px) {
        h1 { 
            letter-spacing: -0.07em; 
            /* 텍스트가 너무 크면 살짝 줄이되 2배 기조 유지 */
            font-size: 14vw; 
        }
    }
</style>

<?php // --- 최신 설교 영상 섹션 (상단 선 제거 및 기존 너비 유지) --- ?>
<section class="py-24 bg-white dark:bg-[#1a1a1a] transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6"> <div class="flex flex-col md:flex-row justify-between items-baseline mb-12 border-b-4 border-black dark:border-[#FFD400] pb-6" data-aos="fade-up">
            <h2 class="text-6xl md:text-8xl font-black text-black dark:text-[#FFD400] tracking-tighter italic uppercase">Sunday</h2>
            <p class="text-xl font-bold text-black dark:text-white mt-4 md:mt-0 uppercase tracking-widest">Worship Service</p>
        </div>

        <?php if ($post): ?>
            <div class="mb-10" data-aos="fade-up" data-aos-delay="200">
                <div class="relative aspect-video w-full bg-black border-[3px] border-black dark:border-[#FFD400] shadow-[20px_20px_0px_0px_#FFD400] overflow-hidden">
                    <?php if ($youtube_id): ?>
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/<?= $youtube_id ?>?rel=0&modestbranding=1" frameborder="0" allowfullscreen></iframe>
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center text-white font-black uppercase tracking-tighter text-2xl">No Video Address</div>
                    <?php endif; ?>
                </div>
                
                <div class="mt-10 grid grid-cols-1 md:grid-cols-3 border-t-2 border-l-2 border-black dark:border-[#FFD400]">
                    <div class="p-8 border-r-2 border-b-2 border-black dark:border-[#FFD400] bg-white dark:bg-[#262626]">
                        <span class="block text-sm font-black uppercase mb-2 text-gray-400">Subject</span>
                        <h3 class="text-3xl font-black text-black dark:text-white leading-none"><?= htmlspecialchars($post['title']) ?></h3>
                    </div>
                    <div class="p-8 border-r-2 border-b-2 border-black dark:border-[#FFD400] bg-white dark:bg-[#262626]">
                        <span class="block text-sm font-black uppercase mb-2 text-gray-400">Passage</span>
                        <p class="text-2xl font-bold text-black dark:text-white italic leading-none"><?= htmlspecialchars($post['passage']) ?></p>
                    </div>
                    <div class="p-8 border-r-2 border-b-2 border-black dark:border-[#FFD400] bg-white dark:bg-[#262626]">
                        <span class="block text-sm font-black uppercase mb-2 text-gray-400">Preacher</span>
                        <p class="text-2xl font-bold text-black dark:text-white italic leading-none"><?= htmlspecialchars($post['preacher']) ?></p>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-8">
                    <span class="text-2xl font-black text-black dark:text-[#FFD400] italic">
                        <?= date('Y / m / d', strtotime($post['published_at'])) ?>
                    </span>
                    <a href="?page=worship&sub=sermon" class="text-sm font-black uppercase border-b-4 border-[#FFD400] dark:text-white hover:bg-[#FFD400] hover:text-black transition-colors">
                        Archive →
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="py-20 text-center font-black text-gray-300 text-3xl italic uppercase">No Sermon Found</div>
        <?php endif; ?>
    </div>
</section>