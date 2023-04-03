// Ciblage des éléments HTML
// Boutons validate
const validateBtns = document.querySelectorAll('.validateBtn');
// Boutons delete
const deleteBtns = document.querySelectorAll('.deleteBtn');
// Elements modales
const modalDescriptionDelete = document.getElementById('modalDescriptionDelete');
const modalLinkDelete = document.getElementById('modalLinkDelete');
const modalDescriptionValidate = document.getElementById('modalDescriptionValidate');
const modalLinkValidate = document.getElementById('modalLinkValidate');

// Constantes
const options = { month: "long" }; //Option pour la récupération du mois dans le formattage de la date


deleteBtns.forEach(button => {
    button.addEventListener('click', ()=>{
        // Formattage de la date du rendez-vous
        let dateAppointment = new Date(button.dataset.date); //Créer un objet avec la date du rendez-vous
        let minutes = dateAppointment.getMinutes(); //MINUTES
        let hour = dateAppointment.getHours(); //HOUR
        let day = dateAppointment.getDate();
        day = day < 10 ? '0' + day : day; //Si jour inférieur à 10 on ajoute le 0 avant le chiffre
        let month = new Intl.DateTimeFormat("fr-FR", options).format(dateAppointment);//Get le mois
        let year = dateAppointment.getFullYear(); //Get l'année
        let appointment = `${day} ${month} ${year} ${hour}h${minutes}`; //Concaténer la date complète
        modalDescriptionDelete.innerHTML = button.dataset.lastname + ' - ' + button.dataset.firstname + ' (' + appointment + ')';
        let link = '/Dashboard/Appointments/Delete?id=' + button.dataset.id;
        modalLinkDelete.setAttribute('href', link);
    })
});

validateBtns.forEach(button => {
    button.addEventListener('click', ()=>{
        // Formattage de la date du rendez-vous
        let dateAppointment = new Date(button.dataset.appointment); //Créer un objet avec la date du rendez-vous
        let minutes = dateAppointment.getMinutes(); //MINUTES
        minutes = minutes < 10 ? '0'+minutes : minutes;
        let hour = dateAppointment.getHours(); //HOUR
        hour = hour < 10 ? '0'+hour : hour;
        let day = dateAppointment.getDate();
        day = day < 10 ? '0' + day : day; //Si jour inférieur à 10 on ajoute le 0 avant le chiffre
        console.log(dateAppointment);
        let month = new Intl.DateTimeFormat("fr-FR", options).format(dateAppointment);//Get le mois
        let year = dateAppointment.getFullYear(); //Get l'année
        let appointment = `${day} ${month} ${year} ${hour}h${minutes}`; //Concaténer la date complète
        modalDescriptionValidate.innerHTML = button.dataset.email + ' - ' + ' (' + appointment + ')';
        let link = '/Dashboard/Appointments/Validate?id=' + button.dataset.id;
        modalLinkValidate.setAttribute('href', link);
    })
});