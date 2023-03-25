// Ciblage des éléments HTML
let prestationInput = document.querySelectorAll("input");
let modifyBtn = document.getElementById('prestaEditBtn');
let prestationInputName = prestationInput[0].value;
let prestationInputDescriptionMain = prestationInput[1].value;
let prestationInputDescriptionOptional = prestationInput[2].value;
let prestationInputDuration = prestationInput[3].value;
let prestationInputPrice = prestationInput[4].value;

// Fonctions
// Comparer les valeurs des inputs avant et après les modifications
function inputsValuesStillSame(prestation) {
    if (prestation.getAttribute("id") == 'name' && prestationInputName != prestation.value
        || prestation.getAttribute("id") == 'descriptionMain' && prestationInputDescriptionMain != prestation.value
        || prestation.getAttribute("id") == 'descriptionOptional' && prestationInputDescriptionOptional != prestation.value
        || prestation.getAttribute("id") == 'duration' && prestationInputDuration != prestation.value
        || prestation.getAttribute("id") == 'price' && prestationInputPrice != prestation.value
    ) {
        same = false;
    } else { same = true; }
    return same;
}

prestationInput.forEach(input => {
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
            } else {
                modifyBtn.classList.add('d-none');
            }
        })
    }
});


