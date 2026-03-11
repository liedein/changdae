<footer class="bg-[#1F2123] text-[#E0E0E0] py-10 mt-auto border-t border-[#9BA1A6]/20 transition-colors duration-300">
    <div class="max-w-[1800px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
            <!-- 좌측: 교회 정보 (기존 내용 복구 필요 영역) -->
            <div>
                <h3 class="text-xl font-bold text-white mb-4 font-serif">창대교회</h3>
                <div class="space-y-2 text-sm">
                    <p><span class="font-bold text-[#9BA1A6]">담임목사</span> 김은택</p>
                    <!-- 기존에 있던 주소와 전화번호를 이곳에 입력해주세요 -->
                    <p><span class="font-bold text-[#9BA1A6]">주소</span> 경기 고양시 덕양구 중앙로558번길 7-4 비전프라자 7층</p>
                    <p><span class="font-bold text-[#9BA1A6]">전화</span> 031-979-9182</p>
                    <p><span class="font-bold text-[#9BA1A6]">이메일</span> <a href="mailto:sireuntaek@naver.com" class="hover:text-white transition-colors">sireuntaek@naver.com</a></p>
                </div>
            </div>

            <!-- 우측: 예배 안내 (요청하신 내용) -->
            <div>
                <h3 class="text-lg font-bold text-white mb-4">예배 안내</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between border-b border-[#9BA1A6]/20 pb-2">
                        <span class="font-medium text-[#E0E0E0]">주일예배</span>
                        <span>주일 오전 11:00</span>
                    </div>
                    <div class="flex justify-between border-b border-[#9BA1A6]/20 pb-2">
                        <span class="font-medium text-[#E0E0E0]">새벽기도회</span>
                        <span>화-금 오전 5:30</span>
                    </div>
                    <div class="flex justify-between border-b border-[#9BA1A6]/20 pb-2">
                        <span class="font-medium text-[#E0E0E0]">월삭기도회</span>
                        <span>매월 첫 번째 새벽 오전 5:30</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 하단 카피라이트 -->
        <div class="border-t border-[#9BA1A6]/20 mt-8 pt-8 text-center text-xs text-[#9BA1A6]">
            &copy; <?= date('Y') ?> Changdae Church. All rights reserved.
        </div>
    </div>
</footer>