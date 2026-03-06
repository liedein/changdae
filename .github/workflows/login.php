<?php
session_start();
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: /admin/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>관리자 로그인 - 창대교회</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">관리자 로그인</h1>
            <p class="text-gray-500 text-sm mt-2">창대교회 홈페이지 관리 시스템</p>
        </div>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 text-sm" role="alert">
                <p>비밀번호가 일치하지 않습니다.</p>
            </div>
        <?php endif; ?>

        <form action="/admin/process.php" method="POST">
            <input type="hidden" name="mode" value="login">
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    비밀번호
                </label>
                <input class="shadow-sm appearance-none border border-gray-300 rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                       id="password" name="password" type="password" placeholder="관리자 비밀번호를 입력하세요" required>
            </div>
            <button class="w-full bg-gray-800 hover:bg-gray-900 text-white font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline transition-colors duration-200" type="submit">
                로그인
            </button>
        </form>
        <div class="mt-6 text-center">
            <a href="/" class="text-sm text-gray-500 hover:text-gray-800 underline">홈페이지로 돌아가기</a>
        </div>
    </div>
</body>
</html>