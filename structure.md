/ (Project Root)
├── .github/
│ └── workflows/
│ └── deploy.yml # GitHub Actions 배포 설정
├── html/ # 닷홈 웹 루트 (FTP 업로드 대상)
│ ├── .htaccess # 보안 설정 (Rewrite Rule, 파일 보호)
│ ├── index.php # 메인 라우터 및 레이아웃
│ ├── admin/ # 관리자 페이지
│ │ ├── index.php # 대시보드 (글 목록/삭제)
│ │ ├── login.php # 로그인 페이지
│ │ ├── write.php # 글쓰기/수정
│ │ ├── process.php # 데이터 처리 (CRUD)
│ │ └── auth_check.php # 세션 보안 체크 (include용)
│ ├── assets/
│ │ ├── css/ # 커스텀 CSS (Tailwind 외 필요시)
│ │ ├── js/ # main.js (다크모드, UI 인터랙션)
│ │ └── img/ # 정적 이미지
│ ├── includes/ # 공통 모듈
│ │ ├── db.php # DB 연결 (PDO)
│ │ ├── functions.php # 공통 함수 (유튜브 변환, 게시판 로직)
│ │ ├── header.php # 상단 네비게이션
│ │ └── footer.php # 하단 정보
│ ├── pages/ # 개별 페이지 콘텐츠
│ │ ├── home.php
│ │ ├── intro.php
│ │ ├── worship.php
│ │ └── board_view.php # 게시판 뷰어 (주보, 소식 등 공용)
│ └── uploads/ # 파일 업로드 저장소 (권한 777 필요)
└── README.md
