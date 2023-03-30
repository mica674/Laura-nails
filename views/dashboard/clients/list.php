<div class="container-fluid">
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
        <?php
        $nbLine = 1;
        foreach ($clients as $client) {
        ?>
            <tr class="my-3 trClient<?= ($nbLine % 2) + 1 ?>">
                <td><a href="/Dashboard/EditClient?id=<?= $client->id ?>"><i class="fa-regular fa-user"></i></a><?= $client->lastname ?></td>
                <td><a href="/Dashboard/EditClient?id=<?= $client->id ?>"><i class="fa-regular fa-user"></i></a><?= $client->firstname ?></td>
                <td class="text-center"><a href="mailto:<?= $client->email ?>"><i class="fa-regular fa-envelope"></i></a></td>
                <td class="text-center"><a class="text-decoration-none" href="tel:<?= $client->phone ?>"><?= $client->phone ?></a></td>
                <td class="text-center d-none d-sm-table-cell"><?= datefmt_format(DATE_FORMAT, strtotime($client->birthdate??'')) ?></td>
                <td class="text-center"><a href="/Dashboard/Clients/Edit?id=<?= $client->id ?>"><i class="fa-solid fa-pen"></i></a> &emsp;
                    <button type="button" class="text-danger deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $client->id ?>" data-lastname="<?= $client->lastname ?>" data-firstname="<?= $client->firstname ?>" data-email="<?=$client->email?>"> 
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>

        <?php
            $nbLine++;
        }
        ?>
    </table>
    <div class="bg-transparent d-flex my-3">
        <a href="/Dashboard/Clients/Add" class="mx-auto text-white addBtn text-decoration-none">Ajouter un client</a>
    </div>

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