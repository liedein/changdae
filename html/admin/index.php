<?php
require_once 'auth_check.php';
require_once '../includes/db.php';

$category = $_GET['cat'] ?? 'news';
$id = $_GET['id'] ?? null;

$category_map = [
    'news' => '창대소식',
    'sermon' => '주일예배',
    'bulletin' => '주보',
    'column' => '목회칼럼'
];

if (!array_key_exists($category, $category_map)) {
    $category = 'news';
}

$table = $category;

// 1. 목록 조회 (우측 사이드바용) - 테이블명에 백틱(`)을 추가하여 예약어 에러 방지
$stmt = $pdo->prepare("SELECT * FROM `{$table}` ORDER BY published_at DESC");
$stmt->execute();
$posts = $stmt->fetchAll();

// 2. 수정할 게시물 조회 (좌측 에디터용) - 여기도 동일하게 백틱 추가
$post = null;
$mode = 'write'; 
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM `{$table}` WHERE id = ?");
    $stmt->execute([$id]);
    $post = $stmt->fetch();
    if ($post) {
        $mode = 'update';
    }
}
?>
<!DOCTYPE html>
<html lang="ko"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>관리자 대시보드 - 창대교회</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <style>
        /* 눈이 편한 라이트 모드 에디터 스타일 */
        .ql-editor { min-height: 400px; font-size: 16px; background-color: #ffffff; color: #334155; }
        .ql-toolbar.ql-snow { background: #f8fafc; border-color: #e2e8f0; border-top-left-radius: 8px; border-top-right-radius: 8px; }
        .ql-container.ql-snow { border-color: #e2e8f0; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; }
    </style>
</head>
<body class="bg-slate-50 h-screen flex flex-col overflow-hidden text-slate-900">
    <header class="bg-slate-800 shadow-lg z-10 flex-shrink-0">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 h-16 flex justify-between items-center">
            <div class="flex items-center gap-8">
                <h1 class="text-xl font-bold text-white tracking-tight">창대교회 관리자</h1>
                <nav class="hidden md:flex space-x-1">
                    <?php foreach ($category_map as $key => $name): ?>
                    <a href="?cat=<?= $key ?>" class="px-4 py-2 rounded-md text-sm font-semibold transition-all <?= $category === $key ? 'bg-blue-500 text-white shadow-md' : 'text-slate-300 hover:text-white hover:bg-slate-700' ?>">
                        <?= $name ?>
                    </a>
                    <?php endforeach; ?>
                </nav>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm text-slate-300 font-medium">관리자님</span>
                <a href="process.php?mode=logout" class="text-sm text-rose-300 hover:text-rose-100 font-bold">로그아웃</a>
            </div>
        </div>
    </header>

    <div class="flex flex-1 overflow-hidden">
        <main class="flex-1 overflow-y-auto p-6 bg-slate-50">
            <div class="max-w-4xl mx-auto bg-white border border-slate-200 rounded-xl shadow-sm p-8">
                <div class="flex justify-between items-center mb-6 border-b pb-4">
                    <h2 class="text-xl font-bold text-gray-800">
                        <?= $category_map[$category] ?> <?= $mode === 'update' ? '수정' : '등록' ?>
                    </h2>
                    <?php if ($mode === 'update'): ?>
                        <a href="?cat=<?= $category ?>" class="text-sm text-blue-600 hover:underline">+ 새 글 등록하기</a>
                    <?php endif; ?>
                </div>

                <form action="process.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                    <input type="hidden" name="mode" value="<?= $mode ?>">
                    <input type="hidden" name="category" value="<?= $category ?>">
                    <?php if ($mode === 'update'): ?>
                        <input type="hidden" name="id" value="<?= $post['id'] ?>">
                    <?php endif; ?>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- 게시일자 -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">게시일자</label>
                            <input type="date" name="publish_date" required 
                                value="<?= date('Y-m-d', strtotime($post['published_at'] ?? date('Y-m-d'))) ?>"
                                min="<?= date('Y-m-d') ?>"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <!-- 제목 -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">제목</label>
                            <input type="text" name="title" required value="<?= htmlspecialchars($post['title'] ?? '') ?>"
                                   class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="제목을 입력하세요">
                        </div>
                    </div>

                    <!-- 설교 전용 필드 -->
                    <?php if ($category === 'sermon'): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">성경 본문</label>
                            <input type="text" name="passage" value="<?= htmlspecialchars($post['passage'] ?? '') ?>"
                                   class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">설교자</label>
                            <input type="text" name="preacher" value="<?= htmlspecialchars($post['preacher'] ?? '김은택 담임목사') ?>"
                                   class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- 유튜브 URL (설교, 소식) -->
                    <?php if ($category === 'sermon'): ?>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">유튜브 링크 (선택)</label>
                        <input type="url" name="youtube_url" value="<?= htmlspecialchars($post['youtube_url'] ?? '') ?>"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="https://youtu.be/...">
                    </div>
                    <?php endif; ?>

                    <!-- 주보 이미지 -->
                    <?php if ($category === 'bulletin'): ?>
                    <div class="space-y-4">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">주보 이미지 업로드 및 순서 변경</label>
                        <input type="file" name="images[]" multiple accept="image/*"
                               class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors">
                        
                        <?php if ($mode === 'update' && !empty($post['image_files'])): ?>
                            <div class="bg-slate-50 p-6 rounded-xl border border-slate-200 shadow-inner">
                                <p class="text-xs text-blue-600 mb-4 font-bold uppercase tracking-wider">📦 Drag & Drop으로 출력 순서를 조정하세요</p>
                                <div id="image-sort-list" class="flex flex-wrap gap-4">
                                    <?php 
                                    $imgs = json_decode($post['image_files'], true);
                                    if (is_array($imgs)): 
                                        foreach ($imgs as $img): 
                                            $displayPath = (strpos($img, 'bulletins/') === false ? 'bulletins/'.$img : $img);
                                    ?>
                                        <div class="relative cursor-move bg-white p-2 rounded-lg border border-slate-200 shadow-sm hover:shadow-md transition-all group">
                                            <img src="/uploads/<?= htmlspecialchars($displayPath) ?>" class="h-40 w-auto rounded object-cover">
                                            <input type="hidden" name="existing_images[]" value="<?= htmlspecialchars($img) ?>">
                                            <div class="absolute inset-0 bg-blue-500/5 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                                <span class="bg-white/90 text-blue-600 px-2 py-1 rounded text-[10px] font-bold shadow-sm">MOVE</span>
                                            </div>
                                        </div>
                                    <?php 
                                        endforeach; 
                                    endif; 
                                    ?>
                                </div>
                            </div>
                            <script>
                                (function() {
                                    const sortContainer = document.getElementById('image-sort-list');
                                    if (sortContainer && typeof Sortable !== 'undefined') {
                                        new Sortable(sortContainer, {
                                            animation: 150,
                                            ghostClass: 'opacity-40',
                                            dragClass: 'rotate-1'
                                        });
                                    }
                                })();
                            </script>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <!-- 내용 -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">내용</label>
                        <div class="bg-white">
                            <div id="editor-container"><?= $post['content'] ?? '' ?></div>
                            <input type="hidden" name="content" id="content-input">
                        </div>
                    </div>

                    <script>
                        // 에디터 초기화
                        var quill = new Quill('#editor-container', {
                            modules: {
                                toolbar: [
                                    [{ 'header': [1, 2, 3, false] }],
                                    ['bold', 'italic', 'underline', 'strike'],
                                    ['link', 'image', 'video'],
                                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                                    ['clean']
                                ]
                            },
                            theme: 'snow'
                        });

                        // 폼 전송 시 에디터 내용을 hidden input에 담아주는 로직
                        const form = document.querySelector('form');
                        form.onsubmit = function() {
                            const contentInput = document.getElementById('content-input');
                            contentInput.value = quill.root.innerHTML;
                        };
                    </script>

                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">
                            <?= $mode === 'update' ? '수정하기' : '등록하기' ?>
                        </button>
                    </div>
                </form>
            </div>
        </main>

        <!-- 우측: 목록 (Sidebar) -->
        <aside class="w-80 bg-white border-l border-slate-200 flex-shrink-0 flex flex-col shadow-inner">
            <div class="p-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <h3 class="font-bold text-slate-500 uppercase tracking-wider text-xs">목록 (<?= count($posts) ?>)</h3>
                <a href="?cat=<?= $category ?>" class="text-xs text-blue-500 hover:text-blue-700 font-bold transition-colors">새로고침</a>
            </div>
            <div class="flex-1 overflow-y-auto p-2 space-y-2">
                <?php if (count($posts) > 0): ?>
                    <?php foreach ($posts as $item): ?>
                    <div class="group flex items-center justify-between p-3 rounded-md hover:bg-gray-50 border border-transparent hover:border-gray-200 transition-all <?= ($id == $item['id']) ? 'bg-blue-50 border-blue-200' : '' ?>">
                        <a href="?cat=<?= $category ?>&id=<?= $item['id'] ?>" class="flex-1 min-w-0">
                            <div class="text-xs text-gray-500 mb-0.5"><?= date('Y-m-d', strtotime($item['published_at'])) ?></div>
                            <div class="text-sm font-medium text-gray-900 truncate"><?= htmlspecialchars($item['title']) ?></div>
                        </a>
                        
                        <!-- 휴지통 아이콘 (삭제) -->
                        <form action="process.php" method="POST" onsubmit="return confirm('정말 삭제하시겠습니까?');" class="ml-2">
                            <input type="hidden" name="mode" value="delete">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <input type="hidden" name="category" value="<?= $category ?>">
                            <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-full transition-colors" title="삭제">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-10 text-sm text-gray-500">
                        등록된 게시물이 없습니다.
                    </div>
                <?php endif; ?>
            </div>
        </aside>
    </div>
</body>
</html>
