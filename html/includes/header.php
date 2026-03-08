<?php
/**
 * Merrypage Concept Full Header
 */
// 메뉴 구조 정의 (이미 제공해주신 배열 활용)
$menuItems = [
    'intro' => [
        'title' => '소개합니다',
        'sub' => [
            'vision' => ['title' => '비전과 철학', 'url' => '?page=vision'],
            'mission' => ['title' => '사명', 'url' => '?page=mission'],
            'staff' => ['title' => '섬기는 사람들', 'url' => '?page=staff'],
            'cell' => ['title' => '목장', 'url' => '?page=cell'],
            'study' => ['title' => '삶공부', 'url' => '?page=study'],
            'news' => ['title' => '창대소식', 'url' => '?page=news'],
            'location' => ['title' => '오시는 길', 'url' => '?page=location'],
        ]
    ],
    'worship' => [
        'title' => '예배합니다',
        'sub' => [
            'worship' => ['title' => '주일예배', 'url' => '?page=worship'],
            'prayer' => ['title' => '목장연합기도회', 'url' => '?page=prayer'],
            'bulletin' => ['title' => '주보', 'url' => '?page=bulletin'],
        ]
    ],
    'together' => [
        'title' => '함께합니다',
        'sub' => [
            'missionary' => ['title' => '파송 및 후원선교사', 'url' => '?page=missionary'],
            'neighbor' => ['title' => '이웃섬김', 'url' => '?page=neighbor'],
            'column' => ['title' => '목회칼럼', 'url' => '?page=column'],
        ]
    ]
];
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@900&display=swap');
    .font-black { font-family: 'Inter', sans-serif; font-weight: 900; }
    
    /* 다크모드 시 헤더 색상 반전 (선택사항) */
    .dark #main-header { background-color: #1a1a1a; border-bottom-color: #FFD400; }
    .dark #main-header a, .dark #main-header button { color: #FFD400; }
    .dark #main-header .logo-dot { color: #fff; }
</style>

<header id="main-header" class="fixed w-full top-0 z-[60] bg-[#FFD400] border-b-2 border-black transition-colors duration-300">
    <div class="max-w-[1800px] mx-auto px-6 h-20 md:h-24 flex justify-between items-center">
        
        <div class="flex-shrink-0">
            <a href="/" class="text-3xl md:text-4xl font-black tracking-tighter text-black uppercase">
                CHANGDAE<span class="logo-dot text-white">.</span>
            </a>
        </div>

        <nav class="hidden md:flex items-center space-x-10">
            <?php foreach ($menuItems as $key => $menu): ?>
                <div class="relative group">
                    <button class="text-sm font-black tracking-widest text-black uppercase hover:text-white transition-colors flex items-center">
                        <?= $menu['title'] ?>
                        <svg class="ml-1 h-4 w-4 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-white border-2 border-black opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                        <div class="py-2">
                            <?php foreach ($menu['sub'] as $sub): ?>
                                <a href="<?= $sub['url'] ?>" class="block px-4 py-2 text-xs font-black text-black hover:bg-[#FFD400] transition-colors uppercase">
                                    <?= $sub['title'] ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <button id="theme-toggle" class="p-2 border-2 border-black rounded-full hover:bg-black hover:text-[#FFD400] transition-all">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path></svg>
            </button>
        </nav>

        <div class="flex md:hidden items-center space-x-3">
            <button id="theme-toggle-mobile" class="p-2 border-2 border-black rounded-full transition-colors active:bg-black active:text-[#FFD400]">
                <svg id="theme-toggle-light-icon-mobile" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                </svg>
                <svg id="theme-toggle-dark-icon-mobile" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
            </button>
            
            <button id="mobile-menu-btn" class="border-2 border-black px-4 py-1 font-black text-sm uppercase tracking-tighter bg-black text-white">
                Menu
            </button>
        </div>
    </div>
</header>

<div id="mobile-menu" class="fixed inset-0 z-[100] bg-[#FFD400] hidden flex-col justify-center px-10 transition-all">
    <button id="mobile-menu-close" class="absolute top-8 right-8 font-black text-xl text-black border-2 border-black px-4 py-1">CLOSE [X]</button>
    <div class="space-y-8 overflow-y-auto max-h-[80vh]">
        <?php foreach ($menuItems as $key => $menu): ?>
            <div>
                <span class="text-[10px] font-black text-black/40 uppercase tracking-[0.3em]"><?= $menu['title'] ?></span>
                <div class="flex flex-col mt-2 space-y-2">
                    <?php foreach ($menu['sub'] as $sub): ?>
                        <a href="<?= $sub['url'] ?>" class="text-4xl font-black text-black hover:italic transition-all opacity-90 hover:opacity-100">
                            <?= $sub['title'] ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const htmlEl = document.documentElement;
    // 버튼들 정의
    const themeBtn = document.getElementById('theme-toggle');
    const themeBtnMobile = document.getElementById('theme-toggle-mobile');
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileClose = document.getElementById('mobile-menu-close');

    /**
     * 테마 상태를 새로고침하는 함수
     * PC와 모바일의 해/달 아이콘을 각각 찾아 상태에 맞춰 숨기거나 보여줍니다.
     */
    function refreshTheme() {
        const isDark = htmlEl.classList.contains('dark') || 
                      (localStorage.theme === 'dark') || 
                      (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
        
        if (isDark) {
            htmlEl.classList.add('dark');
            // PC 아이콘 제어
            document.getElementById('theme-toggle-light-icon')?.classList.remove('hidden');
            document.getElementById('theme-toggle-dark-icon')?.classList.add('hidden');
            // 모바일 아이콘 제어 (새로 추가된 부분)
            document.getElementById('theme-toggle-light-icon-mobile')?.classList.remove('hidden');
            document.getElementById('theme-toggle-dark-icon-mobile')?.classList.add('hidden');
        } else {
            htmlEl.classList.remove('dark');
            // PC 아이콘 제어
            document.getElementById('theme-toggle-light-icon')?.classList.add('hidden');
            document.getElementById('theme-toggle-dark-icon')?.classList.remove('hidden');
            // 모바일 아이콘 제어 (새로 추가된 부분)
            document.getElementById('theme-toggle-light-icon-mobile')?.classList.add('hidden');
            document.getElementById('theme-toggle-dark-icon-mobile')?.classList.remove('hidden');
        }
    }

    // 테마 전환 실행 함수
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

    // 각 버튼에 클릭 이벤트 연결
    if (themeBtn) themeBtn.onclick = toggleTheme;
    if (themeBtnMobile) themeBtnMobile.onclick = toggleTheme;

    // 모바일 메뉴 모달 제어
    if (mobileBtn && mobileMenu) {
        mobileBtn.onclick = () => {
            mobileMenu.classList.remove('hidden');
            mobileMenu.classList.add('flex');
            document.body.style.overflow = 'hidden'; // 뒷배경 스크롤 방지
        };
    }

    if (mobileClose && mobileMenu) {
        mobileClose.onclick = () => {
            mobileMenu.classList.add('hidden');
            mobileMenu.classList.remove('flex');
            document.body.style.overflow = 'auto'; // 스크롤 재개
        };
    }

    // 페이지 로드 시 초기 테마 상태 적용
    refreshTheme();
});
</script>