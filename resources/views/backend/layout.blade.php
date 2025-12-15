<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    {{-- DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>@yield('title')</title>

</head>

<body class="bg-[#F7F7F7]">
    <main class="max-w-md mx-auto min-h-screen bg-[#F5F5F5] relative shadow">
        @yield('content')
        <section>
            <div
                class="bg-black px-6 py-3 text-white text-sm grid grid-cols-3 place-items-center text-center fixed z-10 bottom-0 max-w-md w-full">
                <a href="{{ route('backend.dashboard') }}"
                    class="grid grid-cols-1 gap-1 place-items-center 
                {{ request()->routeIs('backend.dashboard') ? 'text-[#FED428]' : 'text-white' }}">
                    <svg class="h-5 
                    {{ request()->routeIs('backend.dashboard') ? 'fill-[#FED428] stroke-[#FED428]' : 'fill-white stroke-white' }}"
                        width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke="none"
                            d="M1.82468 0.00012207H6.93378C7.94191 0.00012207 8.75846 1.00826 8.75846 1.8248V6.9339C8.75846 7.94203 7.94191 8.75858 6.93378 8.75858H1.82468C0.816545 8.75858 0 7.75044 0 6.9339V1.8248C0 0.816667 0.816545 0.00012207 1.82468 0.00012207Z"
                            fill="inherit" />
                        <path
                            d="M12.7715 0.645508H17.8809C18.1645 0.645508 18.4598 0.790139 18.6992 1.04688C18.9441 1.30968 19.0594 1.61467 19.0596 1.82422V6.93359C19.0596 7.58508 18.5323 8.1123 17.8809 8.1123H12.7715C12.488 8.11215 12.1933 7.96845 11.9541 7.71191C11.7088 7.44886 11.5928 7.14322 11.5928 6.93359V1.82422C11.593 1.17309 12.1204 0.645756 12.7715 0.645508Z"
                            fill="none" stroke="inherit" stroke-width="1.29152" />
                        <path stroke="none"
                            d="M1.82468 10.9468H6.93378C7.94191 10.9468 8.75846 11.9549 8.75846 12.7715V17.8806C8.75846 18.8887 7.94191 19.7052 6.93378 19.7052H1.82468C0.816545 19.7052 0 18.6971 0 17.8806V12.7715C0 11.7633 0.816545 10.9468 1.82468 10.9468Z"
                            fill="inherit" />
                        <path stroke="none"
                            d="M12.7719 10.9468H17.881C18.8892 10.9468 19.7057 11.9549 19.7057 12.7715V17.8806C19.7057 18.8887 18.8892 19.7052 17.881 19.7052H12.7719C11.7638 19.7052 10.9473 18.6971 10.9473 17.8806V12.7715C10.9473 11.7633 11.7638 10.9468 12.7719 10.9468Z"
                            fill="inherit" />
                    </svg>

                    <span>Dashboard</span>

                </a>
                <a href="{{ route('backend.site') }}"
                    class="grid grid-cols-1 gap-1 place-items-center
                {{ request()->routeIs('backend.site*') ? 'text-[#FED428]' : 'text-white' }}">

                    <svg class="h-5 
                    {{ request()->routeIs('backend.site*') ? 'fill-[#FED428] stroke-[#FED428]' : 'fill-white stroke-white' }}"
                        width="20" height="20" width="21" height="23" viewBox="0 0 21 23" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0 19.0185C0 21.213 1.78698 23 3.98153 23H16.47C18.6645 23 20.4515 21.213 20.4515 19.0185L20.4502 3.98153C20.4502 1.78698 18.6633 0 16.4687 0H3.98156C1.78701 0 3.04737e-05 1.78698 3.04737e-05 3.98153V19.0224L0 19.0185ZM19.146 3.98153V19.0224C19.146 20.4998 17.9462 21.6996 16.4687 21.6996H7.24086L7.24214 1.30062H16.47C17.9474 1.30062 19.1472 2.50043 19.1472 3.97788L19.146 3.98153ZM1.30424 3.98153C1.30424 2.50408 2.50405 1.30428 3.9815 1.30428H5.93786V21.6997H3.9815C2.50405 21.6997 1.30424 20.4999 1.30424 19.0225V3.98153Z"
                            fill="inherit" />
                        <path
                            d="M10.5027 4.99144H15.749C16.1082 4.99144 16.4011 4.69849 16.4011 4.33932C16.4011 3.98013 16.1082 3.68719 15.749 3.68719H10.5027C10.1435 3.68719 9.85059 3.98014 9.85059 4.33932C9.85059 4.69851 10.1435 4.99144 10.5027 4.99144Z"
                            fill="inherit" />
                        <path
                            d="M10.5027 7.71068H15.749C16.1082 7.71068 16.4011 7.41773 16.4011 7.05855C16.4011 6.69937 16.1082 6.40643 15.749 6.40643H10.5027C10.1435 6.40643 9.85059 6.69938 9.85059 7.05855C9.85059 7.41774 10.1435 7.71068 10.5027 7.71068Z"
                            fill="inherit" />
                        <path
                            d="M13.1239 9.12579H10.5027C10.1435 9.12579 9.85059 9.41874 9.85059 9.77792C9.85059 10.1371 10.1435 10.43 10.5027 10.43H13.1239C13.4831 10.43 13.7761 10.1371 13.7761 9.77792C13.7761 9.41874 13.4831 9.12579 13.1239 9.12579Z"
                            fill="inherit" />
                    </svg>

                    <span>Sites</span>
                </a>
                <a href="{{ route('backend.logout') }}" class="grid grid-cols-1 gap-1 text-center place-items-center">

                    <svg class="fill-white h-5" width="20" height="20" width="21" height="20"
                        viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.7627 3.33333H8.96891V1.66667H1.79378V18.3333H8.96891V16.6667H10.7627V18.3333C10.7627 19.2538 9.95959 20 8.96891 20H1.79378C0.803101 20 0 19.2538 0 18.3333V1.66667C0 0.746192 0.803101 0 1.79378 0H8.96891C9.95959 0 10.7627 0.746192 10.7627 1.66667V3.33333ZM17.5663 9.16667L13.7161 5.58926L14.9845 4.41074L21 10L14.9845 15.5893L13.7161 14.4107L17.5663 10.8333H7.17513V9.16667H17.5663Z"
                            fill="inherit" />
                    </svg>

                    <span>Logout</span>
                </a>
            </div>
        </section>
    </main>
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- DataTables --}}
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @yield('scripts')
</body>

</html>
