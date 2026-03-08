<?php
/**
 * main.php (Merrypage 컨셉 재배치 버전)
 */

// 1. 최신 주일예배 데이터 가져오기 (worship 로직 활용)
try {
    $stmt = $pdo->prepare("SELECT * FROM sermon WHERE published_at <= NOW() ORDER BY published_at DESC LIMIT 1");
    $stmt->execute();
    $post = $stmt->fetch();
} catch (PDOException $e) { $post = null; }

// 유튜브 ID 추출
$youtube_id = '';
if ($post && !empty($post['youtube_url'])) {
    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $post['youtube_url'], $match)) {
        $youtube_id = $match[1];
    }
}
?>

<section class="relative min-h-[90vh] bg-[#FFD400] flex flex-col justify-center px-6 md:px-20 overflow-hidden">
    <div class="absolute top-1/2 left-0 -translate-y-1/2 w-full overflow-hidden opacity-5 pointer-events-none select-none">
        <h1 class="text-[30vw] font-black text-black whitespace-nowrap tracking-tighter">CHANGDAE</h1>
    </div>

    <div class="relative z-10">
        <h1 class="text-5xl md:text-[8vw] font-black leading-[0.9] text-black uppercase tracking-tighter mb-8 break-keep">
            영혼 구원하여<br>제자 삼는 교회
        </h1>
        <p class="text-xl md:text-2xl font-bold text-black mb-12 max-w-2xl">
            하나님의 사랑이 머무는 곳, <br class="md:hidden">창대교회에 오신 여러분을 환영합니다.
        </p>
        <a href="?page=location" class="inline-block bg-black text-white px-10 py-5 rounded-full font-black text-sm uppercase tracking-widest hover:scale-105 transition-transform border-2 border-black">
            오시는 길 →
        </a>
    </div>
</section>

<section class="py-24 bg-white border-t-[4px] border-black">
    <div class="max-w-[1400px] mx-auto px-6">
        <div class="flex justify-between items-end mb-16 border-b-4 border-black pb-6">
            <h2 class="text-5xl md:text-7xl font-black text-black italic uppercase tracking-tighter">Latest Worship</h2>
            <p class="hidden md:block text-sm font-black text-gray-400 uppercase tracking-widest">주일예배 영상</p>
        </div>

        <?php if ($post): ?>
            <div class="relative mb-12 shadow-[30px_30px_0px_0px_#FFD400] border-[3px] border-black overflow-hidden bg-black aspect-video">
                <?php if ($youtube_id): ?>
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/<?= $youtube_id ?>" frameborder="0" allowfullscreen></iframe>
                <?php else: ?>
                    <div class="w-full h-full flex items-center justify-center text-white font-black italic">VIDEO PREPARING...</div>
                <?php endif; ?>
            </div>

            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-8 border-b-4 border-black pb-10 mb-10">
                <div class="flex flex-col">
                    <span class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-1">Date</span>
                    <span class="text-3xl font-black text-black italic"><?= date('Y. m. d', strtotime($post['published_at'])) ?></span>
                </div>
                <div class="hidden md:block w-px h-12 bg-black/10"></div>
                <div class="flex flex-col">
                    <span class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-1">Passage</span>
                    <span class="text-3xl font-black text-black italic"><?= htmlspecialchars($post['passage']) ?></span>
                </div>
                <div class="hidden md:block w-px h-12 bg-black/10"></div>
                <div class="flex flex-col">
                    <span class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-1">Preacher</span>
                    <span class="text-3xl font-black text-black italic"><?= htmlspecialchars($post['preacher']) ?></span>
                </div>
                <div class="md:ml-auto">
                    <a href="?page=worship" class="text-sm font-black uppercase border-b-4 border-[#FFD400] hover:bg-[#FFD400] transition-colors">More Worships</a>
                </div>
            </div>
            
            <h3 class="text-4xl md:text-5xl font-black text-black leading-none break-keep">
                "<?= htmlspecialchars($post['title']) ?>"
            </h3>
        <?php else: ?>
            <div class="py-20 text-center font-black text-gray-300 text-3xl italic uppercase">No Sermon Found</div>
        <?php endif; ?>
    </div>
</section>

<style>
    /* Merrypage 핵심 폰트 설정 */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@900&display=swap');
    .font-black { font-family: 'Inter', sans-serif; font-weight: 900; }
</style>