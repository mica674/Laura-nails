// Ciblage des éléments HTML
// Boutons delete
let deleteBtns = document.querySelectorAll('.deleteBtn');
// Boutons email
let emailBtns = document.querySelectorAll('.emailBtn');

// ---------- MODALS

function updateBtns() {
    // UPDATE BTNS
    deleteBtns = document.querySelectorAll('.deleteBtn');
    emailBtns = document.querySelectorAll('.emailBtn');
    // DELETE
    deleteBtns.forEach(deleteBtn => {
        deleteBtn.addEventListener('click', () => {
            modalDescriptionDelete.innerHTML = deleteBtn.dataset.lastname + ' ' + deleteBtn.dataset.firstname + ', ' + deleteBtn.dataset.email;
            let link = '/Dashboard/Clients/Delete?id=' + deleteBtn.dataset.id;
            modalLinkDelete.setAttribute('href', link);
        })
    });

    // VALIDATE
    emailBtns.forEach(emailBtn => {
        emailBtn.addEventListener('click', () => {
            modalDescriptionValidate.innerHTML = emailBtn.dataset.email + ' (' + emailBtn.dataset.lastname + ' ' + emailBtn.dataset.firstname + ')';
            let linkEmail = 'mailto:' + emailBtn.dataset.email;
            modalLinkEmail.setAttribute('href', linkEmail);
            if (emailBtn.dataset.validate == 0) {
                modalLinkValidate.classList.remove('d-none');
                let linkValidate = '/Dashboard/Clients/Validate?email=' + emailBtn.dataset.email;
                modalLinkValidate.setAttribute('href', linkValidate);
            } else {
                modalLinkValidate.classList.add('d-none');
            }
        })
    })
}


// ---------- AJAX

// console.log(clientsListResult);

// AJAX/FETCH
function liveSearch() {

    fetch('/../../../../controllers/dashboard/clients/ajax/clientsAjax.php?input=' + live_search.value + '&nbItems=' + itemsPerPage.value + '&numPage=' + numeroPage.value)
        .then(response => {
            return (response.json());
        })
        .then(data => {
            if (data == 'false') {
                nbResults.innerHTML = 'Pas de correspondance';
                clientsListResult.innerHTML = '';
                numeroPage.value = 1;
                numeroPageMax.value = 1;
            } else {
                nbResults.innerHTML = (data[1][0].nbResultsSearch <= 1) ? data[1][0].nbResultsSearch + ' client' : data[1][0].nbResultsSearch + ' clients';

                let nbLine = 1;
                const options = { month: "long" }; //Option pour la récupération du mois dans le formattage de la date

                clientsListResult.innerHTML = '';
                data[0].forEach(client => {if (client.deleted_at == null) {

                    // Formattage de la date du rendez-vous
                    if (client.birthdate != null) {
                        let dateBirthdate = new Date(client.birthdate); //Créer un objet avec la date du rendez-vous
                        let day = dateBirthdate.getDate();
                        day = day < 10 ? '0' + day : day; //Si jour inférieur à 10 on ajoute le 0 avant le chiffre
                        let month = new Intl.DateTimeFormat("fr-FR", options).format(dateBirthdate);//Get le mois
                        let year = dateBirthdate.getFullYear(); //Get l'année
                        var birthdate = `${day} ${month} ${year}`; //Concaténer la date complète
                    }

                    clientsListResult.innerHTML += `
                    <tr class="my-3 trClient(${nbLine} % 2) + 1">
                        <td><a href="/Dashboard/Clients/Edit?id=${client.id}"><i class="fa-regular fa-user"></i></a>${client.lastname}</td>
                        <td><a href="/Dashboard/Clients/Edit?id=${client.id}"><i class="fa-regular fa-user"></i></a>${client.firstname}</td>
                        <td class="text-center"><button type="button" class="emailBtn" data-bs-toggle="modal" data-bs-target="#validateEmailModal" data-id="${client.id}" data-lastname="${client.lastname}" data-firstname="${client.firstname}" data-email="${client.email}" data-validate="${(client.validated_at == null) ? '0' : '1'}"><i class="fa-regular fa-envelope ${(client.validated_at == null) ? 'noValidate' : 'validate'} "></i></button></td>
                        <td class="text-center"><a class="text-decoration-none" href="tel:${client.phone}">${client.phone}</a></td>
                        <td class="text-center d-none d-sm-table-cell">${birthdate ?? ''}</td>
                        <td class="text-center"><a href="/Dashboard/Clients/Edit?id=${client.id}"><i class="fa-solid fa-pen"></i></a> &emsp;
                            <button type="button" class="text-danger deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="${client.id}" data-lastname="${client.lastname}" data-firstname="${client.firstname}" data-email="${client.email}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    `
                    nbLine++;
                }});

                // Nombre de pages 
                numeroPageMax.value = Math.ceil(data[1][0].nbResultsSearch / parseInt(itemsPerPage.value));
                // MAJ des boutons
                updateBtns();
            }


        })
}

liveSearch(); updateBtns();
// Input field SEARCH
live_search.addEventListener('keyup', () => {
    numeroPage.value = 1;
    liveSearch();
});
live_search.addEventListener('mousein', () => {
    liveSearch();
});
live_search.addEventListener('mouseleave', () => {
    liveSearch();
});

// Items per page
itemsPerPage.addEventListener('change', () => {
    numeroPage.value = 1;
    liveSearch();

});

// Pagination
paginationNext.addEventListener('click', () => {
    if (numeroPage.value < numeroPageMax.value) {
        numeroPage.value++;//Incrémente le numéro de page
        liveSearch();
    }
})
paginationPrevious.addEventListener('click', () => {
    if (numeroPage.value > 1) {
        numeroPage.value--;//Décrémente le numéro de page
        liveSearch();
    }
})
numeroPage.addEventListener('keyup', () => {
    if (numeroPage.value <= numeroPageMax.value && numeroPage.value >= 1) {
        liveSearch();
    }
})
numeroPage.addEventListener('change', () => {
    if (numeroPage.value <= numeroPageMax.value && numeroPage.value >= 1) {
        liveSearch();
    }
})
numeroPage.addEventListener('blur', () => {
    if (numeroPage.value > numeroPageMax.value) {
        numeroPage.value = numeroPageMax.value
    } else if (numeroPage.value < 1) {
        numeroPage.value = 1;
    }
    liveSearch();
})
