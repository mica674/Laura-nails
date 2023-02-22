<div class="container-fluid">
    <!-- Tableaux de tous les clients -->
    <table class="tableClients">
        <tr class="bgTh text-center">
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Date de naissance</th>
            <th>Actions</th>
        </tr>
        <?php
        $nbLine = 1;
        foreach ($clients as $client) {
        ?>
        <tr class="my-3 trclient<?=($nbLine%2)+1?> text-center">
                <td><?=$client->lastname?></td>
                <td><?=$client->firstname?></td>
                <td><a href="mailto:<?=$client->email?>"><?=$client->email?></a></td>
                <td><a href="tel:<?=$client->phone?>"><?=$client->phone?></a></td>
                <td><?=datefmt_format(DATE_FORMAT, strtotime($client->birthdate))?></td>
                <td><a href="/Editclient?id=<?=$client->id?>&lastname=<?=$client->lastname?>&firstname=<?=$client->firstname?>&email=<?=$client->email?>&birthdate=<?=$client->birthdate?>">Modifier</a></td>
        </tr>
        
        <?php
        $nbLine++;
        }
        ?>
    </table>
    <div class="bg-transparent d-flex my-3">
        <a href="/controllers/addclientCtrl.php" class="mx-auto text-white addBtn">Ajouter un client</a>
    </div>
</div>