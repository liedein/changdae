<?php if(!defined('_GNUBOARD_')) exit; ?>

<!-- ════════════════════════════
     히어로
════════════════════════════ -->
<section class="hero">
  <div class="hero-inner">
    <p class="hero-en">Changdae Church · Goyang</p>
    <h1 class="hero-headline">
      <span class="hero-line1">영혼 구원하여</span>
      <span class="hero-line2">제자 삼는 교회</span>
    </h1>
    <p class="hero-desc">당신을 향한 하나님의 사랑이 시작되는 곳입니다.</p>
    <div class="hero-actions">
      <a href="#" class="btn-primary">새가족 등록</a>
      <a href="#worship" class="btn-ghost">예배 안내 →</a>
    </div>
  </div>
  <div class="hero-deco" aria-hidden="true">
    <span class="deco-text">CHANGDAE</span>
  </div>
</section>

<!-- ════════════════════════════
     예배 안내
════════════════════════════ -->
<section id="worship" class="section-worship">
  <div class="cd-container">
    <div class="sec-label">Worship</div>
    <h2 class="sec-title">예배 안내</h2>
    <div class="worship-grid">
      <div class="worship-item">
        <div class="wi-time">SUN</div>
        <h3>주일 1부 예배</h3>
        <p>오전 9:00</p>
      </div>
      <div class="worship-item">
        <div class="wi-time">SUN</div>
        <h3>주일 2부 예배</h3>
        <p>오전 11:00</p>
      </div>
      <div class="worship-item">
        <div class="wi-time">WED</div>
        <h3>목장연합기도회</h3>
        <p>오후 7:30</p>
      </div>
      <div class="worship-item">
        <div class="wi-time">MON–SAT</div>
        <h3>새벽 기도회</h3>
        <p>오전 5:30</p>
      </div>
    </div>
  </div>
</section>

<!-- ════════════════════════════
     섬기는 사람들
════════════════════════════ -->
<section class="section-people">
  <div class="cd-container">
    <div class="sec-label">Our Team</div>
    <h2 class="sec-title">섬기는 사람들</h2>
    <div class="people-grid">
      <?php
      $people = [
        ['name'=>'김은택', 'role'=>'담임목사'],
        ['name'=>'김성진', 'role'=>'원로목사'],
        ['name'=>'손재용', 'role'=>'장로'],
        ['name'=>'김옥진', 'role'=>'은퇴장로'],
        ['name'=>'진숙영', 'role'=>'중고등부 디렉터'],
        ['name'=>'유경아', 'role'=>'주일학교 디렉터'],
        ['name'=>'이명희', 'role'=>'유초등부 디렉터'],
      ];
      foreach($people as $p): ?>
      <div class="people-card">
        <div class="people-photo">
          <div class="people-photo-inner">
            <i class="bi bi-person"></i>
          </div>
        </div>
        <div class="people-info">
          <p class="people-role"><?php echo $p['role']; ?></p>
          <h3 class="people-name"><?php echo $p['name']; ?></h3>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ════════════════════════════
     최신 설교
════════════════════════════ -->
<section class="section-sermon">
  <div class="cd-container">
    <div class="sec-header-row">
      <div>
        <div class="sec-label">Sermon</div>
        <h2 class="sec-title">최신 설교</h2>
      </div>
      <a href="#" class="link-more">전체 보기 <i class="bi bi-arrow-right"></i></a>
    </div>
    <?php
    // 설교동영상 게시판 최신글 3개 불러오기
    // 게시판 테이블명: g5_write_설교동영상 (관리자에서 영문 테이블명 확인 필요)
    $sermon_board = 'sermon'; // ← 관리자에서 설정한 영문 테이블명으로 변경
    $sermon_list = get_board_list($sermon_board, 3);
    ?>
    <div class="sermon-grid">
      <?php if(!empty($sermon_list)): ?>
        <?php foreach($sermon_list as $row): ?>
        <div class="sermon-card">
          <?php
          // 유튜브 링크 추출
          preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $row['wr_content'], $matches);
          $vid = isset($matches[1]) ? $matches[1] : '';
          ?>
          <div class="sermon-thumb">
            <?php if($vid): ?>
              <iframe src="https://www.youtube.com/embed/<?php echo $vid; ?>"
                title="<?php echo htmlspecialchars($row['wr_subject']); ?>"
                frameborder="0" allowfullscreen loading="lazy"></iframe>
            <?php else: ?>
              <div class="sermon-no-video"><i class="bi bi-play-circle"></i></div>
            <?php endif; ?>
          </div>
          <div class="sermon-info">
            <span class="sermon-date"><?php echo substr($row['wr_datetime'],0,10); ?></span>
            <h4 class="sermon-subject"><?php echo htmlspecialchars($row['wr_subject']); ?></h4>
          </div>
        </div>
        <?php endforeach; ?>
      <?php else: ?>
        <!-- 게시판 연동 전 샘플 -->
        <?php for($i=1;$i<=3;$i++): ?>
        <div class="sermon-card">
          <div class="sermon-thumb">
            <iframe src="https://www.youtube.com/embed/qjIR1rkkr7w"
              title="설교영상" frameborder="0" allowfullscreen loading="lazy"></iframe>
          </div>
          <div class="sermon-info">
            <span class="sermon-date">2025.02.16</span>
            <h4 class="sermon-subject">설교 제목이 여기에 표시됩니다</h4>
          </div>
        </div>
        <?php endfor; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- ════════════════════════════
     최신 주보
