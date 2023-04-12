<h1 class="text-center text-white">'Le plus beau maquillage pour une femme, c'est la passion' <span class="fs-5 text-warning">Laura Maurouard</span></h1>

<!-- CAROUSEL -->
<section>
    <div id="carouselHomePage" class="carousel slide my-5" data-bs-ride="carousel">
        <!-- <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselHomePage" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselHomePage" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselHomePage" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div> -->
        <div class="carousel-inner">
            <div class="carousel-item carouselItem active">
                <img src="/public/assets/img/photos/carousel1.jpg" alt="photo de mains manucurées">
            </div>
            <div class="carousel-item carouselItem">
                <img src="/public/assets/img/carousel/IMG_0425.png" alt="photo de manucure">
            </div>
            <div class="carousel-item carouselItem">
                <img src="/public/assets/img/photos/carousel3.jpg" alt="photo mains manucurées">
            </div>
        </div>
        <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselHomePage" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselHomePage" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button> -->
    </div>
</section>
<!-- CAROUSEL end -->


<!-- PRESENTATION DE LAURA -->
   <div class="container-fluid">
       <div class="row align-items-center"  id="containerLauraPicture">
           <div class="col-4 d-flex justify-content-center align-items-center" id="subcontainerLauraPicture"><img src="/public/assets/img/photos/photo1.jpeg" id="lauraPicture" alt=""></div>
           <div class="col-8 text-justify">
            <p><span class="text-warning"> Laura Maurouard</span> est une <span class="text-warning">maquilleuse professionnelle française</span>, reconnue pour son talent dans l'industrie du maquillage et de la beauté. </p>
            <p>Elle a commencé sa carrière en tant que maquilleuse artistique pour le théâtre, la télévision et le cinéma, et a travaillé sur de nombreux projets en France et à l'étranger.</p>
            <p>Au fil des années, Laura Maurouard s'est spécialisée dans le maquillage pour les mariages et les événements spéciaux, et a développé une clientèle fidèle grâce à son expertise et sa passion pour l'<span class="text-warning">art du maquillage</span>. Elle est également connue pour ses tutoriels de maquillage sur YouTube, où elle partage ses conseils et astuces avec sa communauté de fans.</p>
            <p>Laura Maurouard est souvent sollicitée par des célébrités pour des événements de premier plan, des <span class="text-warning">séances photo</span> et des <span class="text-warning">tournages</span>. Elle a travaillé avec des personnalités comme Cristina Cordula, Inès de la Fressange, et Amel Bent.</p>
            <p>En plus de son travail de maquilleuse, Laura Maurouard est également <span class="text-warning">formatrice</span> et partage son expertise lors de sessions de formation pour les professionnels du maquillage ainsi que pour les amateurs passionnés.</p>  

                   
           </div>
       </div>
   </div>



   <!-- Séparation de section -->
   <div class="hr">
       <hr>
   </div>

   <!-- PLACE & DATE -->
   <section>
       <div class="placeDate text-center" id="place">
           <p class="placeDate-placeText my-5">
               <?= explode(',', LAURA_ADDRESS)[0] . '<br>' . explode(',', LAURA_ADDRESS)[1] ?>
           </p>
           <p class="placeDate-dateText mb-5">
               lundi au vendredi : 9h - 17h
           </p>
       </div>
       <div class="maps">
           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1478.5408232480625!2d1.2180906018184967!3d49.879748316059!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e0a504daba9153%3A0x8a0025e32becf366!2s122%20Rue%20Edouard%20Cannevel%2C%2076510%20Saint-Nicolas-d&#39;Aliermont!5e1!3m2!1sfr!2sfr!4v1680852260827!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
       </div>
   </section>
   <!-- PLACE & DATE end -->


   <!-- REVIEW -->
   <section>
       <!-- Titre de la section -->
       <div class="reviewTitle text-center my-5">
           <h3>Avis</h3>
       </div>
       <!-- Affichage de commentaires déjà postés -->
       <div class="container">

           <?php
            foreach ($last5Comments as $comment) {
                if (!is_null($comment->moderated_at)) {
            ?>

                   <div class="reviewCard mb-2 rounded">
                       <div class="row reviewRow align-items-center">
                           <div class="reviewNickname ms-3 col-5">
                               <p class="mb-0 ms-2"><?= Client::get($comment->id_clients)->firstname ?></p>
                           </div>
                           <div class="reviewDate col-5 offset-1">
                               <p class="mb-0 ms-2"><?= $comment->title ?><small class="d-none d-md-inline ms-5"><?= datefmt_format(DATE_FORMAT_HOUR, strtotime($comment->created_at)) ?></small></p>
                           </div>
                       </div>
                       <div class="row reviewRow align-items-center">
                           <div class="reviewComment col-11 ms-3 mb-2">
                               <p class="mb-0 ms-2"><?= $comment->content ?>
                                   <small>
                                       <?php
                                        $stars = $comment->quotations; //Nombre d'étoiles de l'avis
                                        $star = 1; //Initialisation première étoile
                                        while ($star <= $stars) { ?>
                                           <!-- Etoile pleine -->
                                           <i class="fa-solid fa-star"></i>
                                       <?php $star++;
                                        }
                                        while ($star <= 5) { ?>
                                           <!-- Etoile vide -->
                                           <i class="fa-regular fa-star"></i>
                                       <?php $star++;
                                        }
                                        ?></small>
                               </p>
                           </div>
                       </div>
                   </div>

           <?php
                }
            }
            ?>

       </div>
       <div class="d-flex justify-content-center">
           <a href="/Avis" id="reviewBtn" class="text-center">
               Soumettre un avis
           </a>
       </div>
   </section>
   <!-- REVIEW end -->

   <!-- Séparation de section -->
   <div class="hr my-3">
       <hr>
   </div>


   <!-- CONTACT -->
   <section>
       <div class="d-flex justify-content-center my-4">
           <a href="/Contact" id="contactBtn" class="text-center">
               Contact
           </a>
       </div>
   </section>
   <!-- CONTACT end -->
   </main>
   <!-- MAIN end -->