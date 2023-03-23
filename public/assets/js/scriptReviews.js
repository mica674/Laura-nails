// Ciblage éléments HTML
const form = document.getElementById('reviewForm');
const stars = document.querySelectorAll('#reviewForm .fa-star');
const inputValStar = document.getElementById('starVal');
const errorMessage = document.getElementById('errorMessageStars');

// Déclarations de variables
var numberClick = 0;

// FONCTIONS
// Remise des étoiles vide au 'mouse leave'
function starToEmpty() {

    for (let num = numberClick; num < 5; num++) {
        stars[num].classList.add('fa-regular');
        stars[num].classList.remove('fa-solid');
    }
    for (let num = 0; num < numberClick; num++) {
        stars[num].classList.remove('fa-regular');
        stars[num].classList.add('fa-solid');
    }
}
// 
function starToFill(numberStar) {
    for (let i = numberStar; i < 5; i++) {
        stars[i].classList.add('fa-regular');
        stars[i].classList.remove('fa-solid');
    }
    for (let num = 0; num < numberStar; num++) {
        stars[num].classList.remove('fa-regular');
        stars[num].classList.add('fa-solid');
    }
}

stars.forEach(star => {
    star.addEventListener('mouseleave', () => {
        starToEmpty();
    })
    star.addEventListener('mouseover', () => {
        let numberStar = star.parentNode.id.substr(-1);
        starToFill(numberStar);
    })
    star.addEventListener('click', () => {
        numberClick = star.parentNode.id.substr(-1);
        starToEmpty();
    })
});

// Event form
form.addEventListener('submit', (e) => {
    e.preventDefault();
    if (numberClick == 0) {
        // Message d'erreur sur les étoiles
        // errorMessage.removeAttribute('hidden');
        errorMessage.innerHTML = 'Veuillez sélectioner au moins 1 étoile';
        
    } else {
        inputValStar.value = numberClick;
        form.submit();
    }
    console.log(inputValStar.value);
})