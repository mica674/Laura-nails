// Ciblage des éléments HTML
// Boutons delete
const deleteBtns = document.querySelectorAll('.deleteBtn');
// Elements de la modale
const modalDescription = document.getElementById('modalDescription');
const modalLink = document.getElementById('modalLink');

// Constantes
const options = { month: "long" }; //Option pour la récupération du mois dans le formattage de la date


deleteBtns.forEach(button => {
    button.addEventListener('click', ()=>{
        // Formattage de la date du rendez-vous
        let dateAppointment = new Date(button.dataset.date); //Créer un objet avec la date du rendez-vous
        let day = dateAppointment.getDate();
        day = day < 10 ? '0' + day : day; //Si jour inférieur à 10 on ajoute le 0 avant le chiffre
        let month = new Intl.DateTimeFormat("fr-FR", options).format(dateAppointment);//Get le mois
        let year = dateAppointment.getFullYear(); //Get l'année
        let appointment = `${day} ${month} ${year}`; //Concaténer la date complète
        modalDescription.innerHTML = button.dataset.lastname + ' - ' + button.dataset.firstname + ' (' + appointment + ')';
        let link = '/Dashboard/Appointments/Delete?id=' + button.dataset.id;
        modalLink.setAttribute('href', link);
    })
});