════════════════════════════ -->
<section class="section-bulletin">
  <div class="cd-container">
    <div class="sec-header-row">
      <div>
        <div class="sec-label">Bulletin</div>
        <h2 class="sec-title">주보</h2>
      </div>
      <a href="#" class="link-more">전체 보기 <i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="bulletin-wrap">
      <?php
      $bulletin_board = 'bulletin'; // ← 관리자에서 설정한 영문 테이블명으로 변경
      $bulletin_list = get_board_list($bulletin_board, 1);
      $bulletin = !empty($bulletin_list) ? $bulletin_list[0] : null;
      ?>
      <?php if($bulletin && $bulletin['wr_file']): ?>
        <img src="<?php echo $bulletin['wr_file']; ?>" alt="<?php echo htmlspecialchars($bulletin['wr_subject']); ?>" class="bulletin-img">
      <?php else: ?>
        <div class="bulletin-placeholder">
          <i class="bi bi-newspaper"></i>
          <p>주보가 등록되면 여기에 표시됩니다.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<style>
/* ════════════════════════════
   공통
════════════════════════════ */
.cd-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
}
.sec-label {
  font-family: var(--font-en);
  font-size: 0.82rem;
  letter-spacing: 0.22em;
  text-transform: uppercase;
  color: var(--point);
  margin-bottom: 0.4rem;
}
.sec-title {
  font-size: clamp(1.6rem, 3vw, 2.2rem);
  font-weight: 700;
  letter-spacing: -0.025em;
  color: var(--charcoal);
  margin-bottom: 0;
}
.sec-header-row {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  margin-bottom: 2.5rem;
}
.link-more {
  font-size: 0.86rem;
  color: var(--point);
  transition: color 0.2s;
  padding-bottom: 0.2rem;
}
.link-more:hover { color: var(--point-dark); }

/* ════════════════════════════
   히어로
════════════════════════════ */
.hero {
  position: relative;
  min-height: 100svh;
  display: flex;
  align-items: center;
  background: var(--white);
  overflow: hidden;
  padding: 6rem 2rem 4rem;
}
.hero-inner {
  max-width: 1200px;
  margin: 0 auto;
  width: 100%;
  position: relative;
  z-index: 2;
}
.hero-en {
  font-family: var(--font-en);
  font-size: 0.9rem;
  letter-spacing: 0.25em;
  text-transform: uppercase;
  color: var(--point);
  margin-bottom: 1.5rem;
}
.hero-headline {
  display: flex;
  flex-direction: column;
  font-size: clamp(3rem, 9vw, 7.5rem);
  font-weight: 700;
  letter-spacing: -0.04em;
  line-height: 1.05;
  color: var(--charcoal);
  margin-bottom: 2rem;
}
.hero-line2 {
  color: var(--point);
}
.hero-desc {
  font-size: clamp(0.95rem, 1.5vw, 1.1rem);
  color: var(--gray-mid);
  margin-bottom: 2.5rem;
  font-weight: 300;
  letter-spacing: 0.01em;
}
.hero-actions {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
}
.btn-primary {
  background: var(--point);
  color: var(--white);
  padding: 0.8rem 2rem;
  font-size: 0.9rem;
  font-weight: 600;
  letter-spacing: 0.04em;
  transition: background 0.2s;
  border-radius: 2px;
}
.btn-primary:hover { background: var(--point-dark); color: var(--white); }
.btn-ghost {
  border: 1px solid var(--gray-line);
  color: var(--charcoal);
  padding: 0.8rem 2rem;
  font-size: 0.9rem;
  font-weight: 400;
  letter-spacing: 0.02em;
  transition: border-color 0.2s, color 0.2s;
  border-radius: 2px;
}
.btn-ghost:hover { border-color: var(--charcoal); color: var(--charcoal); }

