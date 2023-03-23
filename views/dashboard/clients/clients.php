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
        <tr class="my-3 trClient<?=($nbLine%2)+1?>">
                <td><a href="/EditClient?id=<?= $client->id?>"><i class="fa-regular fa-user"></i></a><?=$client->lastname?></td>
                <td><a href="/EditClient?id=<?= $client->id?>"><i class="fa-regular fa-user"></i></a><?=$client->firstname?></td>
                <td class="text-center"><a href="mailto:<?=$client->email?>"><i class="fa-regular fa-envelope"></i></a></td>
                <td class="text-center"><a href="tel:<?=$client->phone?>"><?=$client->phone?></a></td>
                <td class="text-center d-none d-sm-table-cell"><?=datefmt_format(DATE_FORMAT, strtotime($client->birthdate))?></td>
                <td class="text-center"><a href="/EditClient?id=<?= $client->id ?>"><i class="fa-solid fa-pen"></i></a> &emsp; <a href="/DeleteClient?id=<?= $client->id ?>"><i class="fa-solid fa-trash"></i></a></td>
        </tr>
        
        <?php
        $nbLine++;
        }
        ?>
    </table>
    <div class="bg-transparent d-flex my-3">
        <a href="/Dashboard/AddClient" class="mx-auto text-white addBtn">Ajouter un client</a>
    </div>
</div>