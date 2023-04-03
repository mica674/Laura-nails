<div class="container-fluid">

    <div class="container d-flex align-items-center justify-content-end me-3">
        <!-- Nombre de résultats de la recherche -->
        <p id="nbResults" class="m-0"></p>
        <!-- Nombre d'éléments par page -->
        <select name="itemsPerPage" id="itemsPerPage" class="liveSearch mx-3 rounded">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <!-- Champ de recherche -->
        <input type="search" class="form-control liveSearch w-25 bg-dark text-white" id="live_search" autocomplete="off" placeholder="Recherche ...">
    </div>

    <!-- Tableaux de tous les clients -->
    <table class="tableClients">
        <tr class="bgTh">

            <th>Nom</th>
            <th>Prénom</th>
            <th class="text-center">Email</th>
            <th class="text-center">Téléphone</th>
            <th class="text-center d-none d-sm-table-cell">Date de naissance</th>
            <th class="text-center">Actions</th>
        </tr>
        <tbody id="clientsListResult">
            <?php
            $nbLine = 1;
            foreach ($clients as $client) {
            ?>
                <!-- Ligne avec les infos d'un client -->
                <tr class="my-3 trClient<?= ($nbLine % 2) + 1 ?>">
                    <td><a href="/Dashboard/EditClient?id=<?= $client->id ?>"><i class="fa-regular fa-user"></i></a><?= $client->lastname ?></td>
                    <td><a href="/Dashboard/EditClient?id=<?= $client->id ?>"><i class="fa-regular fa-user"></i></a><?= $client->firstname ?></td>
                    <td class="text-center"><button type="button" class="emailBtn" data-bs-toggle="modal" data-bs-target="#validateEmailModal" data-id="<?= $client->id ?>" data-lastname="<?= $client->lastname ?>" data-firstname="<?= $client->firstname ?>" data-email="<?= $client->email ?>"><i class="fa-regular fa-envelope <?= is_null($client->validated_at) ? 'noValidate' : 'validate' ?>"></i></button></td>
                    <td class="text-center"><a class="text-decoration-none" href="tel:<?= $client->phone ?>"><?= $client->phone ?></a></td>
                    <td class="text-center d-none d-sm-table-cell"><?= datefmt_format(DATE_FORMAT, strtotime($client->birthdate ?? '')) ?></td>
                    <td class="text-center"><a href="/Dashboard/Clients/Edit?id=<?= $client->id ?>"><i class="fa-solid fa-pen"></i></a> &emsp;
                        <button type="button" class="text-danger deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $client->id ?>" data-lastname="<?= $client->lastname ?>" data-firstname="<?= $client->firstname ?>" data-email="<?= $client->email ?>">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>

            <?php
                $nbLine++;
            }
            ?>
        </tbody>
    </table>
    <div class="pagination d-flex align-items-center w-25">
        <button type="button" class="bg-transparent border-0 text-white" id="paginationPrevious">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <label for="numeroPage">page</label>
        <input type="number" class="text-center" id="numeroPage" name="numeroPage" value="1">
        <p class="text-center m-0">/</p>
        <input type="number" class="text-center" id="numeroPageMax" value="1" readonly>
        <button type="button" class="bg-transparent border-0 text-white" id="paginationNext">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
    </div>

    <!-- Touche pour aller sur la page pour ajouter un client -->
    <div class="bg-transparent d-flex my-3">
        <a href="/Dashboard/Clients/Add" class="mx-auto text-white addBtn text-decoration-none rounded p-2" id="addClientBtn">Ajouter un client</a>
    </div>

    <!-- MODALE VALIDATE -->
    <div class="modal fade" id="validateEmailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Etes-vous sûre de vouloir valider l'email suivant ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalDescriptionValidate" class="text-dark"></p>
                </div>
                <div class="modal-footer">
                    <a id="modalLinkEmail">
                        <button type="button" id="btnEmail" class="btn btn-info text-white"><i class="fa-solid fa-envelope"></i> Envoyer un email</button>
                    </a>
                    <a id="modalLinkValidate">
                        <button type="button" id="btnValidate " class="btn btn-success text-white"><i class="fa-solid fa-check"></i> Valider</button>
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
                    <h5 class="modal-title text-danger">Etes-vous sûre de vouloir supprimer le client suivant ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Contenant des infos du client à supprimer -->
                    <p id="modalDescriptionDelete" class="text-dark"></p>
                </div>
                <div class="modal-footer">
                    <!-- Bouton de confirmation de la suppresion -->
                    <a href="" id="modalLinkDelete">
                        <button type="button" class="btn btn-danger text-white"><i class="fa-solid fa-trash"></i> Supprimer</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>