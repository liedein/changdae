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
                        <span class="font-medium text-[#E0E0E0]">목장연합기도회</span>
                        <span>금 오후 5:30 (월 1회)</span>
                    </div>
                    <div class="flex justify-between border-b border-[#9BA1A6]/20 pb-2">
                        <span class="font-medium text-[#E0E0E0]">월삭기도회</span>
                        <span>매월 첫 번째 새벽 오전 5:30</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 하단 링크 및 카피라이트 -->
        <div class="border-t border-[#9BA1A6]/20 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-[#9BA1A6] gap-4">
            <div class="flex gap-4">
                <button onclick="openEmailModal()" type="button" class="font-medium hover:text-white transition-colors">이메일무단수집거부</button>
            </div>
            <div class="text-center md:text-right">
                &copy; <?= date('Y') ?> Changdae Church. All rights reserved.
            </div>
        </div>
    </div>
</footer>

<!-- 이메일무단수집거부 모달 -->
<div id="email-refusal-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl max-w-md w-full overflow-hidden border border-slate-200 dark:border-slate-700 transform transition-all scale-95 opacity-0" id="email-modal-content">
        <div class="p-6">
            <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                이메일 무단수집거부
            </h3>
            <div class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed space-y-4">
                <p>본 웹사이트에 게시된 이메일 주소가 전자우편 수집 프로그램이나 그 밖의 기술적 장치를 이용하여 무단으로 수집되는 것을 거부하며, 이를 위반시 정보통신망법에 의해 형사처벌됨을 유념하시기 바랍니다.</p>
                <p class="text-slate-400 dark:text-slate-500 text-xs text-right">[게시일 2026년 3월 12일]</p>
            </div>
        </div>
        <div class="bg-slate-50 dark:bg-slate-700/50 px-6 py-4 text-right">
            <button onclick="closeEmailModal()" class="px-5 py-2 bg-slate-800 dark:bg-slate-600 text-white rounded-lg text-sm font-bold hover:bg-slate-700 dark:hover:bg-slate-500 transition-colors">확인</button>
        </div>
    </div>
</div>

<script>
    function openEmailModal(){const m=document.getElementById('email-refusal-modal'),c=document.getElementById('email-modal-content');m.classList.remove('hidden');m.classList.add('flex');setTimeout(()=>{c.classList.remove('scale-95','opacity-0');c.classList.add('scale-100','opacity-100')},10);document.body.style.overflow='hidden'}
    function closeEmailModal(){const m=document.getElementById('email-refusal-modal'),c=document.getElementById('email-modal-content');c.classList.remove('scale-100','opacity-100');c.classList.add('scale-95','opacity-0');setTimeout(()=>{m.classList.add('hidden');m.classList.remove('flex')},300);document.body.style.overflow=''}
    document.getElementById('email-refusal-modal').addEventListener('click',e=>{if(e.target===e.currentTarget)closeEmailModal()});
</script>