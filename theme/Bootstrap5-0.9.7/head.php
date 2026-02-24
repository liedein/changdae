<?php if(!defined('_GNUBOARD_')) exit; ?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $config['cf_title']; ?></title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Pretendard -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard/dist/web/static/pretendard.css">

<!-- Cormorant Garamond (Serif) -->
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<style>
:root {
  --white:       #ffffff;
  --charcoal:    #1a1a1a;
  --point:       #4893c6;
  --point-dark:  #3a7aaa;
  --gray-bg:     #f7f7f7;
  --gray-mid:    #888888;
  --gray-line:   #e8e8e8;
  --font-ko:     'Pretendard', sans-serif;
  --font-en:     'Cormorant Garamond', serif;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
  font-family: var(--font-ko);
  color: var(--charcoal);
  background: var(--white);
  line-height: 1.75;
  -webkit-font-smoothing: antialiased;
}

a { text-decoration: none; color: inherit; }
img { max-width: 100%; display: block; }

/* ════════════════════════════
   네비게이션
════════════════════════════ */
#mainNav {
  position: fixed;
  top: 0; left: 0; right: 0;
  z-index: 900;
  background: var(--white);
  border-bottom: 1px solid transparent;
  transition: border-color 0.3s, box-shadow 0.3s;
  height: 68px;
  display: flex;
  align-items: center;
}
#mainNav.scrolled {
  border-color: var(--gray-line);
  box-shadow: 0 2px 20px rgba(0,0,0,0.06);
}

.nav-inner {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

/* 로고 */
.nav-logo {
  font-family: var(--font-ko);
  font-size: 1.15rem;
  font-weight: 700;
  color: var(--charcoal);
  letter-spacing: -0.01em;
  flex-shrink: 0;
}
.nav-logo span { color: var(--point); }

/* PC 메뉴 */
.pc-menu {
  display: flex;
  align-items: center;
  gap: 0;
  list-style: none;
}
.pc-menu > li {
  position: relative;
}
.pc-menu > li > a {
  display: flex;
  align-items: center;
  gap: 0.25rem;
  padding: 0 1.1rem;
  height: 68px;
  font-size: 0.9rem;
  font-weight: 500;
  color: var(--charcoal);
  letter-spacing: 0.01em;
  transition: color 0.2s;
  white-space: nowrap;
}
.pc-menu > li > a:hover,
.pc-menu > li:hover > a { color: var(--point); }

/* 드롭다운 */
.pc-dropdown {
  position: absolute;
  top: 100%; left: 50%;
  transform: translateX(-50%);
  background: var(--white);
  border-top: 2px solid var(--point);
  box-shadow: 0 8px 32px rgba(0,0,0,0.08);
  min-width: 160px;
  list-style: none;
  padding: 0.5rem 0;
  opacity: 0;
  visibility: hidden;
  transform: translateX(-50%) translateY(6px);
  transition: opacity 0.2s, transform 0.2s, visibility 0.2s;
}
.pc-menu > li:hover .pc-dropdown {
  opacity: 1;
  visibility: visible;
  transform: translateX(-50%) translateY(0);
}
.pc-dropdown li a {
  display: block;
  padding: 0.55rem 1.3rem;
  font-size: 0.86rem;
  color: var(--charcoal);
  white-space: nowrap;
  transition: color 0.2s, background 0.2s;
}
.pc-dropdown li a:hover {
  color: var(--point);
  background: var(--gray-bg);
}

/* 햄버거 버튼 */
.hamburger {
  display: none;
  flex-direction: column;
  justify-content: center;
  gap: 5px;
  width: 32px;
  height: 32px;
  background: none;
  border: none;
  cursor: pointer;
  padding: 0;
  z-index: 1100;
}
.hamburger span {
  display: block;
  width: 24px;
  height: 1.5px;
  background: var(--charcoal);
  transition: transform 0.3s, opacity 0.3s, width 0.3s;
  transform-origin: center;
}
.hamburger.active span:nth-child(1) { transform: translateY(6.5px) rotate(45deg); }
.hamburger.active span:nth-child(2) { opacity: 0; }
.hamburger.active span:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); }

