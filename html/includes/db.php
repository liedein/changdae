<?php
// html/includes/db.php
$host = 'localhost'; // 닷홈은 보통 localhost
$db   = 'your_db_name';
$user = 'your_db_user';
$pass = 'your_db_pass';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // 실 운영 시에는 에러 메시지를 숨기고 로그로 남기는 것이 좋습니다.
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
