<?php
// html/includes/functions.php

/**
 * 유튜브 URL을 iframe용 Embed URL로 변환
 */
function getYoutubeEmbedUrl($url) {
    $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';
    if (preg_match($pattern, $url, $matches)) {
        return "https://www.youtube.com/embed/" . $matches[1];
    }
    return $url; // 변환 실패 시 원본 반환
}

/**
 * 특정 카테고리의 게시글 데이터 가져오기 (현재글 + 이전글 + 다음글)
 * $id가 null이면 가장 최신글을 가져옴
 */
function getBoardPost($pdo, $category, $id = null) {
    $table = ($category === 'column') ? '`column`' : $category;

    // 1. 현재 글 가져오기
    if ($id) {
        // 예약 게시된 글은 보이지 않도록 함
        $stmt = $pdo->prepare("SELECT * FROM {$table} WHERE id = ? AND published_at <= NOW()");
        $stmt->execute([$id]);
    } else {
        // ID가 없으면 게시일자 기준 최신글 1개
        $stmt = $pdo->prepare("SELECT * FROM {$table} WHERE published_at <= NOW() ORDER BY published_at DESC LIMIT 1");
        $stmt->execute();
    }
    
    $currentPost = $stmt->fetch();

    if (!$currentPost) return null;

    $current_published_at = $currentPost['published_at'];

    // 2. 이전 글 (현재 글보다 게시일자가 빠른 글 중 가장 최신)
    $prevStmt = $pdo->prepare("SELECT id, title FROM {$table} WHERE published_at < ? AND published_at <= NOW() ORDER BY published_at DESC LIMIT 1");
    $prevStmt->execute([$current_published_at]);
    $prevPost = $prevStmt->fetch();

    // 3. 다음 글 (현재 글보다 게시일자가 늦은 글 중 가장 빠른 것)
    $nextStmt = $pdo->prepare("SELECT id, title FROM {$table} WHERE published_at > ? AND published_at <= NOW() ORDER BY published_at ASC LIMIT 1");
    $nextStmt->execute([$current_published_at]);
    $nextPost = $nextStmt->fetch();

    return [
        'current' => $currentPost,
        'prev' => $prevPost,
        'next' => $nextPost
    ];
}
?>
