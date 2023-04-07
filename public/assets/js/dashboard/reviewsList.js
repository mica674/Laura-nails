// Delete MODALE
// Ciblage des éléments HTML
// Boutons delete
const deleteBtns = document.querySelectorAll('.deleteBtn');

// Event au click pour passé les infos de dataset vers la modale
deleteBtns.forEach(button => {
    button.addEventListener('click', ()=>{
        modalDescription.innerHTML = button.dataset.title + ' : ' + button.dataset.description;
        let link = '/Dashboard/Reviews/Delete?id=' + button.dataset.id;
        modalLink.setAttribute('href', link);
    })
});