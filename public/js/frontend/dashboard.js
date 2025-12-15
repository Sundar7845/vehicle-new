$(document).ready(function () {
    const table = $("#vehicleTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/frontend/dashboard",
        columns: [
            { data: "id", orderable: false },
            { data: "vehicle_number", orderable: false },
            { data: "vechicle_type", orderable: false }, // fixed typo
            { data: "in_time", orderable: false },
            { data: "action", orderable: false },
        ],
        destroy: true, // only needed if re-initializing
    });

    const btnWrapper = document.getElementById("btnWrapper");
    const searchWrapper = document.getElementById("searchWrapper");
    const showSearchBtn = document.getElementById("showSearchBtn");
    const searchInput = document.getElementById("customSearch");

    // Show custom search input
    showSearchBtn.addEventListener("click", () => {
        btnWrapper.classList.add("hidden");
        searchWrapper.classList.remove("hidden");
        searchInput.focus();
    });

    // Flag to prevent recursion
    let isResetting = false;

    // Custom search input
    searchInput.addEventListener("input", function () {
        const value = this.value.trim();
        table.search(value).draw();

        if (value === "") resetSearchState();
    });

    // Sync DataTable search with UI
    table.on("search.dt", function () {
        if (isResetting) return; // skip when resetting
        const dtValue = table.search().trim();
        if (dtValue === "") resetSearchState();
    });

    function resetSearchState() {
        isResetting = true; // prevent recursion
        searchWrapper.classList.add("hidden");
        btnWrapper.classList.remove("hidden");
        searchInput.value = "";
        table.search("").draw();
        isResetting = false;
    }

});


function vehicleOut(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "This vehicle will be checked out.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, check out",
        cancelButtonText: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/frontend/vehicle/out/" + id,
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    Swal.fire({
                        icon: "success",
                        title: "Checked Out!",
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false,
                    });

                    const table = $("#vehicleTable").DataTable();

                    // Clear all search states
                    table.search("").draw();
                    $("#customSearch").val("");

                    // Reset UI
                    $("#searchWrapper").addClass("hidden");
                    $("#btnWrapper").removeClass("hidden");

                    // Reload table
                    table.ajax.reload(null, false);
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: xhr.responseJSON?.message || "Something went wrong",
                    });
                },
            });
        }
    });
}
