<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

// 간단한 라우팅 로직
$page = $_GET['page'] ?? 'home';
$allowed_pages = ['home', 'welcome', 'intro', 'worship', 'together'];

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
    
    <!-- Open Graph / SNS 공유용 썸네일 및 정보 -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="창대교회 - 영혼 구원하여 제자 삼는 교회">
    <meta property="og:description" content="하나님의 사랑이 머무는 곳, 창대교회에 오신 여러분을 환영합니다.">
    <meta property="og:image" content="/assets/img/changdae_OGI.png">

    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/img/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/assets/img/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="/assets/img/android-chrome-512x512.png">

    <!-- 빌드된 Tailwind CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    
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
