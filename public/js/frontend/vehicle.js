document.addEventListener("DOMContentLoaded", function () {
    const inputs = document.querySelectorAll(".veh-input");
    const hiddenInput = document.getElementById("fullVehicleNumber");
    const vehicleType = document.getElementById("vehicleType");
    const vehicleUnit = document.getElementById("vehicleUnit");
    const vehicleParty = document.getElementById("party_name");

    if (!hiddenInput || !inputs.length || !vehicleType || !vehicleUnit) return;

    // Update hidden input & fetch vehicle details if number exists
    function updateHiddenInput() {
        const fullNumber = Array.from(inputs)
            .map((i) => i.value)
            .join("");
        hiddenInput.value = fullNumber;

        if (
            fullNumber.length === 8 ||
            fullNumber.length === 9 ||
            fullNumber.length === 10
        ) {
            fetch(`/frontend/vehicle-details/${fullNumber}`)
                .then((res) => res.json())
                .then((data) => {
                    if (data.status === "success") {
                        vehicleType.value = data.vehicle_type_id;
                        vehicleUnit.value = data.unit_id;
                        vehicleParty.value = data.party_id;

                        // Disable interaction
                        vehicleType.style.pointerEvents = "none";
                        vehicleType.style.backgroundColor = "#f1f1f1";
                        vehicleUnit.style.pointerEvents = "none";
                        vehicleUnit.style.backgroundColor = "#f1f1f1";
                        vehicleParty.style.pointerEvents = "none";
                        vehicleParty.style.backgroundColor = "#f1f1f1";
                    } else {
                        vehicleType.value = "";
                        vehicleUnit.value = "";
                        vehicleParty.value = "";
                        vehicleType.style.pointerEvents = "auto";
                        vehicleType.style.backgroundColor = "";
                        vehicleUnit.style.pointerEvents = "auto";
                        vehicleUnit.style.backgroundColor = "";
                        vehicleParty.style.pointerEvents = "auto";
                        vehicleParty.style.backgroundColor = "";
                    }
                });
        }
    }

    // Handle vehicle number input
    inputs.forEach((input, index) => {
        input.addEventListener("input", function () {
            this.value = this.value.replace(/[^A-Za-z0-9]/g, "").toUpperCase();
            if (this.value && index < inputs.length - 1)
                inputs[index + 1].focus();
            updateHiddenInput();
        });

        input.addEventListener("keydown", function (e) {
            if (
                (e.key === "Backspace" || e.key === "Delete") &&
                this.value === "" &&
                index > 0
            ) {
                inputs[index - 1].focus();
            }
        });

        input.addEventListener("paste", function (e) {
            e.preventDefault();
            const data = e.clipboardData
                .getData("text")
                .toUpperCase()
                .replace(/[^A-Z0-9]/g, "");
            [...data].forEach((char, i) => {
                if (index + i < inputs.length) inputs[index + i].value = char;
            });
            const last = Math.min(index + data.length, inputs.length - 1);
            inputs[last].focus();
            updateHiddenInput();
        });
    });

    // Vehicle type change
    vehicleType.addEventListener("change", function () {
        const typeId = this.value;

        // First, try to auto-select a unit based on selected vehicle type
        fetch(`/frontend/vehicle-default-unit/${typeId}`)
            .then((res) => res.json())
            .then((data) => {
                if (data.status === "success") {
                    vehicleUnit.value = data.unit_id;
                } else {
                    vehicleUnit.value = "";
                }
            });
    });
});
