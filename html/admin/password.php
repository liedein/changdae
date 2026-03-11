<?php
require_once 'auth_check.php';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>비밀번호 변경 - 창대교회 관리자</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 flex items-center justify-center h-screen">
    <div class="bg-white p-10 rounded-2xl shadow-xl w-full max-w-md border border-slate-100">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-extrabold text-slate-800">비밀번호 변경</h1>
            <p class="text-slate-400 text-sm mt-2">보안을 위해 주기적인 변경을 권장합니다.</p>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="bg-rose-50 border border-rose-100 text-rose-600 p-3 mb-6 rounded-lg text-sm font-medium text-center">
                <?php
                if ($_GET['error'] == 'wrong_pw') echo "현재 비밀번호가 일치하지 않습니다.";
                elseif ($_GET['error'] == 'mismatch') echo "새 비밀번호가 일치하지 않습니다.";
                else echo "오류가 발생했습니다.";
                ?>
            </div>
        <?php endif; ?>

        <form action="/admin/process.php" method="POST">
            <input type="hidden" name="mode" value="change_password">
            
            <div class="mb-4">
                <label class="block text-slate-600 text-sm font-bold mb-2" for="current_password">
                    현재 비밀번호
                </label>
                <input class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-slate-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" 
                       id="current_password" name="current_password" type="password" required>
            </div>

            <div class="mb-4">
                <label class="block text-slate-600 text-sm font-bold mb-2" for="new_password">
                    새 비밀번호
                </label>
                <input class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-slate-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" 
                       id="new_password" name="new_password" type="password" required>
            </div>

            <div class="mb-8">
                <label class="block text-slate-600 text-sm font-bold mb-2" for="confirm_password">
                    새 비밀번호 확인
                </label>
                <input class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-slate-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" 
                       id="confirm_password" name="confirm_password" type="password" required>
            </div>

            <div class="flex gap-3">
                <a href="/admin/index.php" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-3 px-4 rounded-xl text-center transition-colors">
                    취소
                </a>
                <button class="flex-[2] bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-blue-500/30 focus:outline-none transition-all duration-200 transform active:scale-[0.98]" type="submit">
                    변경하기
                </button>
            </div>
        </form>
    </div>
</body>
</html>