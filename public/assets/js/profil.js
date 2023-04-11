// Ciblage des éléments HTML
let lastnameInput = lastname.value;
let firstnameInput = firstname.value;
let emailInput = email.value;
let phoneInput = phone.value;
let birthdateInput = birthdate.value;
const profilInputs = document.querySelectorAll('.inputJS');

console.log(profilInputs);
// Fonctions
// Comparer les valeurs des inputs avant et après les modifications
function inputsValuesStillSame(profil) {
    if (profil.getAttribute("id") == 'lastname' && lastnameInput != profil.value
        || profil.getAttribute("id") == 'firstname' && firstnameInput != profil.value
        || profil.getAttribute("id") == 'email' && emailInput != profil.value
        || profil.getAttribute("id") == 'phone' && phoneInput != profil.value
        || profil.getAttribute("id") == 'birthdate' && birthdateInput != profil.value
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
                profilBtn.classList.remove('d-none');
                input.classList.add('bg-success');
            } else {
                profilBtn.classList.add('d-none');
            }
        })
    }
}

profilInputs.forEach(input => {
    eventListener(input)
});