
<h2 class="text-white">Carousel</h2>
<form method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-3 carouselImage">
            <input class="carouselImageInput" name="carouselImage[]" id="image1" type="file" accept="image/*">
            <div>
                <img src="" alt="Carousel1" class="previewImage" id="previewImage1">
                <button type="button" class="fs-5 closeBtn">X</button>
            </div>
        </div>
        <div class="col-3 carouselImage add"><button id="btnAddImage"><i class="fa-solid fa-plus"></i></button></div>
    </div>
    <div class="d-flex flex-start">
        <input type="submit" value="Enregistrer" class="d-none" id="submitBtn"/>
    </div>

</form> 