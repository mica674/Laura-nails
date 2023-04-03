//Ciblage éléments HTML
const checksInputs = document.querySelectorAll('.prestaCheck');
console.log(checksInputs);

checksInputs.forEach(checksInput => {
    checksInput.addEventListener('click', () => {
        let nbChecked = 0;
        checksInputs.forEach(input => {
            if (input.checked) {
                nbChecked ++;
            }
            if (nbChecked >3) {
                checksInput.checked = false;
                smallPresta.innerText ='Vous ne pouvez pas cocher plus de 3 prestations pour le même rendez-vous';
                smallPresta.classList.add('text-danger');
                setTimeout(() => {
                    smallPresta.innerText ='Veuillez sélectionnez 1 prestation minimum et 3 maximum';
                    smallPresta.classList.remove('text-danger');
                }, 2000);}
        });
    })
});