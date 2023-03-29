<div class="container-fluid">
    <!-- Tableaux de tous les appointmen$appointments -->
    <table class="tableClients">
        <tr class="bgTh">
        <th class="text-center">Rendez-vous</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th class="text-center">Email</th>
            <th class="text-center">Téléphone</th>
            <th class="text-center">Actions</th>
        </tr>
        <?php
        $nbLine = 1;
        foreach ($appointments as $appointment) {
        ?>
            <tr class="my-3 trClient<?= ($nbLine % 2) + 1 ?>">
            <td class="tdAppointment text-center"><?=datefmt_format(DATE_FORMAT_HOUR, strtotime($appointment->appointment))?></td>
                <td class="tdAppointment tdName"><a href="/EditPatient?id=<?=$appointment->idClients?>"><i class="fa-regular fa-user"></i></a> <?=$appointment->lastname?></td>
                <td class="tdAppointment tdName"><a href="/EditPatient?id=<?=$appointment->idClients?>"><i class="fa-regular fa-user"></i></a> <?=$appointment->firstname?></td>
                <td class="tdAppointment text-center"><a href="mailto:<?=$appointment->email?>"><i class="fa-regular fa-envelope"></i></a></td>
                <td class="tdAppointment text-center"><a href="tel:<?=$appointment->phone?>"><?=$appointment->phone?></a></td>
                <td class="text-center"><a href="/Dashboard/Appointments/Edit?id=<?= $appointment->idClients ?>"><i class="fa-solid fa-pen"></i></a> &emsp;
                    <button type="button" class="text-danger deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $appointment->id ?>" data-lastname="<?= $appointment->lastname ?>" data-firstname="<?= $appointment->firstname ?>" data-email="<?=$appointment->email?>"> 
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
        <a href="/Dashboard/Appointments/Add" class="mx-auto text-white addBtn text-decoration-none">Ajouter un rendez-vous</a>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Etes-vous sûre de vouloir supprimer le rendez-vous suivant ?</h5>
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