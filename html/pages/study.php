<?php
/**
 * 삶공부 안내 페이지 (study.php)
 */
?>

<div class="bg-slate-50 dark:bg-slate-900 min-h-screen">
    <section class="max-w-6xl mx-auto px-4 py-16 md:py-24">
        <div class="text-center mb-16">
            <span class="inline-block px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Christian Living Study</span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 dark:text-white mb-6">삶공부 여정</h2>
            <div class="w-12 h-1 bg-blue-500 mx-auto mb-8 rounded-full"></div>
            <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed text-lg">
                지식 위주의 공부에서 벗어나 삶의 변화를 목표로 합니다.<br class="hidden md:block"> 
                하나님을 경험하고 성경적인 가치관을 세우는 축복의 통로입니다.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $courses = [
                ['title' => '예수영접모임', 'desc' => '예수님이 누구신지 듣고 그분을 마음에 모십니다.', 'icon' => '🤝', 'color' => 'bg-orange-50 text-orange-600'],
                ['title' => '행복한 삶', 'desc' => '내가 누구인지, 삶의 진정한 행복은 어디에 있는지 생각해 봅니다.', 'icon' => '😊', 'color' => 'bg-yellow-50 text-yellow-600'],
                ['title' => '회복의 삶', 'desc' => '예수 그리스도 안에서의 회복을 통해 더욱 복음의 삶으로 나아갑니다.', 'icon' => '🌿', 'color' => 'bg-green-50 text-green-600'],
                ['title' => '예비부부의 삶', 'desc' => '나와 상대방을 바로 알고 결혼에 대한 바른 기대와 계획을 갖게 합니다.', 'icon' => '💍', 'color' => 'bg-pink-50 text-pink-600'],
                ['title' => '생명의 삶', 'desc' => '복음의 핵심을 공부하며 신앙의 기초를 다집니다.', 'icon' => '📖', 'color' => 'bg-blue-50 text-blue-600'],
                ['title' => '경건의 삶', 'desc' => '말씀과 기도가 중심이 되는 경건 생활을 배우고 훈련합니다.', 'icon' => '🙏', 'color' => 'bg-indigo-50 text-indigo-600'],
                ['title' => '생명언어의 삶', 'desc' => '언어생활의 변화를 통해 예수님의 인격을 닮아갑니다.', 'icon' => '💬', 'color' => 'bg-teal-50 text-teal-600'],
                ['title' => '말씀중보기도의 삶', 'desc' => '하나님의 임재 속에서 기도하는 법을 배웁니다.', 'icon' => '🔥', 'color' => 'bg-rose-50 text-rose-600']
            ];

            foreach ($courses as $course):
            ?>
            <div class="group bg-white dark:bg-slate-800 p-8 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <div class="flex flex-col h-full">
                    <div class="w-16 h-16 <?= $course['color'] ?> rounded-2xl flex items-center justify-center text-3xl mb-8 shadow-sm group-hover:rotate-6 transition-transform">
                        <?= $course['icon'] ?>
                    </div>
                    
                    <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-4"><?= $course['title'] ?></h3>
                    <p class="text-slate-500 dark:text-slate-400 leading-relaxed text-sm flex-1">
                        <?= $course['desc'] ?>
                    </p>
                    
                    <div class="mt-8 pt-6 border-t border-slate-50 dark:border-slate-700 flex items-center justify-between">
                        <span class="text-[10px] font-bold text-slate-300 dark:text-slate-500 uppercase tracking-widest">Life Study</span>
                        <div class="w-8 h-8 rounded-full bg-slate-50 dark:bg-slate-700 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>