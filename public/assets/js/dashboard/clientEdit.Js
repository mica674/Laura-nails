// Ciblage des éléments HTML
let clientnInput = document.querySelectorAll("input");
let modifyBtn = document.getElementById('clientEditBtn');
let clientnInputLastname = clientnInput[0].value;
let clientnInputFirstname = clientnInput[1].value;
let clientnInputEmail = clientnInput[2].value;
let clientnInputPhone = clientnInput[3].value;
let clientnInputBirthdate = clientnInput[4].value;

// Fonctions
// Comparer les valeurs des inputs avant et après les modifications
function inputsValuesStillSame(clientn) {
    if (clientn.getAttribute("id") == 'lastname' && clientnInputLastname != clientn.value
        || clientn.getAttribute("id") == 'firstname' && clientnInputFirstname != clientn.value
        || clientn.getAttribute("id") == 'email' && clientnInputEmail != clientn.value
        || clientn.getAttribute("id") == 'phone' && clientnInputPhone != clientn.value
        || clientn.getAttribute("id") == 'birthdate' && clientnInputBirthdate != clientn.value
    ) {
        same = false;
    } else { same = true; }
    return same;
}

clientnInput.forEach(input => {
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


