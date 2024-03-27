<div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
    <div class="px-5 pt-5">
        <p class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase mb-1">Sales</p>
        <header class="flex items-center gap-2 mb-2">
            <img src="{{ asset('icons/tiktok.svg') }}" width="44" height="44" alt="tiktok" />
            <div class="text-3xl font-bold text-slate-800 dark:text-slate-100">{{ $data->sumData('tiktok') }}</div>
        </header>
    </div>
    <!-- Chart built with Chart.js 3 -->
    <!-- Check out src/js/components/dashboard-card-02.js for config -->
    <div class="grow max-sm:max-h-[128px] xl:max-h-[128px]">
        <!-- Change the height attribute to adjust the chart height -->
        <canvas id="dashboard-card-02" width="389" height="128"></canvas>
    </div>
</div>
