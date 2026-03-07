<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

// 간단한 라우팅 로직
$page = $_GET['page'] ?? 'home';
$allowed_pages = ['home', 'intro', 'worship', 'board_view', 'together', 'staff', 'cell', 'bulletin'];

if (!in_array($page, $allowed_pages)) {
    $page = 'home';
}
?>
<!DOCTYPE html>
<html lang="ko" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>창대교회 - 영혼 구원하여 제자 삼는 교회</title>
    
    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        charcoal: '#333333',
                        deepblue: '#1a365d',
                    },
                    fontFamily: {
                        sans: ['Pretendard', 'sans-serif'],
                        serif: ['Merriweather', 'serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Pretendard Font -->
    <link rel="stylesheet" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css" />
    
    <!-- Dark Mode Init (FOUC 방지) -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 transition-colors duration-500">

    <?php include 'includes/header.php'; ?>

    <main class="min-h-screen pt-20 bg-inherit text-inherit">
        <?php 
            // 페이지 동적 로드
            $page_path = __DIR__ . "/pages/{$page}.php";
            if (file_exists($page_path)) {
                include $page_path;
            } else {
                echo "<div class='text-center py-20'>페이지를 찾을 수 없습니다.</div>";
            }
        ?>
    </main>

    <?php include 'includes/footer.php'; ?>

    </body>
</html>
