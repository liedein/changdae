</main>

<!-- 푸터 -->
<footer class="site-footer">
  <div class="cd-container">
    <div class="footer-top">
      <div class="footer-brand">
        <p class="footer-logo">창대교회<span>.</span></p>
        <p class="footer-addr">
          경기도 고양시 덕양구 중앙로 558번길 7-4 비전프라자 7층<br>
          TEL. 031-979-9182
        </p>
      </div>
      <div class="footer-nav">
        <div class="fn-group">
          <p class="fn-title">소개합니다</p>
          <ul>
            <li><a href="#">핵심가치</a></li>
            <li><a href="#">사명</a></li>
            <li><a href="#">섬기는 사람들</a></li>
            <li><a href="#">목장모임</a></li>
            <li><a href="#">창대소식</a></li>
          </ul>
            <ul>
                <li><a href="#">핵심가치</a></li>
                <li><a href="#">사명</a></li>
                <li><a href="<?php echo G5_URL; ?>#section-people">섬기는 사람들</a></li>
                <li><a href="#">목장모임</a></li>
                <li><a href="<?php echo G5_URL; ?>/page_news.php">창대소식</a></li>
            </ul>
        </div>
        <div class="fn-group">
          <p class="fn-title">예배합니다</p>
          <ul>
            <li><a href="#">주일예배</a></li>
            <li><a href="#">목장연합기도회</a></li>
            <li><a href="#">설교동영상</a></li>
            <li><a href="#">주보</a></li>
          </ul>
            <ul>
                <li><a href="<?php echo G5_URL; ?>/page_sermon.php">주일설교</a></li>
                <li><a href="#">목장연합기도회</a></li>
                <li><a href="<?php echo get_pretty_url('sermon'); ?>">설교동영상</a></li>
                <li><a href="<?php echo G5_URL; ?>/page_bulletin.php">주보</a></li>
            </ul>
        </div>
        <div class="fn-group">
          <p class="fn-title">SNS</p>
          <ul>
            <li><a href="#" target="_blank" rel="noopener"><i class="bi bi-youtube"></i> YouTube</a></li>
            <li><a href="#" target="_blank" rel="noopener"><i class="bi bi-instagram"></i> Instagram</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <a href="#">개인정보처리방침</a>
      <span>ⓒ <?php echo date('Y'); ?> 창대교회. All rights reserved.</span>
    </div>
  </div>
</footer>

<style>
.site-footer {
  background: var(--charcoal);
  color: rgba(255,255,255,0.55);
  padding: 5rem 0 2rem;
}
.footer-top {
  display: grid;
  grid-template-columns: 1.5fr 2fr;
  gap: 4rem;
  padding-bottom: 3rem;
  border-bottom: 1px solid rgba(255,255,255,0.08);
  margin-bottom: 2rem;
}
.footer-logo {
  font-family: var(--font-ko);
  font-size: 1.2rem;
  font-weight: 700;
  color: var(--white);
  margin-bottom: 1rem;
  letter-spacing: -0.01em;
}
.footer-logo span { color: var(--point); }
.footer-addr {
  font-size: 0.86rem;
  line-height: 1.9;
}
.footer-nav {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2rem;
}
.fn-title {
  font-size: 0.82rem;
  font-weight: 600;
  color: var(--white);
  letter-spacing: 0.06em;
  margin-bottom: 1rem;
}
.fn-group ul {
  list-style: none;
  padding: 0;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}
.fn-group ul li a {
  font-size: 0.84rem;
  color: rgba(255,255,255,0.45);
  transition: color 0.2s;
}
.fn-group ul li a:hover { color: var(--point); }
.footer-bottom {
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-size: 0.8rem;
  color: rgba(255,255,255,0.3);
  flex-wrap: wrap;
  gap: 0.5rem;
}
.footer-bottom a {
  color: rgba(255,255,255,0.3);
  transition: color 0.2s;
}
.footer-bottom a:hover { color: var(--point); }

@media (max-width: 767px) {
  .footer-top { grid-template-columns: 1fr; gap: 2.5rem; }
  .footer-nav { grid-template-columns: repeat(2, 1fr); }
  .footer-bottom { flex-direction: column; align-items: flex-start; }
}
</style>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// 스크롤 시 네비 스타일
window.addEventListener('scroll', () => {
  document.getElementById('mainNav')
    .classList.toggle('scrolled', window.scrollY > 10);
}, { passive: true });

// 햄버거 / 모바일 메뉴
const hamburger = document.getElementById('hamburger');
const mobileMenu = document.getElementById('mobileMenu');

hamburger.addEventListener('click', () => {
  const isOpen = mobileMenu.classList.toggle('open');
  hamburger.classList.toggle('active', isOpen);
  document.body.style.overflow = isOpen ? 'hidden' : '';
});

// 모바일 메뉴 링크 클릭 시 닫기
mobileMenu.querySelectorAll('a').forEach(link => {
  link.addEventListener('click', () => {
    mobileMenu.classList.remove('open');
    hamburger.classList.remove('active');
    document.body.style.overflow = '';
  });
});
</script>
</body>
</html>