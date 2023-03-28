// Ciblage des éléments HTML
// Boutons delete
const deleteBtns = document.querySelectorAll('.deleteBtn');
// Elements de la modale
const modalDescription = document.getElementById('modalDescription');
const modalLink = document.getElementById('modalLink');

deleteBtns.forEach(button => {
    button.addEventListener('click', ()=>{
        modalDescription.innerHTML = button.dataset.start + ' - ' + button.dataset.end + ' (' + button.dataset.step + ')';
        let link = '/Dashboard/Appointments/Slots/Delete?id=' + button.dataset.id;
        modalLink.setAttribute('href', link);
    })
});