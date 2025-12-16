@extends('backend.layout')
@section('title')
    Taluk
@endsection
@section('content')
    <section class="bg-white p-4">
        <div class="flex items-center justify-between">
            <div class="font-medium flex justify-center items-center">

                <svg class="h-5" width="27" height="31" viewBox="0 0 27 31" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.954834" y="0.873047" width="25.0837" height="29.0443" rx="3" fill="#FED428" />
                    <path
                        d="M0 25.1081C0 28.0054 2.35916 30.3645 5.2564 30.3645H21.7436C24.6408 30.3645 27 28.0054 27 25.1081L26.9983 5.2564C26.9983 2.35916 24.6392 0 21.7419 0H5.25644C2.3592 0 4.02312e-05 2.35916 4.02312e-05 5.2564V25.1133L0 25.1081ZM25.2764 5.2564V25.1133C25.2764 27.0638 23.6924 28.6478 21.7419 28.6478H9.55936L9.56104 1.71708H21.7436C23.6941 1.71708 25.2781 3.30106 25.2781 5.25158L25.2764 5.2564ZM1.72186 5.2564C1.72186 3.30588 3.30584 1.7219 5.25635 1.7219H7.83914V28.6479H5.25635C3.30584 28.6479 1.72186 27.0639 1.72186 25.1134V5.2564Z"
                        fill="black" />
                    <path
                        d="M13.8656 6.58953H20.7917C21.2659 6.58953 21.6527 6.20279 21.6527 5.7286C21.6527 5.2544 21.2659 4.86768 20.7917 4.86768H13.8656C13.3914 4.86768 13.0046 5.25442 13.0046 5.7286C13.0046 6.2028 13.3914 6.58953 13.8656 6.58953Z"
                        fill="black" />
                    <path
                        d="M13.8656 10.1795H20.7917C21.2659 10.1795 21.6527 9.79275 21.6527 9.31857C21.6527 8.84437 21.2659 8.45764 20.7917 8.45764H13.8656C13.3914 8.45764 13.0046 8.84439 13.0046 9.31857C13.0046 9.79277 13.3914 10.1795 13.8656 10.1795Z"
                        fill="black" />
                    <path
                        d="M17.3261 12.0479H13.8656C13.3914 12.0479 13.0046 12.4346 13.0046 12.9088C13.0046 13.383 13.3914 13.7697 13.8656 13.7697H17.3261C17.8003 13.7697 18.187 13.383 18.187 12.9088C18.187 12.4346 17.8003 12.0479 17.3261 12.0479Z"
                        fill="black" />
                </svg>

                <span>
                    Taluks
                </span>
            </div>
        </div>
    </section>

    <section class="px-4 py-6 mb-24">
        <div
            class="bg-white p-4 rounded-sm text-sm divide-y divide-[#DCDCDC] grid grid-cols-1 gap-4 font-medium text-[#2D2D2D]">
            @foreach ($taluk as $item)
                <a href="{{ route('backend.site', $item->id) }}" class="grid grid-cols-[1fr_12px] gap-2 not-last:pb-4">
                    <div>
                        {{ $item->name }}
                    </div>
                    <div class="flex items-center">
                        <svg class="h-3" width="10" height="17" viewBox="0 0 10 17" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.16675 15.1666L8.16675 8.16663L1.16675 1.16663" stroke="black" stroke-width="2.33333"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endsection
