<?php
// 비상용 비밀번호 초기화 스크립트
// 사용법: 이 파일을 서버의 /admin 폴더에 업로드하고 브라우저로 접속하세요.
// 접속 시 관리자 비밀번호가 아래 설정된 값으로 변경됩니다.
// ★ 사용 후 반드시 이 파일을 삭제해야 보안상 안전합니다!

require_once '../includes/db.php';

// 초기화할 비밀번호 설정
$new_password = 'changdae1234'; 

try {
    // 비밀번호 해시 생성
    $hash = password_hash($new_password, PASSWORD_DEFAULT);
    
    // DB 업데이트
    // admin_config 테이블이 존재하고 admin_pw 키가 있다고 가정합니다.
    $stmt = $pdo->prepare("UPDATE admin_config SET config_value = ? WHERE config_key = 'admin_pw'");
    $stmt->execute([$hash]);
    
    echo "<h1>비밀번호 초기화 완료</h1>";
    echo "<p>비밀번호가 <strong>{$new_password}</strong> 로 변경되었습니다.</p>";
    echo "<p><a href='/admin/login.php'>로그인 페이지로 이동</a></p>";
    echo "<hr>";
    echo "<p style='color:red; font-weight:bold;'>보안을 위해 이 파일(reset_init.php)을 서버에서 즉시 삭제해주세요.</p>";
    
} catch (PDOException $e) {
    echo "오류 발생: " . $e->getMessage();
}
?>