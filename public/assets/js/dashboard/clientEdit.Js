// Ciblage des éléments HTML
let clientInput = document.querySelectorAll("input");
let modifyBtn = document.getElementById('clientEditBtn');
let clientInputLastname = clientInput[0].value;
let clientInputFirstname = clientInput[1].value;
let clientInputEmail = clientInput[2].value;
let clientInputPhone = clientInput[3].value;
let clientInputBirthdate = clientInput[4].value;

// Boutons delete
let deleteBtns = document.querySelectorAll('.deleteBtn');
// Boutons validate
let validateBtns = document.querySelectorAll('.validateBtn');


// Fonctions
// Comparer les valeurs des inputs avant et après les modifications
function inputsValuesStillSame(client) {
    if (client.getAttribute("id") == 'lastname' && clientInputLastname != client.value
        || client.getAttribute("id") == 'firstname' && clientInputFirstname != client.value
        || client.getAttribute("id") == 'email' && clientInputEmail != client.value
        || client.getAttribute("id") == 'phone' && clientInputPhone != client.value
        || client.getAttribute("id") == 'birthdate' && clientInputBirthdate != client.value
    ) {
        same = false;
    } else { same = true; }
    return same;
}

clientInput.forEach(input => {
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


// DELETE
deleteBtns.forEach(deleteBtn => {
    deleteBtn.addEventListener('click', () => {
        modalDescriptionDelete.innerHTML = deleteBtn.dataset.content + ' (note = ' + deleteBtn.dataset.quotations + ')';
        let link = '/Dashboard/Reviews/Delete?id=' + deleteBtn.dataset.id + '&idClient=' + deleteBtn.dataset.idclient;
        modalLinkDelete.setAttribute('href', link);
    })
});

// VALIDATE
validateBtns.forEach(validateBtn => {
    validateBtn.addEventListener('click', () => {
        console.log(validateBtn.dataset.validate);
        modalDescriptionValidate.innerHTML = validateBtn.dataset.content + ' (note = ' + validateBtn.dataset.quotations + ')';
        if (validateBtn.dataset.validate == 1 && validateBtn.dataset.delete == 0) {
            modalLinkValidate.classList.add('d-none');
            modalLinkValidate.setAttribute('href', '');
        } else {
            modalLinkValidate.classList.remove('d-none');
            let linkValidate = '/Dashboard/Reviews/Validate?validate=1&id=' + validateBtn.dataset.id + '&idClient=' + validateBtn.dataset.idclient;
            modalLinkValidate.setAttribute('href', linkValidate);
        }
        if (validateBtn.dataset.delete == 1) {
            modalLinkNoValidate.classList.add('d-none');
            modalLinkNoValidate.setAttribute('href', '');
        } else {
            modalLinkNoValidate.classList.remove('d-none');
            let linkNoValidate = '/Dashboard/Reviews/Validate?validate=0&id=' + validateBtn.dataset.id + '&idClient=' + validateBtn.dataset.idclient;
            modalLinkNoValidate.setAttribute('href', linkNoValidate);
        }
    })
})
