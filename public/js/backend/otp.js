let countdownInterval;
let siteId = $("#siteId").val();

function startTimer() {
    const circle = document.querySelector(".progress-circle");
    let timeLeft = 60;
    const dashArray = 100;

    clearInterval(countdownInterval);

    countdownInterval = setInterval(() => {
        timeLeft--;
        circle.style.strokeDashoffset = dashArray * (1 - timeLeft / 60);

        if (timeLeft <= 0) {
            clearInterval(countdownInterval);
        }
    }, 1000);
}

function loadOtps(id) {
    fetch("/backend/admin/get-otps/" + id)
        .then((res) => res.json())
        .then((item) => {
            if (!item) return;

            const container = document.getElementById("otp-container");
            container.innerHTML = `
                            <div>
                                <h5 class="text-base font-semibold mb-3">OTP</h5>
                                <div class="relative">
                                    <input 
                                        readonly 
                                        value="${item.otp}" 
                                        class="w-full border border-[#DCDCDC] text-center bg-white text-xl font-bold py-2 h-14 rounded-lg outline-none"
                                    />
                                    <button onclick="refreshOtp(${item.id})"
                                        class="absolute flex justify-center items-center top-0 right-4 h-full">
                                        <svg class="progress-ring absolute size-10" viewBox="0 0 36 36">
                                            <circle class="progress-circle"
                                                stroke-dasharray="100"
                                                stroke-dashoffset="0"
                                                cx="18"
                                                cy="18"
                                                r="16"></circle>
                                        </svg>
                                        <span class="text-lg">🔄</span>
                                    </button>
                                </div>
                            </div>`;

            // Restart countdown animation
            startTimer();
        });
}

function refreshOtp(userId) {
    fetch("/backend/admin/refresh-otp/" + userId).then(() => loadOtps(siteId)); // always pass site ID, not user ID
}

// Auto refresh every 60 sec
setInterval(() => loadOtps(siteId), 60000);
loadOtps(siteId);

// On date change, reload the table with the selected date
$("#date").on("change", function () {
    stats();
});

// Optional: also reload when site changes if you have a #siteId dropdown
$("#siteName").on("change", function () {
    stats();
});

$(document).ready(function () {
    stats();
});

function stats() {
    let siteId = $("#siteId").val();
    let selectedDate = $("#date").val();
    let selectedParty = $("#siteName").val();

    $("#talukVehicleTable").DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        ajax: {
            url: "/backend/otp/" + siteId,
            type: "GET",
            data: {
                date: selectedDate,
                party: selectedParty,
            },
            error: function (xhr, status, error) {
                console.error("Error fetching data:", error);
            },
        },
        bdestory: true,
        columns: [
            { data: "vehicle_number" },
            { data: "created_at" },
            { data: "units" },
            { data: "in_time" },
            { data: "out_time" },
        ],
    });
}
const dateInput = document.getElementById("date");

    // Get today's date
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    const todayStr = `${yyyy}-${mm}-${dd}`;

    // Get yesterday's date
    const yesterday = new Date(today);
    yesterday.setDate(yesterday.getDate() - 1);
    const yyyyY = yesterday.getFullYear();
    const mmY = String(yesterday.getMonth() + 1).padStart(2, '0');
    const ddY = String(yesterday.getDate()).padStart(2, '0');
    const yesterdayStr = `${yyyyY}-${mmY}-${ddY}`;

    // Set min/max
    dateInput.min = yesterdayStr;
    dateInput.max = todayStr;