/* 데코 텍스트 */
.hero-deco {
  position: absolute;
  right: -2rem;
  bottom: 2rem;
  z-index: 1;
  pointer-events: none;
  user-select: none;
}
.deco-text {
  font-family: var(--font-en);
  font-size: clamp(5rem, 15vw, 13rem);
  font-weight: 700;
  color: rgba(72,147,198,0.05);
  letter-spacing: -0.04em;
  line-height: 1;
  white-space: nowrap;
}

/* ════════════════════════════
   예배 안내
════════════════════════════ */
.section-worship {
  padding: 7rem 0;
  background: var(--gray-bg);
}
.section-worship .sec-title { margin-bottom: 3rem; }
.worship-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1px;
  background: var(--gray-line);
  border: 1px solid var(--gray-line);
}
.worship-item {
  background: var(--white);
  padding: 2.5rem 2rem;
  transition: background 0.2s;
}
.worship-item:hover { background: var(--gray-bg); }
.wi-time {
  font-family: var(--font-en);
  font-size: 0.75rem;
  letter-spacing: 0.2em;
  color: var(--point);
  margin-bottom: 1rem;
}
.worship-item h3 {
  font-size: 1rem;
  font-weight: 700;
  color: var(--charcoal);
  margin-bottom: 0.4rem;
  letter-spacing: -0.01em;
}
.worship-item p {
  font-size: 0.88rem;
  color: var(--gray-mid);
}

/* ════════════════════════════
   섬기는 사람들
════════════════════════════ */
.section-people {
  padding: 7rem 0;
  background: var(--white);
}
.section-people .sec-title { margin-bottom: 3rem; }
.people-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2rem;
}
.people-card {
  text-align: center;
}
.people-photo {
  width: 100%;
  aspect-ratio: 1;
  margin-bottom: 1.2rem;
  overflow: hidden;
  background: var(--gray-bg);
  border-radius: 2px;
}
.people-photo-inner {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 3.5rem;
  color: var(--gray-line);
}
.people-role {
  font-family: var(--font-en);
  font-size: 0.78rem;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  color: var(--point);
  margin-bottom: 0.3rem;
}
.people-name {
  font-size: 1.05rem;
  font-weight: 700;
  color: var(--charcoal);
  letter-spacing: -0.01em;
}

/* ════════════════════════════
   최신 설교
════════════════════════════ */
.section-sermon {
  padding: 7rem 0;
  background: var(--gray-bg);
}
.sermon-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.5rem;
}
.sermon-card {
  background: var(--white);
  overflow: hidden;
  border-radius: 2px;
  transition: transform 0.2s, box-shadow 0.2s;
}
.sermon-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 32px rgba(0,0,0,0.07);
}
.sermon-thumb {
  position: relative;
  padding-bottom: 56.25%;
  height: 0;
  overflow: hidden;
  background: var(--charcoal);
}
.sermon-thumb iframe {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
}
.sermon-no-video {
  position: absolute;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2.5rem;
  color: rgba(255,255,255,0.3);
}
.sermon-info { padding: 1.2rem; }
.sermon-date {
  font-size: 0.78rem;
  color: var(--gray-mid);
  display: block;
  margin-bottom: 0.4rem;
}
.sermon-subject {
  font-size: 0.97rem;
  font-weight: 600;
  color: var(--charcoal);
  line-height: 1.5;
  margin: 0;
}

/* ════════════════════════════
   주보
════════════════════════════ */
.section-bulletin {
  padding: 7rem 0;
  background: var(--white);
}
.bulletin-wrap {
  max-width: 480px;
  margin: 0 auto;
  text-align: center;
}
.bulletin-img {
  width: 100%;
  border: 1px solid var(--gray-line);
  border-radius: 2px;
}
.bulletin-placeholder {
  width: 100%;
  aspect-ratio: 3/4;
  background: var(--gray-bg);
  border: 1px solid var(--gray-line);
  border-radius: 2px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 1rem;
  color: var(--gray-mid);
  font-size: 0.9rem;
}
.bulletin-placeholder i { font-size: 2.5rem; color: var(--gray-line); }

/* ════════════════════════════
   반응형
════════════════════════════ */
@media (max-width: 1024px) {
  .people-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 767px) {
  .worship-grid { grid-template-columns: repeat(2, 1fr); }
  .sermon-grid { grid-template-columns: 1fr; }
  .people-grid { grid-template-columns: repeat(2, 1fr); }
  .sec-header-row { flex-direction: column; align-items: flex-start; gap: 0.5rem; }
  .hero-headline { font-size: clamp(2.5rem, 12vw, 4rem); }
}
@media (max-width: 480px) {
  .worship-grid { grid-template-columns: 1fr; }
  .people-grid { grid-template-columns: repeat(2, 1fr); }
}
</style>