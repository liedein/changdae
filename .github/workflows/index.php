<?php
require_once 'auth_check.php';
require_once '../includes/db.php';

$category = $_GET['cat'] ?? 'news';
$category_map = [
    'news' => '창대소식',
    'sermon' => '주일예배',
    'bulletin' => '주보',
    'column' => '목회칼럼'
];

// 카테고리 유효성 검사
if (!array_key_exists($category, $category_map)) {
    $category = 'news';
}

// 게시물 목록 가져오기 (게시일자 내림차순)
try {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE category = ? ORDER BY published_at DESC");
    $stmt->execute([$category]);
    $posts = $stmt->fetchAll();
} catch (PDOException $e) {
    $posts = [];
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>관리자 대시보드 - 창대교회</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css" />
    <style>body { font-family: 'Pretendard', sans-serif; }</style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-sm z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex justify-between items-center">
                <h1 class="text-xl font-bold text-gray-800">창대교회 관리자</h1>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-500">관리자님 환영합니다</span>
                    <a href="/" target="_blank" class="text-sm text-blue-600 hover:underline">홈페이지 바로가기</a>
                    <a href="process.php?mode=logout" class="text-sm text-red-600 hover:underline">로그아웃</a>
                </div>
            </div>
        </header>

        <div class="flex flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8 gap-8">
            <!-- Sidebar (Tabs) -->
            <aside class="w-64 flex-shrink-0">
                <nav class="space-y-1">
                    <?php foreach ($category_map as $key => $name): ?>
                        <a href="?cat=<?= $key ?>" 
                           class="<?= $category === $key ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-100' ?> 
                                  group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors">
                            <?= $name ?> 관리
                        </a>
                    <?php endforeach; ?>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-gray-900"><?= $category_map[$category] ?> 목록</h2>
                    <a href="write.php?cat=<?= $category ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                        새 글 쓰기
                    </a>
                </div>

                <div class="overflow-hidden">
                    <ul class="divide-y divide-gray-200">
                        <?php if (count($posts) > 0): ?>
                            <?php foreach ($posts as $post): ?>
                                <li class="py-4 flex justify-between items-center hover:bg-gray-50 transition-colors px-2 rounded">
                                    <div class="flex items-center gap-4">
                                        <span class="text-sm font-mono text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                            <?= date('Y-m-d', strtotime($post['published_at'])) ?>
                                        </span>
                                        <a href="write.php?cat=<?= $category ?>&id=<?= $post['id'] ?>" class="text-gray-900 font-medium hover:text-blue-600">
                                            <?= htmlspecialchars($post['title']) ?>
                                        </a>
                                        <?php if (strtotime($post['published_at']) > time()): ?>
                                            <span class="text-xs text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full border border-amber-200">예약됨</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <form action="process.php" method="POST" onsubmit="return confirm('정말 삭제하시겠습니까?');">
                                            <input type="hidden" name="mode" value="delete">
                                            <input type="hidden" name="id" value="<?= $post['id'] ?>">
                                            <button type="submit" class="text-sm text-red-500 hover:text-red-700 px-2 py-1">삭제</button>
                                        </form>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="py-10 text-center text-gray-500">등록된 게시물이 없습니다.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </main>
        </div>
    </div>
</body>
</html>