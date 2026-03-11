<?php
// 관리자 비밀번호 레코드 복구 스크립트
// DB에서 실수로 admin_pw 레코드를 지웠을 때 다시 생성합니다.
// 사용 후 반드시 이 파일을 삭제하세요!

require_once '../includes/db.php';

$default_pw = 'changdae1234'; // 초기화할 비밀번호

try {
    $hash = password_hash($default_pw, PASSWORD_DEFAULT);
    
    // 1. 레코드가 이미 있는지 확인
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM admin_config WHERE config_key = 'admin_pw'");
    $stmt->execute();
    $exists = $stmt->fetchColumn();
    
    if ($exists) {
        // 있으면 업데이트 (혹시 모르니)
        $stmt = $pdo->prepare("UPDATE admin_config SET config_value = ? WHERE config_key = 'admin_pw'");
        $stmt->execute([$hash]);
        echo "<h3>비밀번호가 재설정되었습니다. (UPDATE)</h3>";
    } else {
        // 없으면 새로 삽입 (복구)
        $stmt = $pdo->prepare("INSERT INTO admin_config (config_key, config_value) VALUES ('admin_pw', ?)");
        $stmt->execute([$hash]);
        echo "<h3>삭제된 비밀번호 레코드를 복구했습니다. (INSERT)</h3>";
    }
    
    echo "<p>설정된 비밀번호: <strong>{$default_pw}</strong></p>";
    echo "<p><a href='/admin/login.php'>로그인 페이지로 이동</a></p>";
    echo "<p style='color:red; font-weight:bold;'>보안을 위해 이 파일(restore_pw.php)을 서버에서 즉시 삭제해주세요.</p>";

} catch (PDOException $e) {
    echo "오류 발생: " . $e->getMessage();
}
?>
