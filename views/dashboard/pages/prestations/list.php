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
            $description = explode(';',$prestation->description);
        ?>
        <tr class="my-3 trPrestation<?=($nbLine%2)+1?>">
                <td><a href="/Dashboard/Prestations/Edit?id=<?= $prestation->id?>"><i class="fa-solid fa-pen"></i></a><?=$prestation->title?></td>
                <td class="text-center"><?=$description[0]?></td>
                <td class="text-center"><?=$description[1]?></td>
                <td class="text-center"><?=$prestation->duration?>min</td>
                <td class="text-center"><?=$prestation->price?>€</td>
                <td class="text-center"><a href="/Dashboard/Prestations/Edit?id=<?= $prestation->id ?>"><i class="fa-solid fa-pen"></i></a> &emsp; <a href="/Dashboard/Prestations/Delete?id=<?= $prestation->id ?>"><i class="fa-solid fa-trash"></i></a></td>
        </tr>
        
        <?php
        $nbLine++;
        }
        ?>
    </table>
    <div class="bg-transparent d-flex my-3">
        <a href="/Dashboard/Prestations/Add" class="mx-auto text-white addBtn">Ajouter une prestation</a>
    </div>
</div>