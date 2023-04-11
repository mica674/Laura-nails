    <!-- MAIN -->
    <main>
        <!-- Section 1 - Photos de prestations en tête -->
        <section class="prestationsImgPres">
            <img class="imgPrestaPres" id="imgPrestaPres1" src="/public/assets/img/photos/pexels-photo-1373748.jpeg" alt="image vernis">
            <img class="imgPrestaPres rounded-circle" id="imgPrestaPres2" src="/public/assets/img/photos/pexels-photo-3557600.jpeg" alt="image ongle">
        </section>
        <!-- Section 1 end -->

        <!-- Section 2 - Cards de présentations des prestations -->
        <section id="section2">
            <div class="card d-flex align-items-center">
                <h3 class="mt-4 ">Titre magazine 1</h3>
                <div class="section2Img d-flex flex-wrap justify-content-evenly">
                    <div class="card image-fluid w-50 h-75">

                        <img src="/public/assets/img/photos/pexels-photo-1164339.jpeg" alt="">
                    </div>
                    <div class="card image-fluid w-50 h-75">

                        <img src="/public/assets/img/photos/pexels-photo-1367219.webp" alt="">
                    </div>
                    <div class="card image-fluid w-50 h-75">
                        
                        <img src="/public/assets/img/photos/pexels-photo-2268404.webp" alt="">
                    </div>
                    <div class="card image-fluid w-50 h-75">

                        <img src="/public/assets/img/photos/pexels-photo-963757.webp" alt="">
                    </div>
                </div>
            </div>
            <div class="card d-flex align-items-center">
                <h3 class="mt-4 text-center">Titre magazine 2</h3>
                <div class="section2Img d-flex flex-wrap justify-content-evenly">
                    <img src="/public/assets/img/photos/pexels-photo-1373748.jpeg" alt="">
                    <img src="/public/assets/img/photos/pexels-photo-239576.jpeg" alt="">
                    <img src="/public/assets/img/photos/pexels-photo-3557600.jpeg" alt="">
                    <img src="/public/assets/img/photos/pexels-photo-3997381.webp" alt="">
                </div>
            </div>
            <div class="card d-flex align-items-center">
                <h3 class="mt-4 text-center">Titre magazine 3</h3>
                <div class="section2Img d-flex flex-wrap justify-content-evenly">
                    <img src="/public/assets/img/photos/pexels-photo-3997379.webp" alt="">
                    <img src="/public/assets/img/photos/pexels-photo-4542998.webp" alt="">
                    <img src="/public/assets/img/photos/pexels-photo-5448160.jpeg" alt="">
                    <img src="/public/assets/img/photos/pexels-photo-7738879.webp" alt="">
                </div>
            </div>

        </section>

        <!-- Séparation de section -->
        <div class="hr my-2">
            <hr>
        </div>

        <section id="section3">
            <div class="container-fluid">
                <div class="row justify-content-evenly">

                    <?php
                    foreach ($prestations as $prestation) { ?>

                        <!-- Nouvelle card de prestation -->
                        <div class="col-12 col-md-5 my-2 cardPresta cardPresta<?= $prestation->id ?>">
                            <div class="titleCard mb-5">
                                <h3 class="fw-bold"><?= $prestation->title ?></h3>
                            </div>
                            <div class="contentCard py-3">
                                <p><?= explode(';', $prestation->description)[0] ?></p>
                                <p><?= explode(';', $prestation->description)[1] ?></p>
                                <div class="d-flex justify-content-between">
                                    <span><?= $prestation->duration ?>min</span>
                                    <span><?= $prestation->price ?>€</span>
                                </div>
                            </div>
                        </div>

                        <!-- Séparation de prestation -->
                        <div class="d-md-none hr my-1">
                            <hr>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </div>


        </section>
        <!-- Fin de section des prestations -->
    </main>
    <!-- MAIN end -->