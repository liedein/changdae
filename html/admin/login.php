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
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="bg-slate-400 flex items-center justify-center h-screen">
    <div class="bg-white p-10 rounded-2xl shadow-xl w-full max-w-md border border-slate-100">
        <div class="text-center mb-10">
            <div class="inline-block p-3 rounded-full bg-blue-50 mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-800">관리자 로그인</h1>
            <p class="text-slate-400 text-sm mt-2 font-medium">창대교회 홈페이지 관리 시스템</p>
        </div>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="bg-rose-50 border border-rose-100 text-rose-600 p-4 mb-8 rounded-lg text-sm font-medium text-center" role="alert">
                비밀번호가 일치하지 않습니다.
            </div>
        <?php endif; ?>

        <form action="/admin/process.php" method="POST">
            <input type="hidden" name="mode" value="login">
            <div class="mb-8">
                <label class="block text-slate-600 text-sm font-bold mb-3" for="password">
                    관리자 비밀번호
                </label>
                <input class="w-full bg-slate-50 border border-slate-200 rounded-xl py-4 px-5 text-slate-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all placeholder-slate-300" 
                       id="password" name="password" type="password" placeholder="비밀번호를 입력하세요" required>
            </div>
            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded-xl shadow-lg shadow-blue-500/30 focus:outline-none transition-all duration-200 transform active:scale-[0.98]" type="submit">
                로그인
            </button>
        </form>
        <div class="mt-6 text-center">
            <a href="/" class="text-sm text-gray-500 hover:text-gray-800 underline">홈페이지로 돌아가기</a>
        </div>
    </div>
</body>
</html>
