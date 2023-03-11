const stars = document.querySelectorAll('.fa-star');
var numberClick = 0;
console.log(stars[0].parentNode.id.substr(-1));

function starRegularized() {
    for (let num = numberClick; num < 5; num++) {
        stars[num].classList.add('fa-regular');
        stars[num].classList.remove('fa-solid');
    }
    for (let num = 0; num < numberClick; num++) {
        stars[num].classList.remove('fa-regular');
        stars[num].classList.add('fa-solid');
    }
    console.log(numberClick);
}

function starOver(numberStar) {
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
        starRegularized();
    })
    star.addEventListener('mouseover', () => {
        let numberStar = star.parentNode.id.substr(-1);
        starOver(numberStar);    
    })
    star.addEventListener('click', () => {
        numberClick = star.parentNode.id.substr(-1);
        starRegularized();
    })
});