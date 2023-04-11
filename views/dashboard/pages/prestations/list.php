<div class="container-fluid">
    <!-- Tableaux de toutes les prestations -->
    <table class="tablePrestations">
        <tr class="bgTh">
            <th>Nom</th>
            <th class="text-center">Description principale</th>
            <th class="text-center">Description optionnelle</th>
            <th class="text-center">Durée</th>
            <th class="text-center">Prix</th>
            <th class="text-center">Actions</th>
        </tr>
        <?php
        $nbLine = 1;
        foreach ($prestations as $prestation) {
            if (!$prestation->deleted_at) {
                $description = explode(';', $prestation->description);
        ?>
                <tr class="my-3 trPrestation<?= ($nbLine % 2) + 1 ?>">
                    <td><a class="text-warning" href="/Dashboard/Prestations/Edit?id=<?= $prestation->id ?>"><i class="fa-solid fa-pen"></i></a><?= $prestation->title ?></td>
                    <td class="text-center"><?= $description[0] ?></td>
                    <td class="text-center"><?= $description[1] ?></td>
                    <td class="text-center"><?= $prestation->duration ?>min</td>
                    <td class="text-center"><?= $prestation->price ?>€</td>
                    <td class="text-center">
                        <a class="text-warning" href="/Dashboard/Prestations/Edit?id=<?= $prestation->id ?>"><i class="fa-solid fa-pen"></i></a> &emsp;
                        <button type="button" class="text-danger deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $prestation->id ?>" data-name="<?= $prestation->title ?>" data-description="<?= $description[0] ?>"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>

        <?php
                $nbLine++;
            }
        }
        ?>
    </table>
    <!-- Touche pour aller sur la page ADD prestation -->
    <div class="bg-transparent d-flex my-3">
        <a href="/Dashboard/Prestations/Add" class="mx-auto text-white addBtn" id="addPrestationBtn">Ajouter une prestation</a>
    </div>

    <div class="container-fluid">
        <!-- Tableaux de toutes les prestations -->
        <table class="tablePrestations">
            <tr class="bgTh">
                <th>Nom</th>
                <th class="text-center">Description principale</th>
                <th class="text-center">Description optionnelle</th>
                <th class="text-center">Durée</th>
                <th class="text-center">Prix</th>
                <th class="text-center">Actions</th>
            </tr>
            <?php
            $nbLine = 1;
            foreach ($prestations as $prestation) {
                if ($prestation->deleted_at) {
                    $description = explode(';', $prestation->description);
            ?>
                    <tr class="my-3 trPrestation<?= ($nbLine % 2) + 1 ?>">
                        <td><?= $prestation->title ?></td>
                        <td class="text-center"><?= $description[0] ?></td>
                        <td class="text-center"><?= $description[1] ?></td>
                        <td class="text-center"><?= $prestation->duration ?>min</td>
                        <td class="text-center"><?= $prestation->price ?>€</td>
                        <td class="text-center">
                            <a href="/Dashboard/Prestations/Getback?id=<?= $prestation->id ?>">
                                <i class="fa-solid fa-exclamation ms-2" style="color: #fbbc04;"></i>
                            </a>
                        </td>
                    </tr>

            <?php
                    $nbLine++;
                }
            }
            ?>
        </table>


        <!-- MODALE DELETE -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger">Etes-vous sûre de vouloir supprimer la prestation suivante ?</h5>
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