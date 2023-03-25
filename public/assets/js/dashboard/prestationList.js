// Ciblage des éléments HTML
// Boutons delete
const deleteBtns = document.querySelectorAll('.deleteBtn');
// Elements de la modale
const modalDescription = document.getElementById('modalDescription');
const modalLink = document.getElementById('modalLink');

deleteBtns.forEach(button => {
    button.addEventListener('click', ()=>{
        modalDescription.innerHTML = button.dataset.name + ' : ' + button.dataset.description;
        let link = '/Dashboard/Prestations/Delete?id=' + button.dataset.id;
        modalLink.setAttribute('href', link);
    })
});