<?php
/**
 * Merrypage Concept Full Header - Welcome Menu Fixed
 */
// 현재 페이지 파라미터 가져오기 (Active 상태 표시용)
$currentPage = isset($_GET['page']) ? $_GET['page'] : 'home';
$currentSub = isset($_GET['sub']) ? $_GET['sub'] : '';

$menuItems = [
    'welcome' => ['title' => '환영합니다', 'url' => '?page=welcome', 'sub' => []],
    'intro' => [
        'title' => '소개합니다',
        'sub' => [
            'vision' => ['title' => '비전과 철학', 'url' => '?page=intro&sub=vision'],
            'staff' => ['title' => '섬기는 사람들', 'url' => '?page=intro&sub=staff'],
            'cell' => ['title' => '목장', 'url' => '?page=intro&sub=cell'],
            'study' => ['title' => '삶공부', 'url' => '?page=intro&sub=study'],
            'news' => ['title' => '교회소식', 'url' => '?page=intro&sub=news'],
            'location' => ['title' => '오시는 길', 'url' => '?page=intro&sub=location'],
        ]
    ],
    'worship' => [
        'title' => '예배합니다',
        'sub' => [
            'sermon' => ['title' => '주일예배', 'url' => '?page=worship&sub=sermon'],
            'videos' => ['title' => '특별영상', 'url' => '?page=worship&sub=videos'],
            'bulletin' => ['title' => '주보', 'url' => '?page=worship&sub=bulletin'],
        ]
    ],
    'together' => [
        'title' => '함께합니다',
        'sub' => [
            'missionary' => ['title' => '파송 및 후원선교사', 'url' => '?page=together&sub=missionary'],
            'neighbor' => ['title' => '이웃섬김', 'url' => '?page=together&sub=neighbor'],
            'column' => ['title' => '목회칼럼', 'url' => '?page=together&sub=column'],
        ]
    ]
];
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@900&display=swap');
    .font-black { font-family: 'Inter', sans-serif; font-weight: 900; }
    .dark #main-header { background-color: #1a1a1a; border-bottom-color: #FFD400; }
    .dark #main-header a, .dark #main-header button { color: #FFD400; }
    .dark #main-header .logo-dot { color: #fff; }
</style>

<header id="main-header" class="fixed w-full top-0 z-[60] bg-[#FFD400] border-b-2 border-black transition-colors duration-300">
    <div class="max-w-[1800px] mx-auto px-6 h-20 md:h-24 flex justify-between items-center">
        
        <div class="flex-shrink-0">
            <a href="/" class="text-3xl md:text-4xl font-black tracking-tighter text-black uppercase">
                창대교회<span class="logo-dot text-white">.</span>
            </a>
        </div>

        <nav class="hidden md:flex items-center space-x-10">
            <?php foreach ($menuItems as $key => $menu): ?>
                <div class="relative group">
                    <?php if (!empty($menu['sub'])): ?>
                        <button class="text-2xl font-black tracking-widest text-black uppercase hover:text-white transition-colors flex items-center">
                            <?= $menu['title'] ?>
                            <svg class="ml-1 h-4 w-4 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-2 w-48 bg-white border-2 border-black opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                            <div class="py-2">
                                <?php foreach ($menu['sub'] as $subKey => $sub): ?>
                                    <a href="<?= $sub['url'] ?>" class="flex items-center px-4 py-2 text-xl font-black text-black hover:bg-[#FFD400] transition-colors uppercase">
                                        <?php if($currentPage == $key && $currentSub == $subKey): ?>
                                            <span class="w-1.5 h-6 bg-black mr-2"></span>
                                        <?php endif; ?>
                                        <?= $sub['title'] ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?= $menu['url'] ?>" class="text-2xl font-black tracking-widest text-black uppercase hover:text-white transition-colors">
                            <?= $menu['title'] ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <button id="theme-toggle" class="ml-4 p-2 border-2 border-black rounded-full hover:bg-black hover:text-[#FFD400] transition-all">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path></svg>
            </button>
        </nav>

        <div class="flex md:hidden items-center space-x-3">
            <button id="theme-toggle-mobile" class="p-2 border-2 border-black rounded-full transition-colors active:bg-black active:text-[#FFD400]">
                <svg id="theme-toggle-light-icon-mobile" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path></svg>
                <svg id="theme-toggle-dark-icon-mobile" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
            </button>
            <button id="mobile-menu-btn" class="border-2 border-black px-4 py-1 font-black text-base uppercase tracking-tighter bg-black text-white">Menu</button>
        </div>
    </div>
