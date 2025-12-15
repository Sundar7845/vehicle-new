@extends('backend.layout')
@section('title')
    OTP Page
@endsection
@section('content')
    <section class="bg-white p-4">

        <div class="flex items-center justify-between">
            <div class="font-medium flex justify-center items-center gap-1">
                <a href="{{ route('backend.site') }}"
                    class="bg-black rounded-full w-8 h-8 flex justify-center items-center text-[#FED428]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>

                </a>
                <div>
                    <div class="text-sm font-semibold">{{ $site->site_name }}</div>
                    <div class="text-xs font-light">({{ $site->short_name }})</div>
                </div>
            </div>

        </div>
    </section>


    <section class="px-4 pt-6">

        <!-- OTP List -->
        <div id="otp-container" class="space-y-4"></div>
    </section>

    {{-- <div class="flex-1">
        <input type="date" name="date" id="date"
            class="bg-[#FED428] text-black font-medium rounded-sm px-4 h-12 w-full" placeholder="Select Date">
    </div> --}}

    <section class="px-4 mt-10">
        <div class="flex gap-4">

            {{-- Total Units --}}
            <div class="flex-1">
                <div
                    class="bg-[#FED428] text-black font-medium rounded-sm px-4 h-12 w-full flex items-center justify-center">
                    <p>Total Units : {{ $display }}</p>
                </div>
            </div>

            {{-- Party Select --}}
            <div class="flex-1">
                <select name="siteName" id="siteName"
                    class="bg-[#FED428] text-black font-medium rounded-sm px-4 h-12 w-full">
                    <option value="">Select Party</option>
                    @foreach ($parties as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>
    </section>


    <section class="px-4 mt-10 bg-white py-6 page-content">
        <div>

            <!-- Header + Search -->
            <div class="flex flex-wrap justify-between items-center gap-2 mb-3">
                <h2 class="text-base font-semibold">Today’s Stats</h2>
            </div>

            <!-- Table Container -->
            <div class="overflow-x-auto">
                <input type="hidden" id="siteId" value="{{ $site->id }}">
                <table class="w-full text-[11px] text-left whitespace-nowrap  border border-[#E2E2E2]"
                    id="talukVehicleTable">

                    <!-- Table Head -->
                    <thead class="bg-black text-white">
                        <tr>
                            <th class="text-center py-2 px-1 border-r border-[#E2E2E2]">V. No</th>
                            <th class="text-center py-2 px-1 border-r border-[#E2E2E2]">Date</th>
                            <th class="text-center py-2 px-1 border-r border-[#E2E2E2]">units</th>
                            <th class="text-center py-2 px-1 border-r border-[#E2E2E2]">In Time</th>
                            <th class="text-center py-2 px-1 border-r border-[#E2E2E2]">out Time</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
<style>
    /* Circle that shrinks like Google Authenticator */
    .progress-ring {
        width: 42px;
        height: 42px;
        transform: rotate(-90deg);
    }

    .progress-circle {
        stroke: #facc15;
        /* Yellow */
        stroke-width: 4;
        fill: transparent;
        transition: stroke-dashoffset 1s linear;
    }

    .page-content {
        padding-bottom: 80px;
    }
</style>

@section('scripts')
    <script src="{{ asset('js/backend/otp.js') }}"></script>
    </script>
@endsection
