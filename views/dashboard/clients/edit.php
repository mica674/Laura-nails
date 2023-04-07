<!-- MAIN -->
<main>
    <!-- Client profil form -->
    <div class="mt-2">
        <form method="post" class="d-flex flex-column align-items-center" id="clientEditForm">
            <fieldset class="loginFieldset">
                <h2>Profil du client</h2>
            </fieldset>
            <!-- Lastname -->
            <label for="lastname" class="mt-2">Nom</label>
            <input type="text" name="lastname" id="lastname" class="inputForm rounded" placeholder="Nom (ex: Dupond)" required autocomplete="family-name" value="<?= $client->lastname ?>" pattern="<?= REGEXP_LASTNAME ?>" readonly>
            <small <?= ($error['lastname'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['lastname'] ?? '' ?></small>
            <!-- Firstname -->
            <label for="firstname" class="mt-2">Prénom</label>
            <input type="text" name="firstname" id="firstname" class="inputForm rounded" placeholder="Prénom (ex: Jean)" required autocomplete="given-name" value="<?= $client->firstname ?>" pattern="<?= REGEXP_FIRSTNAME ?>" readonly>
            <small <?= ($error['firstname'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['firstname'] ?? '' ?></small>
            <!-- Email -->
            <label for="email" class="mt-2">email</label>
            <input type="email" name="email" id="email" class="inputForm rounded" placeholder="E-mail (ex: dupond.jean@example.com)" required autocomplete="email" value="<?= $client->email ?>" readonly>
            <small <?= ($error['email'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['email'] ?? '' ?></small>
            <!-- Phone number -->
            <label for="phone" class="mt-2">Numéro de téléphone</label>
            <input type="tel" name="phone" id="phone" class="inputForm rounded" placeholder="Numéro de téléphone (ex: 0612345678)" autocomplete="tel-local" maxlength="10" value="<?= $client->phone ?? '' ?>" pattern="<?= REGEXP_PHONE_NUMBER ?>" readonly>
            <!-- Birthday -->
            <label for="birthdate" class="mt-2">Date de naissance</label>
            <input type="date" name="birthdate" id="birthdate" class="inputForm rounded" required autocomplete="bday" value="<?= $client->birthdate ?>" min="<?= date('Y-m-d', time() - (86400 * 365 * 150)) ?>" max="<?= date('Y-m-d') ?>" readonly>

            <!-- Button to registrer -->
            <div class="registrationBtns mt-2">
                <button class="modifyBtn d-none" id="clientEditBtn">Enregistrer</button>
            </div>

        </form>
    </div>

    <div class="container-fluid">
        <!-- COMMENTS -->
    <h2 class="text-center mt-5">Commentaires du client</h2>

        <table class="tableClients">
            <tr class="bgTh">
                <th><i class="fa-solid fa-xmark" style="color: #ff0000;"></i> <i class="fa-solid fa-check" style="color: #01b701;"></i></th>
                <th class="text-center">Titre</th>
                <th class="text-center">Créé le</th>
                <th class="text-center">Description</th>
                <th class="text-center">Note</th>
                <th class="text-center">Actions</th>
            </tr>
            <tbody id="commentListResult">

                <?php
                $nbLine = 1;
                foreach ($comments as $comment) { 
                    if (!$comment->deleted_at) {
                    ?>

                    <!-- Ligne avec les infos d'un commentaire -->
                    <tr class="my-3 trClient<?= ($nbLine % 2) + 1 ?>">
                        <td>
                            <button type="button" class="validateBtn" data-bs-toggle="modal" data-bs-target="#validateCommentModal" data-id="<?= $comment->id ?>" data-idclient="<?= $idClient ?>"  data-content="<?= $comment->content ?>" data-quotations="<?= $comment->quotations ?>" data-validate="<?=is_null($comment->moderated_at)?0:1?>" data-delete="<?=is_null($comment->deleted_at)?0:1?>">
                                <?= $comment->moderated_at ? '<i class="fa-solid fa-check" style="color: #01b701;"></i>' : '<i class="fa-solid fa-xmark fa-shake" style="color: #ff0000;"></i>' ?>
                            </button>
                        </td>

                        <td class="text-center"><?= $comment->title ?></td>
                        <td class="text-center"><?= datefmt_format(DATE_FORMAT_HOUR, strtotime($comment->created_at)) ?></td>
                        <td class="text-center"><?= $comment->content ?></td>
                        <td class="text-center"><?= $comment->quotations ?></td>
                        <td class="text-center">
                            <a href="/Dashboard/Reviews/Edit?id=<?= $comment->id ?>"><i class="fa-solid fa-pen"></i></a> &emsp;
                            <button type="button" class="text-danger deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $comment->id ?>" data-idclient="<?= $idClient ?>"  data-content="<?= $comment->content ?>" data-quotations="<?= $comment->quotations ?>" data-delete="<?=is_null($comment->deleted_at)?0:1?>">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    
                <?php $nbLine++;
             }} ?>
            </tbody>
        </table>

    <div class="container-fluid">
        <!-- COMMENT DELETED -->
    <h2 class="text-center mt-5">Commentaires supprimés</h2>

        <table class="tableClients">
            <tr class="bgTh">
                <th><i class="fa-solid fa-xmark" style="color: #ff0000;"></i> <i class="fa-solid fa-check" style="color: #01b701;"></i></th>
                <th class="text-center">Titre</th>
                <th class="text-center">Créé le</th>
                <th class="text-center">Description</th>
                <th class="text-center">Note</th>
                <th class="text-center">Actions</th>
            </tr>
            <tbody id="commentListResult">

                <?php
                $nbLine = 1;
                foreach ($comments as $comment) { 
                    if ($comment->deleted_at) {
                        ?>

                    <!-- Ligne avec les infos d'un commentaire -->
                    <tr class="my-3 trClient<?= ($nbLine % 2) + 1 ?>">
                        <td>
                            <button type="button" class="validateBtn" data-bs-toggle="modal" data-bs-target="#validateCommentModal" data-id="<?= $comment->id ?>" data-idclient="<?= $idClient ?>"  data-content="<?= $comment->content ?>" data-quotations="<?= $comment->quotations ?>" data-validate="<?=is_null($comment->moderated_at)?0:1?>" data-delete="<?=is_null($comment->deleted_at)?0:1?>">
                                <i class="fa-solid fa-exclamation ms-2" style="color: #fbbc04;"></i>
                            </button>
                        </td>

                        <td class="text-center"><?= $comment->title ?></td>
                        <td class="text-center"><?= datefmt_format(DATE_FORMAT_HOUR, strtotime($comment->created_at)) ?></td>
                        <td class="text-center"><?= $comment->content ?></td>
                        <td class="text-center"><?= $comment->quotations ?></td>
                        <td class="text-center">
                            <a href="/Dashboard/Reviews/Edit?id=<?= $comment->id ?>"><i class="fa-solid fa-pen"></i></a> &emsp;
                        </td>
                    </tr>
                    
                <?php $nbLine++;
             }} ?>
            </tbody>
        </table>

    <!-- MODALE VALIDATE -->
    <div class="modal fade" id="validateCommentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Que voulez-vous faire du commentaire suivant ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalDescriptionValidate" class="text-dark"></p>
                </div>
                <div class="modal-footer">
                    <a href="" id="modalLinkValidate">
                        <button type="button" class="btn btn-success text-white"><i class="fa-solid fa-check"></i> Valider</button>
                    </a>
                    <a href="" id="modalLinkNoValidate">
                        <button type="button" class="btn btn-danger text-white"><i class="fa-solid fa-xmark"></i> Supprimer</button>
                    </a>
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                </div>
            </div>
        </div>
    </div>

    <!-- MODALE DELETE -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Etes-vous sûre de vouloir supprimer le commentaire suivant ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalDescriptionDelete" class="text-dark"></p>
                </div>
                <div class="modal-footer">
                    <a href="" id="modalLinkDelete">
                        <button type="button" class="btn btn-danger text-white"><i class="fa-solid fa-trash"></i> Supprimer</button>
                    </a>
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                </div>
            </div>
        </div>
    </div>

    </div>
</main>
<!-- MAIN end -->