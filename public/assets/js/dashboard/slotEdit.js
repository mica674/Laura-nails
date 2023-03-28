// Ciblage des éléments HTML
const slotInput = document.querySelectorAll("input");
const modifyBtn = document.getElementById('slotEditBtn');
let slotInputStart = slotInput[0].value;
let slotInputEnd = slotInput[1].value;
let stotInputStep = slotStep.value;
// Fonctions
// Comparer les valeurs des inputs avant et après les modifications
function inputsValuesStillSame(slot) {
    if (slot.getAttribute("id") == 'slotStart' && slotInputStart != slot.value
        || slot.getAttribute("id") == 'slotEnd' && slotInputEnd != slot.value
        || slot.getAttribute("id") == 'slotStep' && slotInputStep != slot.value
    ) {
        same = false;
    } else { same = true; }
    return same;
}

slotInput.forEach(input => {
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
                modifyBtn.classList.remove('d-none');
                input.classList.add('bg-success');
            } else {
                modifyBtn.classList.add('d-none');
            }
        })
    }
});


console.log(1);