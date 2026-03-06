<?php
$sub = $_GET['sub'] ?? 'vision';
?>

<?php if ($sub === 'vision'): ?>
    <div class="max-w-7xl mx-auto px-4 py-32 text-center animate-fade-in-up">
        <h2 class="text-3xl font-bold mb-4 font-serif text-charcoal dark:text-white">비전과 철학</h2>
        <div class="w-12 h-1 bg-deepblue mx-auto mb-8"></div>
        <p class="text-gray-500 dark:text-gray-400">페이지 준비 중입니다.</p>
    </div>

<?php elseif ($sub === 'mission'): ?>
    <div class="max-w-7xl mx-auto px-4 py-32 text-center animate-fade-in-up">
        <h2 class="text-3xl font-bold mb-4 font-serif text-charcoal dark:text-white">사명</h2>
        <div class="w-12 h-1 bg-deepblue mx-auto mb-8"></div>
        <p class="text-gray-500 dark:text-gray-400">페이지 준비 중입니다.</p>
    </div>

<?php elseif ($sub === 'staff'): ?>
    <div class="max-w-7xl mx-auto px-4 py-12 animate-fade-in-up">
        <h2 class="text-3xl font-bold text-center mb-12 font-serif text-charcoal dark:text-white">섬기는 사람들</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php
            $staffs = [
                ['name' => '김은택', 'role' => '담임목사', 'img' => 'https://placehold.co/400x500/e2e8f0/1e293b?text=Pastor'],
                ['name' => '진숙영', 'role' => '팡가웨 중고등부 디렉터', 'img' => 'https://placehold.co/400x500/e2e8f0/1e293b?text=Director'],
                ['name' => '유경아', 'role' => 'GST 초등부 디렉터', 'img' => 'https://placehold.co/400x500/e2e8f0/1e293b?text=Director'],
                ['name' => '이명희', 'role' => 'GST 유년부 디렉터', 'img' => 'https://placehold.co/400x500/e2e8f0/1e293b?text=Director'],
            ];
            foreach ($staffs as $staff):
            ?>
            <div class="group relative overflow-hidden rounded-lg shadow-lg aspect-[3/4] bg-gray-200">
                <img src="<?= $staff['img'] ?>" alt="<?= $staff['name'] ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <!-- Hover Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                    <h3 class="text-white text-xl font-bold mb-1"><?= $staff['name'] ?></h3>
                    <p class="text-gray-300 text-sm font-medium"><?= $staff['role'] ?></p>
                </div>
                <!-- Mobile Visible Label (Optional) -->
                <div class="absolute bottom-0 left-0 right-0 bg-white/90 dark:bg-gray-800/90 p-4 md:hidden backdrop-blur-sm">
                    <h3 class="text-charcoal dark:text-white font-bold"><?= $staff['name'] ?></h3>
                    <p class="text-gray-600 dark:text-gray-300 text-xs"><?= $staff['role'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php elseif ($sub === 'cell'): ?>
    <div class="max-w-7xl mx-auto px-4 py-12 animate-fade-in-up">
        <h2 class="text-3xl font-bold text-center mb-12 font-serif text-charcoal dark:text-white">목장</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php for($i=1; $i<=6; $i++): ?>
            <div class="group relative overflow-hidden rounded-lg shadow-lg aspect-[4/3] bg-gray-200">
                <img src="https://placehold.co/600x450/e2e8f0/1e293b?text=Cell+<?= $i ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <h3 class="text-white text-xl font-bold">목장 <?= $i ?></h3>
                </div>
                <div class="absolute bottom-0 left-0 right-0 bg-white/90 dark:bg-gray-800/90 p-3 md:hidden backdrop-blur-sm text-center">
                    <h3 class="text-charcoal dark:text-white font-bold">목장 <?= $i ?></h3>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>

<?php elseif ($sub === 'study'): ?>
    <div class="max-w-4xl mx-auto px-4 py-12 animate-fade-in-up">
        <h2 class="text-3xl font-bold text-center mb-12 font-serif text-charcoal dark:text-white">삶공부</h2>
        <div class="grid gap-6">
            <?php
            $studies = [
                ['title' => '예수영접모임', 'desc' => '예수님이 누구신지 듣고 그분을 마음에 모십니다.'],
                ['title' => '생명의 삶', 'desc' => '복음의 핵심을 공부하며 신앙의 기초를 다집니다.'],
                ['title' => '새로운 삶', 'desc' => '성경적인 가치관을 재정립하고 실천할 수 있게 합니다.'],
                ['title' => '경건의 삶', 'desc' => '경건생활의 훈련을 통해 성숙한 그리스도인으로 자랍니다.'],
                ['title' => '말씀중보기도의 삶', 'desc' => '하나님의 임재 속에서 기도하는 법을 배웁니다.'],
                ['title' => '생명언어의 삶', 'desc' => '언어생활의 변화를 통해 예수님의 인격을 닮아갑니다.'],
                ['title' => '예비부부의 삶', 'desc' => '나와 상대방을 바로 알고 결혼에 대한 바른 기대와 계획을 갖게 합니다.'],
                ['title' => '행복한 삶', 'desc' => '내가 누구인지, 삶의 진정한 행복은 어디에 있는지 생각해 봅니다.'],
                ['title' => '기도의 삶', 'desc' => '기도가 무엇인지 배우고, 기도로 하나님께 나아갑니다.'],
            ];
            foreach ($studies as $study):
            ?>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md hover:border-deepblue dark:hover:border-blue-500 transition-all duration-300 group">
                <h3 class="text-xl font-bold text-charcoal dark:text-white mb-2 group-hover:text-deepblue dark:group-hover:text-blue-400 transition-colors"><?= $study['title'] ?></h3>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed"><?= $study['desc'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php elseif ($sub === 'location'): ?>
    <div class="max-w-7xl mx-auto px-4 py-12 animate-fade-in-up">
        <h2 class="text-3xl font-bold text-center mb-12 font-serif text-charcoal dark:text-white">오시는 길</h2>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Map -->
            <div class="lg:col-span-2 h-[400px] bg-gray-200 rounded-lg overflow-hidden shadow-md relative">
                <!-- Kakao Map Iframe Fallback (API Key 없이 사용 가능한 검색 결과 맵) -->
                <iframe 
                    src="https://m.map.kakao.com/actions/searchView?q=경기 고양시 덕양구 중앙로558번길 7-4&wxEnc=LVSOTP&wyEnc=QNLSSO&lvl=4" 
                    width="100%" 
                    height="100%" 
                    frameborder="0" 
                    style="border:0;" 
                    allowfullscreen="" 
                    aria-hidden="false" 
                    tabindex="0">
                </iframe>
                <div class="absolute bottom-2 right-2 bg-white/80 px-2 py-1 text-xs rounded text-gray-600">
                    * 카카오맵 검색 결과
                </div>
            </div>

            <!-- Info -->
            <div class="space-y-8 bg-gray-50 dark:bg-gray-800 p-8 rounded-lg">
                <div>
                    <h3 class="text-xl font-bold text-deepblue dark:text-blue-400 mb-2">주소</h3>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">경기 고양시 덕양구 중앙로558번길 7-4<br>비전프라자 7층</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-deepblue dark:text-blue-400 mb-2">전화</h3>
                    <p class="text-gray-700 dark:text-gray-300">031-979-9182</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-deepblue dark:text-blue-400 mb-2">주차 안내</h3>
                    <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-2 text-sm">
                        <li><span class="font-semibold">건물 내 주차장</span> 이용 가능</li>
                        <li><span class="font-semibold">롯데마트 별관 주차장</span> (교회에서 주차권 제공)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
