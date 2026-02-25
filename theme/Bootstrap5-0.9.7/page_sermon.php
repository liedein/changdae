<?php
include_once('./_common.php');

$bo_table = 'sermon';
$board = sql_fetch(" select * from {$g5['board_table']} where bo_table = '{$bo_table}' ");
if (!$board['bo_table']) alert('존재하지 않는 게시판입니다.');

$latest = sql_fetch(" select * from {$g5['write_prefix']}{$bo_table} where wr_is_comment = 0 order by wr_num limit 1 ");
if (!$latest['wr_id']) alert('게시글이 없습니다.');

$prev = sql_fetch(" select wr_id, wr_subject from {$g5['write_prefix']}{$bo_table} where wr_is_comment = 0 and wr_num < '{$latest['wr_num']}' order by wr_num desc limit 1 ");
$next = sql_fetch(" select wr_id, wr_subject from {$g5['write_prefix']}{$bo_table} where wr_is_comment = 0 and wr_num > '{$latest['wr_num']}' order by wr_num asc limit 1 ");

$g5['title'] = $board['bo_subject'];
include_once(G5_THEME_PATH.'/head.php');
?>

<div class="cd-container" style="padding-top: 5rem; padding-bottom: 5rem;">
    <h2 class="sec-title" style="text-align:center; margin-bottom: 3rem;"><?php echo get_text($latest['wr_subject']); ?></h2>

    <div class="page-content">
        <?php echo conv_content($latest['wr_content'], 1); ?>
    </div>

    <div class="page-nav">
        <?php if (isset($prev['wr_id']) && $prev['wr_id']): ?>
        <a href="<?php echo get_pretty_url($bo_table, $prev['wr_id']); ?>" class="btn-prev">
            <span class="label">이전 설교</span>
            <span class="title"><?php echo get_text($prev['wr_subject']); ?></span>
        </a>
        <?php else: ?>
        <div class="btn-prev-empty"></div>
        <?php endif; ?>

        <a href="<?php echo get_pretty_url($bo_table); ?>" class="btn-list">목록</a>

        <?php if (isset($next['wr_id']) && $next['wr_id']): ?>
        <a href="<?php echo get_pretty_url($bo_table, $next['wr_id']); ?>" class="btn-next">
            <span class="label">다음 설교</span>
            <span class="title"><?php echo get_text($next['wr_subject']); ?></span>
        </a>
        <?php else: ?>
        <div class="btn-next-empty"></div>
        <?php endif; ?>
    </div>
</div>

<!-- 페이지 공통 스타일 -->
<link rel="stylesheet" href="<?php echo G5_THEME_URL; ?>/css/page.css">

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>