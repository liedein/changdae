<?php
/**
 * Merrypage Concept Main Page (main.php)
 * 최신 주일예배 영상 1개 집중형 레이아웃
 */

$category = 'sermon'; // DB 테이블명

// 1. 최신 설교 1개 데이터 가져오기
try {
    $stmt = $pdo->prepare("SELECT * FROM $category WHERE published_at <= NOW() ORDER BY published_at DESC LIMIT 1");
    $stmt->execute();
    $post = $stmt->fetch();
} catch (PDOException $e) {
    $post = null;
}

// 2. 유튜브 ID 추출 로직
$youtube_id = '';
if ($post && !empty($post['youtube_url'])) {
    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $post['youtube_url'], $match)) {
        $youtube_id = $match[1];
    }
}
?>

<section class="relative min-h-[80vh] bg-[#FFD400] flex flex-col justify-center px-6 md:px-20 pt-32 pb-20 overflow-hidden border-b-[4px] border-black">
    <div class="absolute top-10 left-0 w-full overflow-hidden opacity-10 pointer-events-none select-none">
        <h1 class="text-[25vw] font-black leading-none text-black whitespace-nowrap tracking-tighter">
            SUNDAY WORSHIP
        </h1>
    </div>

    <div class="relative z-10 max-w-[1400px] mx-auto w-full">
        <div class="mb-12">
            <span class="inline-block bg-black text-[#FFD400] px-4 py-1 text-xs font-black uppercase tracking-widest mb-4">Latest Message</span>
            <h2 class="text-5xl md:text-[7vw] font-black text-black leading-[0.9] tracking-tighter break-keep">
                <?= $post ? htmlspecialchars($post['title']) : "HELLO, WE ARE CHANGDAE" ?>
            </h2>
        </div>

        <div class="relative group">
            <div class="absolute top-4 left-4 w-full h-full bg-black border-2 border-black"></div>
            <div class="relative aspect-video w-full bg-black border-[3px] border-black overflow-hidden shadow-2xl">
                <?php if ($youtube_id): ?>
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/<?= $youtube_id ?>?rel=0&modestbranding=1" frameborder="0" allowfullscreen></iframe>
                <?php else: ?>
                    <div class="w-full h-full flex items-center justify-center text-white font-black uppercase italic text-2xl">
                        Preparing for Service...
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($post): ?>
        <div class="mt-12 flex flex-col md:flex-row items-start md:items-center justify-between border-t-[3px] border-black pt-8 gap-8">
            <div class="flex flex-col">
                <span class="text-[10px] font-black uppercase tracking-widest text-black/50 mb-1">Date</span>
                <span class="text-2xl md:text-3xl font-black text-black italic">
                    <?= date('Y / m / d', strtotime($post['published_at'])) ?>
                </span>
            </div>
            
            <div class="flex flex-col">
                <span class="text-[10px] font-black uppercase tracking-widest text-black/50 mb-1">Passage</span>
                <span class="text-2xl md:text-3xl font-black text-black italic">
                    <?= htmlspecialchars($post['passage']) ?>
                </span>
            </div>

            <div class="flex flex-col">
                <span class="text-[10px] font-black uppercase tracking-widest text-black/50 mb-1">Preacher</span>
                <span class="text-2xl md:text-3xl font-black text-black italic">
                    <?= htmlspecialchars($post['preacher']) ?>
                </span>
            </div>

            <div class="md:ml-auto">
                <a href="?page=worship_list" class="inline-block bg-black text-white px-8 py-4 rounded-full font-black text-sm hover:bg-white hover:text-black transition-all border-2 border-black uppercase tracking-widest">
                    All Sermons →
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<section class="py-20 bg-white">
    </section>

<style>
    /* Merrypage 전용 폰트 및 스타일 */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@900&display=swap');
    
    body {
        background-color: #FFD400;
        font-family: 'Inter', sans-serif;
    }

    .font-black {
        font-weight: 900;
    }

    /* 스크롤바 디자인 (옐로우 컨셉 유지) */
    ::-webkit-scrollbar { width: 10px; }
    ::-webkit-scrollbar-track { background: #FFD400; }
    ::-webkit-scrollbar-thumb { background: #000; }
</style>