/* ════════════════════════════
   모바일 풀스크린 메뉴
════════════════════════════ */
#mobileMenu {
  position: fixed;
  inset: 0;
  z-index: 1000;
  background: var(--white);
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 5rem 3rem 3rem;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.35s, visibility 0.35s;
  overflow-y: auto;
}
#mobileMenu.open {
  opacity: 1;
  visibility: visible;
}

.mobile-nav-list {
  list-style: none;
  padding: 0;
}
.mobile-nav-list > li {
  border-bottom: 1px solid var(--gray-line);
  padding: 1rem 0;
}
.mobile-nav-list > li > a {
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--charcoal);
  letter-spacing: -0.01em;
  transition: color 0.2s;
}
.mobile-nav-list > li > a:hover { color: var(--point); }

.mobile-sub {
  list-style: none;
  padding: 0.6rem 0 0 0.5rem;
  display: flex;
  flex-direction: column;
  gap: 0.4rem;
}
.mobile-sub li a {
  font-size: 0.95rem;
  color: var(--gray-mid);
  transition: color 0.2s;
}
.mobile-sub li a:hover { color: var(--point); }

/* ════════════════════════════
   반응형
════════════════════════════ */
@media (max-width: 991px) {
  .pc-menu { display: none; }
  .hamburger { display: flex; }
}
</style>
</head>
<body>

<!-- 네비게이션 -->
<nav id="mainNav">
  <div class="nav-inner">
    <a href="/" class="nav-logo">창대교회<span>.</span></a>

    <!-- PC 메뉴 -->
    <ul class="pc-menu">
      <li>
        <a href="#">환영합니다</a>
      </li>
      <li>
        <a href="#">소개합니다 <i class="bi bi-chevron-down" style="font-size:0.7rem;"></i></a>
        <ul class="pc-dropdown">
          <li><a href="#">핵심가치</a></li>
          <li><a href="#">사명</a></li>
          <li><a href="#">섬기는 사람들</a></li>
          <li><a href="#">목장모임</a></li>
          <li><a href="#">창대소식</a></li>
        </ul>
      </li>
      <li>
        <a href="#">예배합니다 <i class="bi bi-chevron-down" style="font-size:0.7rem;"></i></a>
        <ul class="pc-dropdown">
          <li><a href="#">주일예배</a></li>
          <li><a href="#">목장연합기도회</a></li>
          <li><a href="#">설교동영상</a></li>
          <li><a href="#">주보</a></li>
        </ul>
      </li>
    </ul>

    <!-- 햄버거 -->
    <button class="hamburger" id="hamburger" aria-label="메뉴">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<!-- 모바일 풀스크린 메뉴 -->
<div id="mobileMenu">
  <ul class="mobile-nav-list">
    <li>
      <a href="#">환영합니다</a>
    </li>
    <li>
      <a href="#">소개합니다</a>
      <ul class="mobile-sub">
        <li><a href="#">핵심가치</a></li>
        <li><a href="#">사명</a></li>
        <li><a href="#">섬기는 사람들</a></li>
        <li><a href="#">목장모임</a></li>
        <li><a href="#">창대소식</a></li>
      </ul>
    </li>
    <li>
      <a href="#">예배합니다</a>
      <ul class="mobile-sub">
        <li><a href="#">주일예배</a></li>
        <li><a href="#">목장연합기도회</a></li>
        <li><a href="#">설교동영상</a></li>
        <li><a href="#">주보</a></li>
      </ul>
    </li>
  </ul>
</div>

<!-- 본문 시작 (네비 높이만큼 여백) -->
<main style="padding-top: 68px;">