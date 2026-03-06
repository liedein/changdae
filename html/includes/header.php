<?php
// 메뉴 구조 정의
$menuItems = [
    'intro' => [
        'title' => '소개합니다',
        'sub' => [
            'vision' => ['title' => '비전과 철학', 'url' => '?page=intro&sub=vision'],
            'mission' => ['title' => '사명', 'url' => '?page=intro&sub=mission'],
            'staff' => ['title' => '섬기는 사람들', 'url' => '?page=staff'],
            'cell' => ['title' => '목장', 'url' => '?page=cell'],
            'study' => ['title' => '삶공부', 'url' => '?page=intro&sub=study'],
            'news' => ['title' => '창대소식', 'url' => '?page=board_view&cat=news'],
            'location' => ['title' => '오시는 길', 'url' => '?page=intro&sub=location'],
        ]
    ],
    'worship' => [
        'title' => '예배합니다',
        'sub' => [
            'sermon' => ['title' => '주일예배', 'url' => '?page=board_view&cat=sermon'],
            'prayer' => ['title' => '목장연합기도회', 'url' => '?page=worship&sub=prayer'],
            'bulletin' => ['title' => '주보', 'url' => '?page=bulletin'],
        ]
    ],
    'together' => [
        'title' => '함께합니다',
        'sub' => [
            'missionary' => ['title' => '파송 및 후원선교사', 'url' => '?page=together&sub=missionary'],
            'neighbor' => ['title' => '이웃섬김', 'url' => '?page=together&sub=neighbor'],
            'column' => ['title' => '목회칼럼', 'url' => '?page=board_view&cat=column'],
        ]
    ]
];
?>

<header id="main-header" class="fixed w-full top-0 z-50 transition-all duration-300 border-b border-transparent">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20 transition-all duration-300" id="header-container">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="text-2xl font-serif font-bold text-charcoal dark:text-white tracking-tighter hover:opacity-80 transition-opacity">
                    창대교회
                </a>
            </div>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex space-x-8">
                <a href="/" class="text-charcoal dark:text-gray-200 hover:text-deepblue dark:hover:text-blue-400 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                    환영합니다
                </a>
                <?php foreach ($menuItems as $key => $menu): ?>
                    <div class="relative group">
                        <button class="text-charcoal dark:text-gray-200 group-hover:text-deepblue dark:group-hover:text-blue-400 px-3 py-2 rounded-md text-sm font-medium inline-flex items-center transition-colors">
                            <?= $menu['title'] ?>
                            <svg class="ml-1 h-4 w-4 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <!-- Dropdown -->
                        <div class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 ease-out">
                            <div class="py-1" role="menu" aria-orientation="vertical">
                                <?php foreach ($menu['sub'] as $subKey => $subItem): ?>
                                    <a href="<?= $subItem['url'] ?>" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-deepblue dark:hover:text-blue-400" role="menuitem">
                                        <?= $subItem['title'] ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </nav>

            <!-- Right Icons (Theme Toggle & Mobile Menu) -->
            <div class="flex items-center space-x-4">
                <!-- Dark Mode Toggle -->
                <button id="theme-toggle" class="p-2 rounded-full text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none transition-colors">
                    <!-- Sun Icon -->
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                    </svg>
                    <!-- Moon Icon -->
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                </button>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-md text-gray-600 dark:text-gray-200 hover:text-deepblue dark:hover:text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="/" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-200 hover:text-deepblue dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-800">환영합니다</a>
            <?php foreach ($menuItems as $key => $menu): ?>
                <div class="space-y-1">
                    <div class="px-3 py-2 text-base font-bold text-gray-900 dark:text-white">
                        <?= $menu['title'] ?>
                    </div>
                    <?php foreach ($menu['sub'] as $subKey => $subItem): ?>
                        <a href="<?= $subItem['url'] ?>" class="block pl-6 pr-3 py-2 rounded-md text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-deepblue dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-800">
                            - <?= $subItem['title'] ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</header>

<script>
    // Header Scroll Effect
    const header = document.getElementById('main-header');
    const headerContainer = document.getElementById('header-container');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 10) {
            header.classList.add('bg-white/90', 'dark:bg-gray-900/90', 'backdrop-blur-md', 'shadow-sm');
            header.classList.remove('border-transparent');
            header.classList.add('border-gray-200', 'dark:border-gray-800');
            headerContainer.classList.remove('h-20');
            headerContainer.classList.add('h-16');
        } else {
            header.classList.remove('bg-white/90', 'dark:bg-gray-900/90', 'backdrop-blur-md', 'shadow-sm');
            header.classList.add('border-transparent');
            header.classList.remove('border-gray-200', 'dark:border-gray-800');
            headerContainer.classList.remove('h-16');
            headerContainer.classList.add('h-20');
        }
    });

    // --- 다크모드 통합 로직 시작 ---
    const themeToggleBtn = document.getElementById('theme-toggle');
    const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

    // [추가] 페이지 로드 시 localStorage 확인 후 테마 즉시 적용
    if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
        themeToggleLightIcon.classList.remove('hidden'); // 해 아이콘 표시
        themeToggleDarkIcon.classList.add('hidden');    // 달 아이콘 숨김
    } else {
        document.documentElement.classList.remove('dark');
        themeToggleDarkIcon.classList.remove('hidden'); // 달 아이콘 표시
        themeToggleLightIcon.classList.add('hidden');   // 해 아이콘 숨김
    }

    // 클릭 이벤트
    themeToggleBtn.addEventListener('click', function() {
        if (document.documentElement.classList.contains('dark')) {
            // 다크 -> 라이트 모드로 변경
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
            themeToggleDarkIcon.classList.remove('hidden');
            themeToggleLightIcon.classList.add('hidden');
        } else {
            // 라이트 -> 다크 모드로 변경
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
            themeToggleLightIcon.classList.remove('hidden');
            themeToggleDarkIcon.classList.add('hidden');
        }
    });
    // --- 다크모드 통합 로직 끝 ---

    // Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
const mobileMenu = document.getElementById('mobile-menu');

if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', function(e) {
        e.preventDefault();
        // 메뉴 열기/닫기 토글
        mobileMenu.classList.toggle('hidden');
        
        // 메뉴가 열렸을 때 배경색 처리
        if (!mobileMenu.classList.contains('hidden')) {
            header.classList.add('bg-white', 'dark:bg-gray-900', 'shadow-md');
        } else if (window.scrollY <= 10) {
            header.classList.remove('bg-white', 'dark:bg-gray-900', 'shadow-md');
        }
    });

    // 메뉴 내부 링크 클릭 시 메뉴 닫기 (사용자 경험 개선)
    const mobileLinks = mobileMenu.querySelectorAll('a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
        });
    });
}
</script>