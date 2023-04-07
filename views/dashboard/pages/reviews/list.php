 <div class="container-fluid">

     <!-- Tableaux de tous les avis client -->
     <h2>Commentaires clients</h2>
     <table class="tableReviews">
         <tr class="bgTh">
             <th class="text-center">Prénom</th>
             <th class="text-center">Titre</th>
             <th class="text-center">Description</th>
             <th class="text-center">Quotations</th>
             <th class="text-center">Actions</th>
         </tr>
         <tbody id="reviewsListResult">
             <?php
                $nbLine = 1;
                foreach ($reviews as $review) {
                    if (!$review->deleted_at) {
                ?>

                     <!-- Ligne avec les infos d'un commentaire -->
                     <tr class="my-3 trReview<?= ($nbLine % 2) + 1 ?>">
                         <td class="text-center"><?= Client::get($review->id_clients)->firstname ?></td>
                         <td class="text-center"><?= $review->title ?></td>
                         <td class="text-center"><?= $review->content ?></td>
                         <td class="text-center"><?php for ($note = 1; $note <= $review->quotations; $note++) { ?>
                                 <!-- Etoile pleine -->
                                 <i class="fa-solid fa-star"></i>
                             <?php } ?>
                         </td>
                         <td class="text-center">
                             <a class="text-warning" href="/Dashboard/Reviews/Edit?id=<?= $review->id ?>"><i class="fa-solid fa-pen"></i></a> &emsp;
                             <button type="button" class="text-danger deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $review->id ?>" data-title="<?= $review->title ?>" data-description="<?= $review->content ?>"><i class="fa-solid fa-trash"></i></button>
                         </td>
                     </tr>
             <?php $nbLine++;
                    }
                } ?>
         </tbody>
     </table>

     <div class="container-fluid">
         <!-- Tableaux de tous les avis client supprimés -->
         <h2>Commentaires supprimés</h2>
         <table class="tableReviews">
             <tr class="bgTh">
                 <th class="text-center">Prénom</th>
                 <th class="text-center">Titre</th>
                 <th class="text-center">Description</th>
                 <th class="text-center">Quotations</th>
                 <th class="text-center">Actions</th>
             </tr>
             <tbody id="reviewsListResult">
                 <?php
                    $nbLine = 1;
                    foreach ($reviews as $review) {
                        if ($review->deleted_at) {
                    ?>

                         <!-- Ligne avec les infos d'un commentaire -->
                         <tr class="my-3 trReview<?= ($nbLine % 2) + 1 ?>">
                             <td class="text-center"><?= Client::get($review->id_clients)->firstname ?></td>
                             <td class="text-center"><?= $review->title ?></td>
                             <td class="text-center"><?= $review->content ?></td>
                             <td class="text-center"><?php for ($note = 1; $note <= $review->quotations; $note++) { ?>
                                     <!-- Etoile pleine -->
                                     <i class="fa-solid fa-star"></i>
                                 <?php } ?>
                             </td>
                             <td class="text-center">
                             <a href="/Dashboard/Reviews/Getback?id=<?=$review->id?>">
                                <i class="fa-solid fa-exclamation ms-2" style="color: #fbbc04;"></i>
                            </a>
                             </td>
                         </tr>
                 <?php $nbLine++;
                        }
                    } ?>
             </tbody>
         </table>

         <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title text-danger">Etes-vous sûre de vouloir supprimer l'avis suivant ?</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true"></span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <p id="modalDescription" class="text-dark"></p>
                     </div>
                     <div class="modal-footer">
                         <a href="" id="modalLink">
                             <button type="button" class="btn btn-danger text-white"><i class="fa-solid fa-trash"></i> Supprimer</button>
                         </a>
                         <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                     </div>
                 </div>
             </div>
         </div>

     </div>