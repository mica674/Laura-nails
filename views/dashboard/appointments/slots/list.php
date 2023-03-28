<div class="container-fluid">
    <!-- Tableaux de tous les slots -->
    <table class="tableSlots">
        <tr class="bgTh">
            <th class="text-center">Début</th>
            <th class="text-center">Fin</th>
            <th class="text-center">Intervalle</th>
            <th class="text-center">Actions</th>
        </tr>
        <?php
        $nbLine = 1;
        foreach ($slots as $slot) {
        ?>
            <tr class="my-3 trslot<?= ($nbLine % 2) + 1 ?>">
                <td class="text-center"><?= $slot->slotStart ?></td>
                <td class="text-center"><?= $slot->slotEnd ?></td>
                <td class="text-center"><?= $slot->slotStep ?></td>
                <td class="text-center"><a href="/Dashboard/Appointments/Slots/Edit?id=<?= $slot->id ?>"><i class="fa-solid fa-pen text-warning"></i></a> &emsp;
                    <button type="button" class="text-danger deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $slot->id ?>" data-start="<?= $slot->slotStart ?>" data-end="<?= $slot->slotEnd ?>" data-step="<?=$slot->slotStep?>"> 
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
        <a href="/Dashboard/Appointments/Slots/Add" class="mx-auto text-white addBtn text-decoration-none">Ajouter un créneau</a>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Etes-vous sûre de vouloir supprimer le créneau suivant ?</h5>
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