// Ciblage des éléments HTML
let titleInput = title.value;
let messageInput = message.value;
let quotationsInput = quotations.value;
const reviewsInputs = document.querySelectorAll('.inputJS');

// Fonctions
// Comparer les valeurs des inputs avant et après les modifications
function inputsValuesStillSame(review) {
    if (review.getAttribute("id") == 'title' && titleInput != review.value
        || review.getAttribute("id") == 'message' && messageInput != review.value
        || review.getAttribute("id") == 'quotations' && quotationsInput != review.value
        || review.getAttribute("id") == 'minutes' && minutesInput != review.value
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
                commentEditBtn.classList.remove('d-none');
                input.classList.add('bg-success');
            } else {
                commentEditBtn.classList.add('d-none');
            }
        })
    }
}

reviewsInputs.forEach(input => {
    eventListener(input)
});