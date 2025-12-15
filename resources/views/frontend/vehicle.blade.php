@extends('frontend.layout')
@section('content')
    <main class="max-w-md mx-auto min-h-screen bg-[#F5F5F5] relative shadow">

        <section class="bg-white p-4">

            <div class="flex items-center justify-between">
                <div class="font-medium flex items-center gap-1">
                    <a href="{{ route('frontend.dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
                            <path fill-rule="evenodd"
                                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-4.28 9.22a.75.75 0 0 0 0 1.06l3 3a.75.75 0 1 0 1.06-1.06l-1.72-1.72h5.69a.75.75 0 0 0 0-1.5h-5.69l1.72-1.72a.75.75 0 0 0-1.06-1.06l-3 3Z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <span class="text-lg">
                        Vehicle Details
                    </span>
                </div>

            </div>
        </section>

        <section class="px-4 mt-10">
            <!-- Vehicle Number -->
            <form action="{{ route('frontend.vehiclestore') }}" method="post">
                @csrf
                <!-- Add this hidden input inside your form/section -->
                <input type="hidden" id="fullVehicleNumber" name="vehicle_number" />
                <div>
                    <label class="block font-medium mb-2 text-black">Vehicle Number</label>

                    <div class="grid grid-cols-10 gap-1">
                        @for ($i = 0; $i < 10; $i++)
                            <input maxlength="1"
                                class="veh-input h-10 text-center border border-[#777777] rounded-lg text-lg font-semibold focus:outline-none"
                                placeholder="-" />
                        @endfor
                    </div>
                </div>


                <!-- Party Name -->
                <div class="mt-6">
                    <label class="block font-medium mb-2 text-black">Party Name</label>
                    <select class="w-full border border-[#777777] rounded-lg px-4 py-2 text-sm focus:outline-none"
                        id="party_name" name="party_name">
                        <option value="">--- Select ---</option>
                        @foreach ($parties as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Vehicle Type -->
                <div class="mt-6">
                    <label class="block font-medium mb-2 text-black">Vehicle Type</label>
                    <select class="w-full border border-[#777777] rounded-lg px-4 py-2 text-sm focus:outline-none"
                        id="vehicleType" name="vehicle_type">
                        <option value="">--- Select ---</option>
                        @foreach ($vehicletypes as $item)
                            <option value="{{ $item->id }}">{{ $item->vechicle_type }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Units -->
                <div class="mt-6">
                    <label class="block font-medium mb-2 text-black">No. of Units</label>
                    <select class="w-full border border-[#777777] rounded-lg px-4 py-2 text-sm focus:outline-none"
                        id="vehicleUnit" name="unit_id">
                        <option value="">--- Select ---</option>
                        @foreach ($units as $item)
                            <option value="{{ $item->id }}">{{ $item->unit_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-10">
                    <button class="w-full bg-[#FED428] text-black py-3 font-semibold rounded-lg">
                        Vehicle Inward
                    </button>
                </div>
            </form>
            @if ($errors->any())
                <div class="text-red-500 font-medium">{{ $errors->first() }}</div>
            @endif
        </section>

    </main>
@endsection
<script src="{{ asset('js/frontend/vehicle.js') }}"></script>
