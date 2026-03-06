<?php
session_start();
require_once '../includes/db.php';

$mode = $_POST['mode'] ?? $_GET['mode'] ?? '';

switch ($mode) {
    case 'login':
        $password = $_POST['password'] ?? '';
        
        // DB에서 관리자 비밀번호 해시 가져오기
        // 초기 설정 시: INSERT INTO admin_config VALUES ('admin_pw', password_hash('원하는비번', PASSWORD_DEFAULT));
        try {
            $stmt = $pdo->prepare("SELECT config_value FROM admin_config WHERE config_key = 'admin_pw'");
            $stmt->execute();
            $row = $stmt->fetch();
            $hash = $row['config_value'] ?? '';
        } catch (Exception $e) {
            $hash = '';
        }

        // 비밀번호 검증
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

    case 'write':
        checkAuth();
        $category = $_POST['category'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $youtube_url = $_POST['youtube_url'] ?? null;
        $publish_date = $_POST['publish_date'] ?? date('Y-m-d');
        
        // 예약 게시 시간 설정 (00:05:00)
        $published_at = $publish_date . ' 00:05:00';
        
        // 주보 이미지 파일 업로드 처리
        $image_files_json = null;
        if ($category === 'bulletin' && !empty($_FILES['images']['name'][0])) {
            $uploaded_files = [];
            
            // 폴더명: bulletins/제목 (특수문자 제거)
            $safe_title = preg_replace('/[^a-zA-Z0-9가-힣\s]/u', '', $title);
            $safe_title = trim(str_replace(' ', '_', $safe_title));
            $upload_dir = '../uploads/bulletins/' . $safe_title . '/';
            
            // 업로드 폴더가 없으면 생성
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                    $name = basename($_FILES['images']['name'][$key]);
                    // 파일명 중복 방지를 위해 시간값 추가
                    $filename = time() . '_' . $name;
                    $target = $upload_dir . $filename;
                    
                    if (move_uploaded_file($tmp_name, $target)) {
                        // DB에는 상대 경로로 저장 (bulletins/제목/파일명)
                        $uploaded_files[] = 'bulletins/' . $safe_title . '/' . $filename;
                    }
                }
            }
            if (!empty($uploaded_files)) {
                $image_files_json = json_encode($uploaded_files);
            }
        }

        $stmt = $pdo->prepare("INSERT INTO posts (category, title, content, youtube_url, image_files, published_at) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$category, $title, $content, $youtube_url, $image_files_json, $published_at]);
        
        header('Location: /admin/index.php?cat=' . $category);
        exit;

    case 'update':
        checkAuth();
        $id = $_POST['id'];
        $category = $_POST['category'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $youtube_url = $_POST['youtube_url'] ?? null;
        $publish_date = $_POST['publish_date'] ?? date('Y-m-d');
        
        $published_at = $publish_date . ' 00:05:00';

        $sql = "UPDATE posts SET title=?, content=?, youtube_url=?, published_at=?";
        $params = [$title, $content, $youtube_url, $published_at];

        // 이미지 파일 처리 (새 파일이 있으면 기존 파일 삭제 후 업로드)
        if ($category === 'bulletin' && !empty($_FILES['images']['name'][0])) {
            // 1. 기존 파일 정보 가져오기 및 삭제
            $stmt_select = $pdo->prepare("SELECT image_files FROM posts WHERE id = ?");
            $stmt_select->execute([$id]);
            if ($old_post = $stmt_select->fetch()) {
                if (!empty($old_post['image_files'])) {
                    $old_images = json_decode($old_post['image_files']);
                    foreach ($old_images as $img_path) {
                        if (file_exists('../uploads/' . $img_path)) {
                            unlink('../uploads/' . $img_path);
                        }
                    }
                }
            }

            // 2. 새 파일 업로드
            $uploaded_files = [];
            $safe_title = preg_replace('/[^a-zA-Z0-9가-힣\s]/u', '', $title);
            $safe_title = trim(str_replace(' ', '_', $safe_title));
            $upload_dir = '../uploads/bulletins/' . $safe_title . '/';
            if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                    $filename = time() . '_' . basename($_FILES['images']['name'][$key]);
                    if (move_uploaded_file($tmp_name, $upload_dir . $filename)) {
                        $uploaded_files[] = 'bulletins/' . $safe_title . '/' . $filename;
                    }
                }
            }
            $sql .= ", image_files=?";
            $params[] = json_encode($uploaded_files);
        }

        $sql .= " WHERE id=?";
        $params[] = $id;
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        header('Location: /admin/index.php?cat=' . $category);
        exit;

    case 'delete':
        checkAuth();
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
}

function checkAuth() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: /admin/login.php');
        exit;
    }
}
?>