<?php
require_once 'includes/db.php';

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. bulletin (주보) 테이블 생성
    $sql = "CREATE TABLE IF NOT EXISTS `bulletin` (
      `id` INT(11) NOT NULL AUTO_INCREMENT,
      `title` VARCHAR(255) NOT NULL,
      `content` LONGTEXT NULL COMMENT '본문 내용',
      `image_files` JSON NULL COMMENT '주보 이미지 경로 배열 (JSON)',
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `published_at` DATETIME NULL COMMENT '게시일자',
      PRIMARY KEY (`id`),
      INDEX `idx_published_at` (`published_at`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    $pdo->exec($sql);
    echo "✅ 'bulletin' (주보) 테이블 확인/생성 완료<br>";

    // 2. column (목회칼럼) 테이블 생성
    $sql = "CREATE TABLE IF NOT EXISTS `column` (
      `id` INT(11) NOT NULL AUTO_INCREMENT,
      `title` VARCHAR(255) NOT NULL,
      `content` LONGTEXT NULL COMMENT '본문 내용',
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `published_at` DATETIME NULL COMMENT '게시일자',
      PRIMARY KEY (`id`),
      INDEX `idx_published_at` (`published_at`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    $pdo->exec($sql);
    echo "✅ 'column' (목회칼럼) 테이블 확인/생성 완료<br>";

    // 3. sermon (설교) 테이블 생성
    $sql = "CREATE TABLE IF NOT EXISTS `sermon` (
      `id` INT(11) NOT NULL AUTO_INCREMENT,
      `title` VARCHAR(255) NOT NULL,
      `passage` VARCHAR(255) NULL COMMENT '성경 본문',
      `preacher` VARCHAR(100) NULL COMMENT '설교자',
      `youtube_url` VARCHAR(255) NULL COMMENT '설교 영상 링크',
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `published_at` DATETIME NULL COMMENT '게시일자',
      PRIMARY KEY (`id`),
      INDEX `idx_published_at` (`published_at`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    $pdo->exec($sql);
    echo "✅ 'sermon' (설교) 테이블 확인/생성 완료<br>";

    // 4. news (창대소식) 테이블 생성
    $sql = "CREATE TABLE IF NOT EXISTS `news` (
      `id` INT(11) NOT NULL AUTO_INCREMENT,
      `title` VARCHAR(255) NOT NULL,
      `content` LONGTEXT NULL COMMENT '본문 내용',
      `youtube_url` VARCHAR(255) NULL COMMENT '관련 영상 링크',
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `published_at` DATETIME NULL COMMENT '게시일자',
      PRIMARY KEY (`id`),
      INDEX `idx_published_at` (`published_at`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    $pdo->exec($sql);
    echo "✅ 'news' (창대소식) 테이블 확인/생성 완료<br>";

    // 5. admin_config 테이블 생성 (이미 생성됨)
    $sql = "CREATE TABLE IF NOT EXISTS `admin_config` (
      `config_key` VARCHAR(50) PRIMARY KEY,
      `config_value` VARCHAR(255) NOT NULL
    )";
    $pdo->exec($sql);
    echo "✅ 'admin_config' 테이블 확인/생성 완료<br>";

    // 6. 관리자 비밀번호 초기화 (이미 생성됨)
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
