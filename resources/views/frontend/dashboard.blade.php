@extends('frontend.layout')
@section('content')
<main class="max-w-md mx-auto min-h-screen bg-[#F5F5F5] relative shadow">
    <section class="bg-white p-4">

        <div class="flex items-center justify-between">
            <div class="font-medium flex justify-center items-center gap-1">
                <img src="{{ asset('images/user.svg') }}" alt="user" class="h-8">
                <span>
                    Hi {{ Auth::user()->name }} 👋
                </span>
            </div>
            <div>
                <a href="{{ route('frontend.logout') }}"
                    class="bg-[#FED428] cursor-pointer text-black px-4 py-1 rounded-full text-sm font-medium flex justify-center items-center gap-1">
                    <svg class="h-4" width="18" height="18" viewBox="0 0 18 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.22517 3H7.68764V1.5H1.53753V16.5H7.68764V15H9.22517V16.5C9.22517 17.3284 8.53679 18 7.68764 18H1.53753C0.688372 18 0 17.3284 0 16.5V1.5C0 0.671573 0.688372 0 1.53753 0H7.68764C8.53679 0 9.22517 0.671573 9.22517 1.5V3ZM15.0568 8.25L11.7566 5.03033L12.8438 3.96967L18 9L12.8438 14.0303L11.7566 12.9697L15.0568 9.75H6.15011V8.25H15.0568Z"
                            fill="black" />
                    </svg>
                    Logout
                </a>
            </div>
        </div>
    </section>

    <section class="flex flex-col gap-4 px-4 mt-10">
        <a href="{{ route('frontend.vehicle') }}"
            class="bg-[#35C74D] cursor-pointer text-white px-4 py-1 rounded-sm h-24 text-base font-semibold flex justify-center items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                <path fill-rule="evenodd"
                    d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                    clip-rule="evenodd" />
            </svg>

            Inward Vehicle
        </a>
        <div>
            <!-- Button -->
            <div id="btnWrapper">
                <button id="showSearchBtn"
                    class="bg-[#ED2401] cursor-pointer w-full text-white px-4 py-1 rounded-sm h-24 text-base font-semibold flex justify-center items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                            clip-rule="evenodd" />
                    </svg>
                    Outward Vehicle
                </button>
            </div>

            <!-- Search Input (hidden initially) -->
            <div id="searchWrapper" class="hidden">
                <input id="customSearch" type="search" placeholder="Search Vehicle Number"
                    class="w-full outline-none placeholder:text-gray-200 text-center font-semibold h-20 placeholder:text-center text-base rounded-sm px-3 py-1 bg-[#ED2401] text-white" />
            </div>
        </div>

    </section>

    <section class="px-4 mt-10 bg-white py-6">
        <div>

            <!-- Header + Search -->
            <div class="flex flex-wrap justify-between items-center gap-2 mb-3">
                <h2 class="text-base font-semibold">Vehicle List</h2>
            </div>

            <!-- Table Container -->
            <div class="overflow-x-auto">
                <table class="w-full text-[11px] text-left whitespace-nowrap" id="vehicleTable">

                    <!-- Table Head -->
                    <thead class="bg-black text-white">
                        <tr>
                            <th class="text-center py-2 px-1 border-r border-[#E2E2E2]">S. No</th>
                            <th class="text-center py-2 px-1 border-r border-[#E2E2E2]">V. No</th>
                            <th class="text-center py-2 px-1 border-r border-[#E2E2E2]">V. Type</th>
                            <th class="text-center py-2 px-1 border-r border-[#E2E2E2]">In Time</th>
                            <th class="text-center py-2 px-1">Action</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
@endsection
@section('scripts')
<script src="{{ asset('js/frontend/dashboard.js') }}"></script>

<!-- 
<script>
    const btnWrapper = document.getElementById("btnWrapper");
    const searchWrapper = document.getElementById("searchWrapper");
    const showSearchBtn = document.getElementById("showSearchBtn");
    const searchInput = document.getElementById("customSearch");

    showSearchBtn.addEventListener("click", () => {
        btnWrapper.classList.add("hidden");
        searchWrapper.classList.remove("hidden");
        searchInput.focus();
    });

    $(document).ready(function () {
        let table = $('#vehicleTable').DataTable();

        // CUSTOM SEARCH INPUT
        searchInput.addEventListener("input", function () {
            let value = this.value.trim();
            table.search(value).draw();

            if (value === "") {
                resetSearchState();
            }
        });

        // DATATABLE SEARCH BOX SYNC
        $('#vehicleTable').on('search.dt', function () {
            let dtValue = table.search().trim();

            // If DataTable search cleared → reset UI also
            if (dtValue === "") {
                resetSearchState();
            }
        });

        function resetSearchState() {
            searchWrapper.classList.add("hidden");
            btnWrapper.classList.remove("hidden");
            searchInput.value = "";
            table.search("").draw();
        }
    });
</script> -->



@endsection