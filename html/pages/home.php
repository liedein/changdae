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

<section class="py-24 bg-white">
    <div class="max-w-[1800px] mx-auto px-6">
        
        <div class="flex justify-between items-end mb-16 border-b-4 border-black pb-6">
            <h2 class="text-5xl md:text-7xl font-black text-black italic uppercase tracking-tighter">Latest Worship</h2>
            <p class="text-sm font-black text-black uppercase tracking-[0.3em]">주일예배</p>
        </div>

        <?php if ($post): ?>
            <div class="relative w-full bg-black border-[3px] border-black overflow-hidden aspect-video">
                <?php if ($youtube_id): ?>
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/<?= $youtube_id ?>" frameborder="0" allowfullscreen></iframe>
                <?php else: ?>
                    <div class="w-full h-full flex items-center justify-center text-white font-black italic">VIDEO PREPARING...</div>
                <?php endif; ?>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 border-l border-black mt-0">
                <div class="md:col-span-2 p-8 border-r border-b border-black">
                    <span class="block text-[10px] font-black uppercase text-gray-400 mb-2">Subject</span>
                    <h3 class="text-3xl font-black text-black leading-tight">"<?= htmlspecialchars($post['title']) ?>"</h3>
                </div>
                <div class="p-8 border-r border-b border-black">
                    <span class="block text-[10px] font-black uppercase text-gray-400 mb-2">Passage</span>
                    <p class="text-xl font-black text-black italic"><?= htmlspecialchars($post['passage']) ?></p>
                </div>
                <div class="p-8 border-r border-b border-black">
                    <span class="block text-[10px] font-black uppercase text-gray-400 mb-2">Preacher</span>
                    <p class="text-xl font-black text-black italic"><?= htmlspecialchars($post['preacher']) ?></p>
                </div>
            </div>

            <div class="flex justify-between items-center mt-8 px-2">
                <span class="text-2xl font-black text-black italic">
                    <?= date('Y / m / d', strtotime($post['published_at'])) ?>
                </span>
                <a href="?page=worship" class="group flex items-center gap-3 font-black text-sm uppercase tracking-widest">
                    View Archive 
                    <span class="w-10 h-10 rounded-full border-2 border-black flex items-center justify-center group-hover:bg-[#FFD400] transition-colors">→</span>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>