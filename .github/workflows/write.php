<?php
require_once 'auth_check.php';
require_once '../includes/db.php';

$category = $_GET['cat'] ?? 'news';
$id = $_GET['id'] ?? null;
$is_editing = $id !== null;

$category_map = [
    'news' => '창대소식',
    'sermon' => '주일예배',
    'bulletin' => '주보',
    'column' => '목회칼럼'
];

if (!array_key_exists($category, $category_map)) {
    die('잘못된 접근입니다.');
}

$post = null;
if ($is_editing) {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ? AND category = ?");
    $stmt->execute([$id, $category]);
    $post = $stmt->fetch();
    if (!$post) {
        die('게시물을 찾을 수 없습니다.');
    }
}

$page_title = $is_editing ? $category_map[$category] . ' 수정' : $category_map[$category] . ' 등록';

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?> - 창대교회</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- TinyMCE (Rich Text Editor) -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content',
            language: 'ko_KR',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            height: 500,
            menubar: false
        });
    </script>
</head>
<body class="bg-gray-50">
    <div class="max-w-4xl mx-auto py-10 px-4">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="flex justify-between items-center mb-8 border-b pb-4">
                <h1 class="text-2xl font-bold text-gray-800"><?= $page_title ?></h1>
                <a href="index.php?cat=<?= $category ?>" class="text-gray-500 hover:text-gray-700">목록으로</a>
            </div>

            <form action="process.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                <input type="hidden" name="mode" value="<?= $is_editing ? 'update' : 'write' ?>">
                <input type="hidden" name="category" value="<?= $category ?>">
                <?php if ($is_editing): ?>
                    <input type="hidden" name="id" value="<?= $post['id'] ?>">
                <?php endif; ?>

                <!-- 게시일자 (예약 게시) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">게시일자 (예약)</label>
                    <div class="flex items-center gap-2">
                        <input type="date" name="publish_date" required value="<?= date('Y-m-d', strtotime($post['published_at'] ?? date('Y-m-d'))) ?>"
                               class="w-48 rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span class="text-sm text-gray-500">* 선택한 날짜의 00시 05분에 게시됩니다.</span>
                    </div>
                </div>

                <!-- 제목 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">제목</label>
                    <input type="text" name="title" required value="<?= htmlspecialchars($post['title'] ?? '') ?>"
                           class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="제목을 입력하세요">
                </div>

                <!-- 유튜브 URL (설교, 소식, 칼럼 등) -->
                <?php if ($category !== 'bulletin'): ?>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">유튜브 링크 (선택)</label>
                    <input type="url" name="youtube_url" value="<?= htmlspecialchars($post['youtube_url'] ?? '') ?>"
                           class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="https://youtu.be/...">
                </div>
                <?php endif; ?>

                <!-- 주보 이미지 업로드 -->
                <?php if ($category === 'bulletin'): ?>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">주보 이미지 (다중 선택 가능)</label>
                    <input type="file" name="images[]" multiple accept="image/*"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="mt-1 text-xs text-gray-500">
                        <?= $is_editing ? '새 이미지를 업로드하면 기존 이미지를 대체합니다.' : '이미지는 자동으로 \'bulletins/제목\' 폴더에 저장됩니다.' ?>
                    </p>
                    <?php if ($is_editing && !empty($post['image_files'])): ?>
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-600 mb-2">현재 이미지:</p>
                            <div class="flex flex-wrap gap-4">
                                <?php foreach (json_decode($post['image_files']) as $image): ?>
                                    <img src="/uploads/<?= $image ?>" class="h-24 w-auto rounded border">
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <!-- 내용 (TinyMCE) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">내용</label>
                    <textarea id="content" name="content"><?= htmlspecialchars($post['content'] ?? '') ?></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="history.back()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">취소</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"><?= $is_editing ? '수정하기' : '등록하기' ?></button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>