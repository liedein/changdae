<?php
session_start();
require_once '../includes/db.php';

// 인증 확인 함수를 상단에 배치하여 안전성 확보
function checkAuth() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: /admin/login.php');
        exit;
    }
}

$mode = $_POST['mode'] ?? $_GET['mode'] ?? '';

switch ($mode) {
    case 'login':
        $password = $_POST['password'] ?? '';
        try {
            $stmt = $pdo->prepare("SELECT config_value FROM admin_config WHERE config_key = 'admin_pw'");
            $stmt->execute();
            $row = $stmt->fetch();
            $hash = $row['config_value'] ?? '';
        } catch (Exception $e) {
            $hash = '';
        }

        if ($hash && password_verify($password, $hash)) {
            $_SESSION['admin_logged_in'] = true;
            header('Location: /admin/index.php');
        } else {
            header('Location: /admin/login.php?error=1');
        }
        exit;

    case 'logout':
        session_destroy();
        header('Location: /admin/login.php');
        exit;

    case 'change_password':
        checkAuth();
        $current_pw = $_POST['current_password'] ?? '';
        $new_pw = $_POST['new_password'] ?? '';
        $confirm_pw = $_POST['confirm_password'] ?? '';

        // 1. 새 비밀번호 일치 확인
        if ($new_pw !== $confirm_pw) {
            header('Location: /admin/password.php?error=mismatch');
            exit;
        }

        // 2. 현재 비밀번호 확인
        $stmt = $pdo->prepare("SELECT config_value FROM admin_config WHERE config_key = 'admin_pw'");
        $stmt->execute();
        $current_hash = $stmt->fetchColumn();

        if (!password_verify($current_pw, $current_hash)) {
            header('Location: /admin/password.php?error=wrong_pw');
            exit;
        }

        // 3. 업데이트
        $new_hash = password_hash($new_pw, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE admin_config SET config_value = ? WHERE config_key = 'admin_pw'");
        $stmt->execute([$new_hash]);

        // 로그아웃 처리하여 다시 로그인하게 함
        session_destroy();
        header('Location: /admin/login.php'); // 성공 메시지 파라미터 등을 추가할 수도 있음
        exit;

    case 'write':
        checkAuth();
        $category = $_POST['category'] ?? 'news';
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        $published_at = $_POST['published_at'] ?? date('Y-m-d H:i:s');
        
        if ($category === 'bulletin') {
            $image_files_json = null;
            if (!empty($_FILES['images']['name'][0])) {
                $uploaded_files = [];
                $safe_title = preg_replace('/[^a-zA-Z0-9가-힣\s]/u', '', $title);
                $safe_title = trim(str_replace(' ', '_', $safe_title));
                $upload_dir = '../uploads/bulletins/' . $safe_title . '/';
                if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

                foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                    if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                        $filename = time() . '_' . basename($_FILES['images']['name'][$key]);
                        $target = $upload_dir . $filename;
                        if (move_uploaded_file($tmp_name, $target)) {
                            $uploaded_files[] = 'bulletins/' . $safe_title . '/' . $filename;
                        }
                    }
                }
                if (!empty($uploaded_files)) {
                    $image_files_json = json_encode($uploaded_files, JSON_UNESCAPED_UNICODE);
                }
            }
            $stmt = $pdo->prepare("INSERT INTO bulletin (title, content, image_files, published_at) VALUES (?, ?, ?, ?)");
            $stmt->execute([$title, $content, $image_files_json, $published_at]);

        } elseif ($category === 'sermon') {
            $passage = $_POST['passage'] ?? '';
            $preacher = $_POST['preacher'] ?? '';
            $youtube_url = $_POST['youtube_url'] ?? '';
            $stmt = $pdo->prepare("INSERT INTO sermon (title, passage, preacher, youtube_url, created_at, published_at) VALUES (?, ?, ?, ?, NOW(), ?)");
            $stmt->execute([$title, $passage, $preacher, $youtube_url, $published_at]);

        } elseif ($category === 'videos') {
            $video_category = $_POST['video_category'] ?? '간증';
            $youtube_url = $_POST['youtube_url'] ?? '';
            $stmt = $pdo->prepare("INSERT INTO videos (category, title, content, youtube_url, created_at, published_at) VALUES (?, ?, ?, ?, NOW(), ?)");
            $stmt->execute([$video_category, $title, $content, $youtube_url, $published_at]);

        } else {
            $table = ($category === 'column') ? '`column`' : 'news';
            if ($category === 'news') {
                $youtube_url = $_POST['youtube_url'] ?? null;
                $stmt = $pdo->prepare("INSERT INTO news (title, content, youtube_url, published_at) VALUES (?, ?, ?, ?)");
                $stmt->execute([$title, $content, $youtube_url, $published_at]);
            } else {
                $stmt = $pdo->prepare("INSERT INTO `column` (title, content, published_at) VALUES (?, ?, ?)");
                $stmt->execute([$title, $content, $published_at]);
            }
        }
        header('Location: /admin/index.php?cat=' . $category);
        exit;

    case 'update':
        checkAuth();
        $id = $_POST['id'] ?? '';
        $category = $_POST['category'] ?? 'news';
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        $published_at = $_POST['published_at'] ?? date('Y-m-d H:i:s');
        
        if ($category === 'bulletin') {
            $sql = "UPDATE bulletin SET title=?, content=?, published_at=?";
            $params = [$title, $content, $published_at];
            $final_images = $_POST['existing_images'] ?? []; 

            if (!empty($_FILES['images']['name'][0])) {
                $new_files = [];
                $safe_title = preg_replace('/[^a-zA-Z0-9가-힣\s]/u', '', $title);
                $safe_title = trim(str_replace(' ', '_', $safe_title));
                $upload_dir = '../uploads/bulletins/' . $safe_title . '/';
                if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

                foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                    if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                        $filename = time() . '_' . basename($_FILES['images']['name'][$key]);
                        if (move_uploaded_file($tmp_name, $upload_dir . $filename)) {
                            $new_files[] = 'bulletins/' . $safe_title . '/' . $filename;
                        }
                    }
                }
                $final_images = array_merge($final_images, $new_files);
            }
            $sql .= ", image_files=? WHERE id=?";
            $params[] = json_encode(array_values($final_images), JSON_UNESCAPED_UNICODE);
            $params[] = $id;
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);

        } elseif ($category === 'sermon') {
            $passage = $_POST['passage'] ?? '';
            $preacher = $_POST['preacher'] ?? '';
            $youtube_url = $_POST['youtube_url'] ?? '';
            $sql = "UPDATE sermon SET title=?, passage=?, preacher=?, youtube_url=?, published_at=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$title, $passage, $preacher, $youtube_url, $published_at, $id]);

        } elseif ($category === 'videos') {
            $video_category = $_POST['video_category'] ?? '간증';
            $youtube_url = $_POST['youtube_url'] ?? '';
            $sql = "UPDATE videos SET category=?, title=?, content=?, youtube_url=?, published_at=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$video_category, $title, $content, $youtube_url, $published_at, $id]);

        } else {
            $table = ($category === 'column') ? '`column`' : 'news';
            $youtube_url = $_POST['youtube_url'] ?? null;
            if ($category === 'news') {
                $sql = "UPDATE news SET title=?, content=?, youtube_url=?, published_at=? WHERE id=?";
                $params = [$title, $content, $youtube_url, $published_at, $id];
            } else {
                $sql = "UPDATE `column` SET title=?, content=?, published_at=? WHERE id=?";
                $params = [$title, $content, $published_at, $id];
            }
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
        }
        header('Location: /admin/index.php?cat=' . $category);
        exit;

    case 'delete':
        checkAuth();
        $id = $_POST['id'] ?? '';
        $category = $_POST['category'] ?? 'news';
        $table = ($category === 'column') ? '`column`' : $category;
        $stmt = $pdo->prepare("DELETE FROM `{$table}` WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/admin/index.php'));
        exit;

    default:
        header('Location: /admin/index.php');
        exit;
}
?>