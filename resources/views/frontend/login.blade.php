<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>

<body>

    <main class="max-w-md mx-auto min-h-screen bg-[#FEDF51] relative">
        <div class="flex flex-col justify-center gap-2 items-center h-full px-6 py-8">
            <div>
                <img src="{{ asset('images/logo.svg') }}" alt="logo" class="max-h-24 w-auto">
            </div>
            <div>
                <img src="{{ asset('images/truck.png') }}" alt="Truck">
            </div>
            
            <div class="w-full grid grid-cols-1 gap-6">
                <div class="text-center font-bold text-xl">Log In</div>
                <div class="">
                    <label for="Email">
                        <span class="text-sm font-medium text-black"> Enter Phone Number </span>
                        <form action="{{ route('frontend.loginstore') }}" method="post">
                            @csrf
                            <div class="relative">

                                <span class="absolute inset-y-0 left-0 grid w-8 place-content-center text-gray-700">
                                    <svg width="30" height="30" class="size-5" viewBox="0 0 30 30" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M22.1339 17.1339L25.444 20.444C25.8892 20.8892 25.8892 21.6108 25.444 22.056C23.0375 24.4625 19.2277 24.7332 16.505 22.6912L14.5357 21.2143C12.3563 19.5797 10.4203 17.6437 8.78571 15.4643L7.30876 13.495C5.26676 10.7723 5.53752 6.96248 7.94404 4.55596C8.38916 4.11084 9.11084 4.11084 9.55596 4.55596L12.8661 7.86612C13.3543 8.35427 13.3543 9.14573 12.8661 9.63388L11.5897 10.9103C11.3868 11.1132 11.3365 11.4231 11.4648 11.6797C12.9482 14.6463 15.3537 17.0518 18.3203 18.5352C18.5769 18.6635 18.8868 18.6132 19.0897 18.4103L20.3661 17.1339C20.8543 16.6457 21.6457 16.6457 22.1339 17.1339Z"
                                            stroke="black" stroke-width="1.25" />
                                    </svg>

                                </span>
                                <input type="text" id="phone" name="phone"
                                    class="mt-0.5 min-w-full rounded border border-black text-black ps-8 h-10 shadow-sm sm:text-sm">
                            </div>
                    </label>
                </div>
                <div>
                    <button class="bg-black text-white cursor-pointer w-full h-10 rounded-sm">Get OTP</button>
                </div>
                </form>
            </div>
            
        </div>
    </main>
</body>
</html>
