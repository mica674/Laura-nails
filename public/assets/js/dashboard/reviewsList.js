// Delete MODALE
// Ciblage des éléments HTML
// Boutons validate
const validateBtns = document.querySelectorAll('.validateBtn');
// Boutons delete
const deleteBtns = document.querySelectorAll('.deleteBtn');

// Event au click pour passé les infos de dataset vers la modale
deleteBtns.forEach(button => {
    button.addEventListener('click', ()=>{
        // Créer le message à insérer dans la description de la modale
        modalDescription.innerHTML = button.dataset.title + ' : ' + button.dataset.description;
        let link = '/Dashboard/Reviews/Delete?id=' + button.dataset.id;
        modalLink.setAttribute('href', link);
    })
});

validateBtns.forEach(button => {
    button.addEventListener('click', ()=>{
        // Créer le message à insérer dans la description de la modale
        modalDescriptionValidate.innerHTML = button.dataset.title + ' -- ' + ' (' + button.dataset.content + ')';
        let link = '/Dashboard/Reviews/Validate?validate=1&id=' + button.dataset.id;
        modalLinkValidate.setAttribute('href', link);
    })
});