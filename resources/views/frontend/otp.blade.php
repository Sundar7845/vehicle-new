<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>

<body>

    <main class="max-w-md mx-auto min-h-screen bg-[#FEDF51] relative">


        <div class="flex flex-col justify-center gap-2 items-center h-full px-8 py-10">
            <div>
                <img src="{{ asset('images/logo.svg') }}" alt="logo" class="max-h-24 w-auto">
            </div>
            <div>
                <img src="{{ asset('images/truck.png') }}" alt="Truck">
            </div>


            <div class="w-full grid grid-cols-1 gap-6">
                <div class="text-center font-bold text-xl">Enter OTP</div>

                <div class="text-center">The OTP was sent to your admin</div>

                <form id="otpForm" action="{{ route('frontend.otpverify') }}" method="POST">
                    @csrf
                    <input type="hidden" name="phone" value="{{ request('phone') }}">
                    <input type="hidden" name="otp" id="otp">
                    <div class="flex justify-center gap-3">
                        <input type="text" maxlength="1"
                            class="otp-input w-12 h-12 text-center border border-black rounded-lg text-xl font-semibold focus:outline-none" />
                        <input type="text" maxlength="1"
                            class="otp-input w-12 h-12 text-center border border-black rounded-lg text-xl font-semibold focus:outline-none" />
                        <input type="text" maxlength="1"
                            class="otp-input w-12 h-12 text-center border border-black rounded-lg text-xl font-semibold focus:outline-none" />
                        <input type="text" maxlength="1"
                            class="otp-input w-12 h-12 text-center border border-black rounded-lg text-xl font-semibold focus:outline-none" />
                    </div>

                    <div class="mt-10">
                        <button class="bg-black cursor-pointer text-white w-full h-10 rounded-sm">Continue</button>
                    </div>
                </form>
                @if ($errors->any())
                    <div class="text-red-500 font-medium">{{ $errors->first() }}</div>
                @endif
            </div>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const inputs = document.querySelectorAll(".otp-input");
            const hiddenOtp = document.getElementById("otp");

            function updateOtp() {
                hiddenOtp.value = Array.from(inputs).map(i => i.value).join('');
            }

            inputs.forEach((input, index) => {
                input.addEventListener("input", function() {
                    this.value = this.value.replace(/\D/g, ""); // allow only digits
                    updateOtp();
                    if (this.value && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                });

                input.addEventListener("keyup", updateOtp); // update on keyup too

                input.addEventListener("keydown", function(e) {
                    if (e.key === "Backspace" || e.key === "Delete") {
                        if (!this.value && index > 0) inputs[index - 1].focus();
                        this.value = "";
                        updateOtp();
                    }
                    if (this.value && e.key >= "0" && e.key <= "9") e.preventDefault();
                });

                input.addEventListener("paste", function(e) {
                    e.preventDefault();
                    let data = e.clipboardData.getData("text").replace(/\D/g, "").split("");
                    data.forEach((digit, i) => {
                        if (index + i < inputs.length) inputs[index + i].value = digit;
                    });
                    updateOtp();
                    let last = index + data.length;
                    if (last < inputs.length) inputs[last].focus();
                });
            });
        });
    </script>

</body>

</html>
