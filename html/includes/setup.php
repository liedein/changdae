<?php
require_once 'includes/db.php';

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. posts 테이블 생성
    $sql = "CREATE TABLE IF NOT EXISTS `posts` (
      `id` INT(11) NOT NULL AUTO_INCREMENT,
      `category` VARCHAR(20) NOT NULL COMMENT 'news, bulletin, sermon, column',
      `title` VARCHAR(255) NOT NULL,
      `content` LONGTEXT NULL COMMENT '본문 내용 (HTML)',
      `youtube_url` VARCHAR(255) NULL COMMENT '설교 영상 링크',
      `image_files` JSON NULL COMMENT '주보 이미지 경로 배열 (JSON)',
      `view_count` INT(11) DEFAULT 0,
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `published_at` DATETIME NULL COMMENT '예약 게시 일자',
      PRIMARY KEY (`id`),
      INDEX `idx_category` (`category`),
      INDEX `idx_published_at` (`published_at`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($sql);
    echo "✅ 'posts' 테이블 확인/생성 완료<br>";

    // 2. admin_config 테이블 생성
    $sql = "CREATE TABLE IF NOT EXISTS `admin_config` (
      `config_key` VARCHAR(50) PRIMARY KEY,
      `config_value` VARCHAR(255) NOT NULL
    )";
    $pdo->exec($sql);
    echo "✅ 'admin_config' 테이블 확인/생성 완료<br>";

    // 3. 관리자 비밀번호 초기화 (admin1234)
    $stmt = $pdo->prepare("SELECT count(*) FROM admin_config WHERE config_key = 'admin_pw'");
    $stmt->execute();
    if ($stmt->fetchColumn() == 0) {
        // 초기 비밀번호: admin1234
        $hash = password_hash('admin1234', PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("INSERT INTO admin_config (config_key, config_value) VALUES ('admin_pw', ?)");
        $stmt->execute([$hash]);
        echo "✅ 관리자 비밀번호 초기화 완료 (초기비번: admin1234)<br>";
    } else {
        echo "ℹ️ 관리자 비밀번호가 이미 설정되어 있습니다.<br>";
    }

    echo "<hr>🎉 데이터베이스 설정이 완료되었습니다. <br>보안을 위해 <b>setup.php 파일을 삭제</b>하거나 이름을 변경해주세요.";

} catch (PDOException $e) {
    echo "❌ 오류 발생: " . $e->getMessage();
}
?>