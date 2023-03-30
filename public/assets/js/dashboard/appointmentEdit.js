// Ciblage des éléments HTML
let clientInput = client.value;
let dayInput = day.value;
let hourInput = hour.value;
let minutesInput = minutes.value;
const appointmentInputs = document.querySelectorAll('.inputJS');

// Fonctions
// Comparer les valeurs des inputs avant et après les modifications
function inputsValuesStillSame(appointment) {
    if (appointment.getAttribute("id") == 'client' && clientInput != appointment.value
        || appointment.getAttribute("id") == 'day' && dayInput != appointment.value
        || appointment.getAttribute("id") == 'hour' && hourInput != appointment.value
        || appointment.getAttribute("id") == 'minutes' && minutesInput != appointment.value
    ) {
        same = false;
    } else { same = true; }
    return same;
}

function eventListener(input) {
    if (input.type != 'submit') {

        input.addEventListener("focus", () => {
            input.removeAttribute("readonly");
            input.classList.add("bg-warning");
            input.classList.remove("bg-success");
        })
        input.addEventListener("blur", () => {
            input.setAttribute("readonly", '');
            input.classList.remove("bg-warning");
            if (!inputsValuesStillSame(input)) {
                input.classList.add('bg-success');
            }
        })
        input.addEventListener('change', () => {
            if (!inputsValuesStillSame(input)) {
                appointmentEditBtn.classList.remove('d-none');
                input.classList.add('bg-success');
            } else {
                appointmentEditBtn.classList.add('d-none');
            }
        })
    }
}


appointmentInputs.forEach(input => {
    eventListener(input)
});
