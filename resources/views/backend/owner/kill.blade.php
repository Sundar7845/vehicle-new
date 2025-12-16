@extends('backend.layout')
@section('title')
    Dashboard
@endsection
@section('content')
    <section class="bg-white p-4">

        <div class="flex items-center justify-between">
            <div class="font-medium flex justify-center gap-2 items-center">

                <svg class="fill-black stroke-black h-5" width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke="none"
                        d="M1.82468 0.00012207H6.93378C7.94191 0.00012207 8.75846 1.00826 8.75846 1.8248V6.9339C8.75846 7.94203 7.94191 8.75858 6.93378 8.75858H1.82468C0.816545 8.75858 0 7.75044 0 6.9339V1.8248C0 0.816667 0.816545 0.00012207 1.82468 0.00012207Z"
                        fill="inherit" />
                    <path
                        d="M12.7715 0.645508H17.8809C18.1645 0.645508 18.4598 0.790139 18.6992 1.04688C18.9441 1.30968 19.0594 1.61467 19.0596 1.82422V6.93359C19.0596 7.58508 18.5323 8.1123 17.8809 8.1123H12.7715C12.488 8.11215 12.1933 7.96845 11.9541 7.71191C11.7088 7.44886 11.5928 7.14322 11.5928 6.93359V1.82422C11.593 1.17309 12.1204 0.645756 12.7715 0.645508Z"
                        fill="#FED428FE" stroke="inherit" stroke-width="1.29152" />
                    <path stroke="none"
                        d="M1.82468 10.9468H6.93378C7.94191 10.9468 8.75846 11.9549 8.75846 12.7715V17.8806C8.75846 18.8887 7.94191 19.7052 6.93378 19.7052H1.82468C0.816545 19.7052 0 18.6971 0 17.8806V12.7715C0 11.7633 0.816545 10.9468 1.82468 10.9468Z"
                        fill="inherit" />
                    <path stroke="none"
                        d="M12.7719 10.9468H17.881C18.8892 10.9468 19.7057 11.9549 19.7057 12.7715V17.8806C19.7057 18.8887 18.8892 19.7052 17.881 19.7052H12.7719C11.7638 19.7052 10.9473 18.6971 10.9473 17.8806V12.7715C10.9473 11.7633 11.7638 10.9468 12.7719 10.9468Z"
                        fill="inherit" />
                </svg>


                <span>
                    Dashboard
                </span>
            </div>
        </div>
    </section>

    <section class="px-4 py-6">

        <div class="mb-2">
            <div class="font-medium flex items-center gap-1 text-sm">
                <img src="{{ asset('images/user.svg') }}" alt="user" class="h-6">
                <span>
                    Hi {{ Auth::user()->name }} 👋
                </span>
            </div>
        </div>

        {{-- <div class="mt-10">
            <div class="font-semibold mb-2 text-2xl text-center">Kill Switch</div>
            <div>
                <label class="flex items-center justify-center gap-3 cursor-pointer">

                    <!-- Checkbox (peer) -->
                    <input type="checkbox" id="killSwitch" class="peer hidden" onchange="updateKillSwitch(this)"
                        {{ $settings->kill == 1 ? 'checked' : '' }}>

                    <!-- YES (when checked) -->
                    <div class="hidden peer-checked:block">
                        <img src="{{ asset('images/on.png') }}" alt="On" class="h-74">
                    </div>

                    <!-- NO (when unchecked) -->
                    <div class="block peer-checked:hidden">
                        <img src="{{ asset('images/off.png') }}" class="h-74" alt="Off">
                    </div>

                </label>


            </div>
        </div> --}}

    </section>
@endsection
@section('scripts')
    <script>
        function updateKillSwitch(checkbox) {
            let killValue = checkbox.checked ? 1 : 0;

            Swal.fire({
                title: killValue === 1 ? "Activate Kill Switch?" : "Deactivate Kill Switch?",
                text: killValue === 1 ?
                    "All operations will be disabled. Do you want to continue?" :
                    "System operations will resume. Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Continue",
                cancelButtonText: "Cancel",
            }).then((result) => {

                if (result.isConfirmed) {

                    Swal.fire({
                        title: 'Updating...',
                        text: 'Please wait',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading(),
                    });

                    $.ajax({
                        url: "{{ route('owner.kill.update') }}",
                        type: "POST",
                        data: {
                            kill: killValue,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.close();
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success 🎉',
                                    text: killValue == 1 ? 'Kill Switch Activated' :
                                        'Kill Switch Deactivated',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                            }
                        },
                        error: function() {
                            Swal.close();
                            Swal.fire({
                                icon: 'error',
                                title: 'Error ❌',
                                text: 'Something went wrong!'
                            });
                            checkbox.checked = !checkbox.checked; // revert switch if fails
                        }
                    });

                } else {
                    // Revert switch if user cancels
                    checkbox.checked = !checkbox.checked;
                }

            });
        }
    </script>
@endsection