</header>

<div id="mobile-menu" class="fixed inset-0 z-[100] bg-[#FFD400] dark:bg-[#1a1a1a] hidden flex-col p-8">
    <button id="mobile-menu-close" class="absolute top-8 right-8 p-2 border-2 border-black dark:border-[#FFD400] rounded-full text-black dark:text-[#FFD400] hover:bg-black hover:text-[#FFD400] dark:hover:bg-[#FFD400] dark:hover:text-black transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
    <div class="w-full h-full overflow-y-auto space-y-8 pt-4 pb-10">
        <?php foreach ($menuItems as $key => $menu): ?>
            <div>
                <?php if (!empty($menu['sub'])): ?>
                    <span class="text-sm font-black text-black/40 dark:text-[#FFD400]/40 uppercase tracking-[0.3em]"><?= $menu['title'] ?></span>
                    <div class="flex flex-col mt-2 space-y-2">
                        <?php foreach ($menu['sub'] as $subKey => $sub): ?>
                            <a href="<?= $sub['url'] ?>" class="flex items-center text-3xl font-black text-black dark:text-[#FFD400] transition-all opacity-90 hover:opacity-100">
                                <?php if($currentPage == $key && $currentSub == $subKey): ?>
                                    <span class="w-2 h-8 bg-black dark:bg-[#FFD400] mr-3"></span>
                                <?php endif; ?>
                                <?= $sub['title'] ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="flex flex-col space-y-2">
                        <a href="<?= $menu['url'] ?>" class="flex items-center text-3xl font-black text-black dark:text-[#FFD400] transition-all">
                            <?php if($currentPage == 'welcome'): ?>
                                <span class="w-2 h-8 bg-black dark:bg-[#FFD400] mr-3"></span>
                            <?php endif; ?>
                            <?= $menu['title'] ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
// ... (기존 스크립트 내용과 동일하여 생략) ...
document.addEventListener('DOMContentLoaded', function() {
    const htmlEl = document.documentElement;
    const themeBtn = document.getElementById('theme-toggle');
    const themeBtnMobile = document.getElementById('theme-toggle-mobile');
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileClose = document.getElementById('mobile-menu-close');

    function refreshTheme() {
        const isDark = htmlEl.classList.contains('dark') || 
                      (localStorage.theme === 'dark') || 
                      (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
        
        if (isDark) {
            htmlEl.classList.add('dark');
            document.getElementById('theme-toggle-light-icon')?.classList.remove('hidden');
            document.getElementById('theme-toggle-dark-icon')?.classList.add('hidden');
            document.getElementById('theme-toggle-light-icon-mobile')?.classList.remove('hidden');
            document.getElementById('theme-toggle-dark-icon-mobile')?.classList.add('hidden');
        } else {
            htmlEl.classList.remove('dark');
            document.getElementById('theme-toggle-light-icon')?.classList.add('hidden');
            document.getElementById('theme-toggle-dark-icon')?.classList.remove('hidden');
            document.getElementById('theme-toggle-light-icon-mobile')?.classList.add('hidden');
            document.getElementById('theme-toggle-dark-icon-mobile')?.classList.remove('hidden');
        }
    }

    const toggleTheme = () => {
        if (htmlEl.classList.contains('dark')) {
            htmlEl.classList.remove('dark');
            localStorage.theme = 'light';
        } else {
            htmlEl.classList.add('dark');
            localStorage.theme = 'dark';
        }
        refreshTheme();
    };

    if (themeBtn) themeBtn.onclick = toggleTheme;
    if (themeBtnMobile) themeBtnMobile.onclick = toggleTheme;

    if (mobileBtn && mobileMenu) {
        mobileBtn.onclick = () => {
            mobileMenu.classList.remove('hidden');
            mobileMenu.classList.add('flex');
            document.body.style.overflow = 'hidden';
        };
    }

    if (mobileClose && mobileMenu) {
        mobileClose.onclick = () => {
            mobileMenu.classList.add('hidden');
            mobileMenu.classList.remove('flex');
            document.body.style.overflow = 'auto';
        };
    }

    refreshTheme();
});
</script>