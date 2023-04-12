<div class="container-fluid">
    <!-- Tableaux de tous les appointmen$appointments -->
    <table class="tableClients">
        <tr class="bgTh">
            <th><i class="fa-solid fa-xmark" style="color: #ff0000;"></i> <i class="fa-solid fa-check" style="color: #01b701;"></i></th>
            <th class="text-center">Rendez-vous</th>
            <th class="text-center">Prestations choisis</th>
            <th class="d-none d-md-table-cell">Nom</th>
            <th class="d-none d-md-table-cell">Prénom</th>
            <th class="text-center">Email</th>
            <th class="text-center">Téléphone</th>
            <th class="text-center">Actions</th>
        </tr>
        <?php
        $nbLine = 1;
        foreach ($appointments as $appointment) {
            $appointmentsServices = Appointment::getAppointmentsServices($appointment->id);
        ?>
            <tr class="my-3 trClient<?= ($nbLine % 2) + 1 ?>">
                <td>
                    <button type="button" class="validateBtn" <?=!$appointment->validated_at?'data-bs-toggle="modal" data-bs-target="#validateAppointmentModal"':''?> data-id="<?= $appointment->id ?>" data-appointment="<?=$appointment->appointment?>" data-email="<?= $appointment->email ?>">
                        <?= $appointment->validated_at ? '<i class="fa-solid fa-check" style="color: #01b701;"></i>' : '<i class="fa-solid fa-xmark fa-shake" style="color: #ff0000;"></i>' ?>
                    </button>
                </td>
                <td class="tdAppointment text-center"><?= datefmt_format(DATE_FORMAT_HOUR, strtotime($appointment->appointment)) ?></td>
                <td class="text-center"><?php foreach ($appointmentsServices as $key => $prestation) {
                                            echo $prestation->title . (($key != 2) ? ' <br>' : '');
                                        } ?></td>
                <td class="tdAppointment tdName d-none d-md-table-cell"><a href="/Dashboard/Clients/Edit?id=<?= $appointment->idClients ?>"><i class="fa-regular fa-user"></i></a> <?= $appointment->lastname ?></td>
                <td class="tdAppointment tdName d-none d-md-table-cell"><a href="/Dashboard/Clients/Edit?id=<?= $appointment->idClients ?>"><i class="fa-regular fa-user"></i></a> <?= $appointment->firstname ?></td>
                <td class="tdAppointment text-center"><a href="mailto:<?= $appointment->email ?>"><i class="fa-regular fa-envelope"></i></a></td>
                <td class="tdAppointment text-center"><a href="tel:<?= $appointment->phone ?>"><?= $appointment->phone ?></a></td>
                <td class="text-center"><a href="/Dashboard/Appointments/Edit?id=<?= $appointment->id ?>"><i class="fa-solid fa-pen"></i></a> &emsp;
                    <button type="button" class="text-danger deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $appointment->id ?>" data-lastname="<?= $appointment->lastname ?>" data-firstname="<?= $appointment->firstname ?>" data-date="<?= $appointment->appointment ?>">
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

    <!-- MODALE VALIDATE -->
    <div class="modal fade" id="validateAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Etes-vous sûre de vouloir valider le rendez-vous suivant ?</h5>
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
                    <h5 class="modal-title text-danger">Etes-vous sûre de vouloir supprimer le rendez-vous suivant ?</h5>
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