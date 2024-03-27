<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        
        <!-- Welcome banner -->
        <x-dashboard.welcome-banner />

        <!-- Dashboard actions -->
        {{-- <div class="sm:flex sm:justify-end sm:items-center mb-8">

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Datepicker built with flatpickr -->
                <x-datepicker />
                
            </div>

        </div> --}}
        
        <!-- Cards -->
        <div class="grid grid-cols-12 gap-6">
            <x-dashboard.dashboard-card-01 :data="$data" />
            <x-dashboard.dashboard-card-02 :data="$data" />
            <x-dashboard.dashboard-card-03 :data="$data" />
        </div>

    </div>
</x-app-layout>
