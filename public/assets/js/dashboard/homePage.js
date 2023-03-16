var images = document.querySelectorAll('.carouselImageInput');
var imagePreviews = document.querySelectorAll('.previewImage');
const btnAddImage = document.getElementById('btnAddImage');
// Cibler le parent du parent = row
const rowImages = images[0].parentNode.parentNode;
// Cibler bouton submit input Enregistrer
const submitBtn = document.getElementById('submitBtn');
// Cibler la croix de suppression
var closeBtns = document.querySelectorAll('.closeBtn');

function updateSelectors() {
    // Mise à jour des ciblage HTML
    images = document.querySelectorAll('.carouselImageInput');
    imagePreviews = document.querySelectorAll('.previewImage');
    closeBtns = document.querySelectorAll('.closeBtn');
    console.log(closeBtns);

}

function changePreviews() {
    images.forEach(image => {
        image.addEventListener('change', () => {
            // Récupérer les infos de l'image sélectionnée
            let picture = image.files[0];
            // Récupérer le numéro de la photo avec son id
            let idImage = image.id.substr(-1);
            // Affecte l'url de l'image sélectionnée dans la balise image correspondante
            imagePreviews[idImage - 1].src = URL.createObjectURL(picture);
            // Force la taille de l'image à 100% de la hauteur du parent
            imagePreviews[idImage - 1].style.height = '100%';
            // Vérif si les zones ont toutes une image implémenter pour afficher la touche 'Enregistrer'
            var isEmpty = false;
            images.forEach(image => {
                if (image.files.length == 0) {
                    isEmpty = true;
                }
            })
            if (!isEmpty) {
                // Affichage de la touche 'Enregistrer'
                submitBtn.classList.remove('d-none');
            }
        })
    });
}

function closeItem() {
    closeBtns.forEach(closeBtn => {
        closeBtn.addEventListener('click', () => {
            // Suppression du parent du parent
            closeBtn.parentNode.parentNode.remove();
            updateSelectors();
        })
    })
}

btnAddImage.addEventListener('click', (e) => {
    e.preventDefault();
    let newId = images.length + 1;
    let newImage = document.createElement("div");
    newImage.classList.add('col-3', 'carouselImage')
    newImage.innerHTML +=
        `        
        <input class="carouselImageInput" name="carouselImage[]" id="image${newId}" type="file" accept="image/*">
        <div>
            <img src="" alt="Carousel${newId}" class="previewImage" id="previewImage${newId}">
            <button type="button" class="fs-5 closeBtn">X</button>
        </div>
        `;
    rowImages.insertBefore(newImage, btnAddImage.parentNode);
    updateSelectors(); closeItem();
    // Masquer la touche enregistrer
    submitBtn.classList.add('d-none');
    changePreviews();
})

console.log(images[0].files.length);
changePreviews(); closeItem();