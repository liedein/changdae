<?php
/**
 * 오시는 길 페이지 (location.php)
 */
?>

<div class="max-w-5xl mx-auto px-4 py-12 md:py-20">
    <div class="text-center mb-12">
        <span class="inline-block px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Location</span>
        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-800 dark:text-white mb-4">오시는 길</h2>
        <p class="text-slate-600 dark:text-slate-400">창대교회는 여러분을 언제나 환영합니다.</p>
    </div>

    <div class="mb-10 shadow-xl rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 bg-white">
        <div id="daumRoughmapContainer1772859002282" class="root_daum_roughmap root_daum_roughmap_landing" style="width:100% !important;"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm flex items-start gap-4">
            <div class="w-10 h-10 bg-blue-50 dark:bg-blue-900/30 rounded-lg flex items-center justify-center text-blue-600 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 dark:text-white mb-1">주소</h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">경기 고양시 덕양구 중앙로558번길 7-4<br>비전프라자 7층</p>
            </div>
        </div>

        <a href="tel:031-979-9182" class="group bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm flex items-start gap-4 hover:border-blue-500 transition-colors">
            <div class="w-10 h-10 bg-green-50 dark:bg-green-900/30 rounded-lg flex items-center justify-center text-green-600 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 dark:text-white mb-1">전화</h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 group-hover:text-blue-600 font-medium transition-colors">031-979-9182</p>
                <p class="text-[10px] text-slate-400 mt-1">번호를 누르면 바로 연결됩니다.</p>
            </div>
        </a>

        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm flex items-start gap-4">
            <div class="w-10 h-10 bg-orange-50 dark:bg-orange-900/30 rounded-lg flex items-center justify-center text-orange-600 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 dark:text-white mb-1">주차 안내</h3>
                <ul class="text-sm text-slate-600 dark:text-slate-400 space-y-1 list-disc list-inside">
                    <li>건물 내 주차장 이용 가능</li>
                    <li>롯데마트 별관 주차장</li>
                </ul>
                <p class="mt-2 text-[11px] font-bold text-orange-600 bg-orange-50 inline-block px-2 py-0.5 rounded">교회에서 주차권을 제공해 드립니다.</p>
            </div>
        </div>
    </div>
</div>

<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>
<script charset="UTF-8">
	new daum.roughmap.Lander({
		"timestamp" : "1772859002282",
		"key" : "iiwsiig44hv",
		"mapWidth" : "100%", /* 가로폭을 100%로 수정하여 반응형 대응 */
		"mapHeight" : "450"
	}).render();
</script>

<style>
    /* 카카오맵 반응형 보정 */
    .root_daum_roughmap { width: 100% !important; border: none !important; }
    .root_daum_roughmap .wrap_map { height: 450px !important; }
</style>