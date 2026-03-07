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
        $publish_date = $_POST['publish_date'] ?? date('Y-m-d');
        
        // 예약 게시 시간 설정 (00:00:00)
        $published_at = $publish_date . ' 00:00:00';
        
        // 테이블별 처리
        if ($category === 'bulletin') {
            // --- 주보 (bulletin) ---
            
            // 이미지 파일 업로드 처리
        $image_files_json = null;
            if (!empty($_FILES['images']['name'][0])) {
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

            $stmt = $pdo->prepare("INSERT INTO bulletin (title, content, image_files, published_at) VALUES (?, ?, ?, ?)");
            $stmt->execute([$title, $content, $image_files_json, $published_at]);

        } elseif ($category === 'sermon') {
            // --- 설교 (sermon) ---
            $passage = $_POST['passage'] ?? '';
            $preacher = $_POST['preacher'] ?? '';
            $youtube_url = $_POST['youtube_url'] ?? '';
            
            $stmt = $pdo->prepare("INSERT INTO sermon (title, passage, preacher, youtube_url, created_at, published_at) VALUES (?, ?, ?, ?, NOW(), ?)");
            $stmt->execute([$title, $passage, $preacher, $youtube_url, $published_at]);

        } else {
            // --- 칼럼(column), 소식(news) ---
            $table = ($category === 'column') ? '`column`' : 'news'; // column은 예약어라 백틱 필요
            $youtube_url = $_POST['youtube_url'] ?? null; // news일 경우 사용
            
            if ($category === 'news') {
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
        $id = $_POST['id'];
        $category = $_POST['category'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $publish_date = $_POST['publish_date'] ?? date('Y-m-d');
        
        $published_at = $publish_date . ' 00:00:00';

        if ($category === 'bulletin') {
            // --- 주보 수정 (순서 보존 및 부분 업데이트 로직) ---
            $sql = "UPDATE bulletin SET title=?, content=?, published_at=?";
            $params = [$title, $content, $published_at];

            // 1. 화면에서 드래그로 넘어온 기존 이미지 순서 배열 받기
            $final_images = $_POST['existing_images'] ?? []; 

            // 2. 새 파일 업로드 처리
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
                            // 새 파일은 기존 이미지 리스트 뒤에 추가됨
                            $new_files[] = 'bulletins/' . $safe_title . '/' . $filename;
                        }
                    }
                }
                // 기존 순서 배열 뒤에 새 파일을 합침
                $final_images = array_merge($final_images, $new_files);
            }

            // 3. 최종 이미지 리스트를 JSON으로 변환하여 DB 반영
            $sql .= ", image_files=?";
            $params[] = json_encode(array_values($final_images), JSON_UNESCAPED_UNICODE);
        } elseif ($category === 'sermon') {
            // --- 설교 수정 ---
            $passage = $_POST['passage'] ?? '';
            $preacher = $_POST['preacher'] ?? '';
            $youtube_url = $_POST['youtube_url'] ?? '';

            $sql = "UPDATE sermon SET title=?, passage=?, preacher=?, youtube_url=?, published_at=? WHERE id=?";
            $params = [$title, $passage, $preacher, $youtube_url, $published_at, $id];
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            header('Location: /admin/index.php?cat=' . $category);
            exit;

        } else {
            // --- 칼럼, 소식 수정 ---
            $table = ($category === 'column') ? '`column`' : 'news';
            $youtube_url = $_POST['youtube_url'] ?? null;

            if ($category === 'news') {
                $sql = "UPDATE news SET title=?, content=?, youtube_url=?, published_at=?";
                $params = [$title, $content, $youtube_url, $published_at];
            } else {
                $sql = "UPDATE `column` SET title=?, content=?, published_at=?";
                $params = [$title, $content, $published_at];
            }
        }

        $sql .= " WHERE id=?"; // bulletin, column, news 공통
        $params[] = $id;
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        header('Location: /admin/index.php?cat=' . $category);
        exit;

    case 'delete':
        checkAuth();
        $id = $_POST['id'];
        $category = $_POST['category'] ?? 'news'; // 폼에서 전송된 카테고리 사용

        $table = ($category === 'column') ? '`column`' : $category;

        $stmt = $pdo->prepare("DELETE FROM {$table} WHERE id = ?");
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