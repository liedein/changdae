<?php
/**
 * 오시는 길 페이지 (location.php)
 * 지도 하단 중복 텍스트 제거 및 디자인 최적화
 */
?>

<div class="max-w-5xl mx-auto px-4 py-12 md:py-20">
    <div class="text-center mb-12">
        <span class="inline-block px-4 py-1 bg-[#FFD400] text-black font-black tracking-widest uppercase text-xs rounded-full mb-4">Location</span>
        <h2 class="text-4xl md:text-5xl font-black text-black dark:text-[#FFD400] mb-4 tracking-tighter italic uppercase">Visit Us</h2>
        <p class="text-slate-600 dark:text-slate-400 font-bold">하나님의 사랑이 머무는 창대교회로 여러분을 초대합니다.</p>
    </div>

    <div class="mb-10 shadow-[20px_20px_0px_0px_#FFD400] overflow-hidden border-4 border-black dark:border-[#FFD400] bg-white">
        <div id="daumRoughmapContainer1772859002282" class="root_daum_roughmap root_daum_roughmap_landing" style="width:100% !important;"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-[#262626] p-8 border-2 border-black dark:border-[#FFD400] flex items-start gap-4">
            <div class="w-10 h-10 bg-black text-[#FFD400] rounded-lg flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </div>
            <div>
                <h3 class="font-black text-black dark:text-white mb-2 uppercase tracking-tighter">Address</h3>
                <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed font-bold">경기 고양시 덕양구 중앙로558번길 7-4<br>비전프라자 7층</p>
            </div>
        </div>

        <a href="tel:031-979-9182" class="group bg-white dark:bg-[#262626] p-8 border-2 border-black dark:border-[#FFD400] flex items-start gap-4 hover:bg-black transition-all">
            <div class="w-10 h-10 bg-black text-[#FFD400] rounded-lg flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
            </div>
            <div>
                <h3 class="font-black text-black dark:text-white mb-2 uppercase tracking-tighter group-hover:text-[#FFD400]">Phone</h3>
                <p class="text-xl font-black text-black dark:text-white group-hover:text-[#FFD400]">031-979-9182</p>
                <p class="text-[10px] text-slate-400 mt-1 uppercase">Click to call</p>
            </div>
        </a>

        <div class="bg-white dark:bg-[#262626] p-8 border-2 border-black dark:border-[#FFD400] flex items-start gap-4">
            <div class="w-10 h-10 bg-black text-[#FFD400] rounded-lg flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
            </div>
            <div>
                <h3 class="font-black text-black dark:text-white mb-2 uppercase tracking-tighter">Parking</h3>
                <ul class="text-sm text-slate-700 dark:text-slate-300 space-y-1 font-bold">
                    <li>• 건물 내 주차장</li>
                    <li>• 롯데마트 별관 주차장</li>
                </ul>
                <p class="mt-3 text-[11px] font-black text-white bg-black dark:bg-[#FFD400] dark:text-black inline-block px-2 py-1 uppercase">Free Parking Pass</p>
            </div>
        </div>
    </div>
</div>

<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>
<script charset="UTF-8">
    new daum.roughmap.Lander({
        "timestamp" : "1772859002282",
        "key" : "iiwsiig44hv",
        "mapWidth" : "100%",
        "mapHeight" : "450"
    }).render();
</script>

<style>
    /* 1. 카카오맵 기본 하단 정보 영역(주소, 전화번호 등) 강제 제거 */
    .root_daum_roughmap .wrap_controllers,
    .root_daum_roughmap .hide,
    .root_daum_roughmap .foot_type1 { display: none !important; }
    
    /* 2. 지도 테두리 및 그림자 보정 */
    .root_daum_roughmap { width: 100% !important; border: none !important; padding: 0 !important; }
    .root_daum_roughmap .wrap_map { height: 450px !important; border: none !important; }
</style>