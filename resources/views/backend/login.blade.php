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
                <form action="{{ route('backend.loginstore') }}" method="post">
                    <div class="mb-4">
                        <label for="Email">
                            <span class="text-sm font-medium text-black"> Enter Phone Number </span>
                            @csrf
                            <div class="relative">

                                <span class="absolute inset-y-0 left-0 grid w-8 place-content-center text-gray-700">

                                    <svg width="30" height="30" class="size-6" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22.1339 17.1339L25.444 20.444C25.8892 20.8892 25.8892 21.6108 25.444 22.056C23.0375 24.4625 19.2277 24.7332 16.505 22.6912L14.5357 21.2143C12.3563 19.5797 10.4203 17.6437 8.78571 15.4643L7.30876 13.495C5.26676 10.7723 5.53752 6.96248 7.94404 4.55596C8.38916 4.11084 9.11084 4.11084 9.55596 4.55596L12.8661 7.86612C13.3543 8.35427 13.3543 9.14573 12.8661 9.63388L11.5897 10.9103C11.3868 11.1132 11.3365 11.4231 11.4648 11.6797C12.9482 14.6463 15.3537 17.0518 18.3203 18.5352C18.5769 18.6635 18.8868 18.6132 19.0897 18.4103L20.3661 17.1339C20.8543 16.6457 21.6457 16.6457 22.1339 17.1339Z" stroke="black" stroke-width="1.25" />
                                    </svg>



                                </span>
                                <input type="text" id="phone" name="phone"
                                    class="mt-0.5 min-w-full rounded border border-black text-black ps-8 h-10 shadow-sm sm:text-sm">
                            </div>
                        </label>
                    </div>
                    <div class="mb-8">
                        <label for="Paswword">
                            <span class="text-sm font-medium text-black"> Enter Your Password </span>
                            <div class="relative">

                                <span class="absolute inset-y-0 left-0 grid w-8 place-content-center text-gray-700">
                                    <svg width="16" height="20" class="size-5" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.5301 7.50277H12.918V5.10544C12.918 2.24195 10.8852 0 7.97814 0C5.07104 0 3.08197 2.28635 3.08197 5.10544V7.48058C3.08197 7.50277 3.08197 7.50277 3.08197 7.48058H2.46995C1.11475 7.48058 0.0218579 8.59046 0 9.9889V17.4917C0 18.8679 1.0929 19.9778 2.46995 20H13.5301C14.8852 20 15.9781 18.8901 16 17.4917V9.9889C16 8.61265 14.8852 7.50277 13.5301 7.50277ZM4.30601 7.50277V5.10544C4.30601 2.97447 5.74863 1.24306 7.97814 1.24306C10.1858 1.24306 11.694 2.93008 11.694 5.10544V7.48058C11.694 7.50277 11.694 7.50277 11.694 7.48058H4.30601C4.30601 7.50277 4.30601 7.50277 4.30601 7.50277ZM14.7541 17.4917C14.7541 18.1798 14.2077 18.7347 13.5301 18.7347H2.46995C1.79235 18.7347 1.2459 18.1798 1.2459 17.4917V9.9889C1.2459 9.30078 1.79235 8.74584 2.46995 8.74584H13.5301C14.2077 8.74584 14.7541 9.30078 14.7541 9.9889V17.4917ZM9.22404 12.4972C9.22404 12.9634 8.98361 13.3629 8.61202 13.5849V15.6271C8.61202 15.9822 8.32787 16.2486 8 16.2486C7.65027 16.2486 7.38798 15.96 7.38798 15.6271V13.5849C7.01639 13.3629 6.77596 12.9634 6.77596 12.4972C6.77596 11.8091 7.3224 11.2542 8 11.2542C8.6776 11.232 9.22404 11.7869 9.22404 12.4972Z" fill="black" />
                                    </svg>


                                </span>
                                <input type="text" id="password" name="password"
                                    class="mt-0.5 min-w-full rounded border border-black text-black ps-8 h-10 shadow-sm sm:text-sm">
                            </div>
                        </label>
                    </div>

                    <div>
                        <button class="bg-black text-white cursor-pointer w-full h-10 rounded-sm">Sign In</button>
                    </div>
                </form>
                @if ($errors->any())
                <div class="text-red-500 font-medium">{{ $errors->first() }}</div>
                @endif
            </div>

        </div>
    </main>
</body>

</html>