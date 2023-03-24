<div class="container-fluid">
    <form method="post">
        <fieldset class="m-0"><h1 class="text-center mx-0">Contactez-nous</h1></fieldset>
        <hr id="formHr">
        <div class="row">
            <div class="col-6">
                <div class="d-flex flex-column align-items-center">
                    <label class="ms-4" for="firstname">Prénom</label>
                    <input type="text" name="firstname" id="firstname" class="inputForm rounded" placeholder="Prénom" required value="<?=$firstname??''?>" pattern="<?= REGEXP_FIRSTNAME ?>">
                    <label class="ms-4" for="email">Email</label>
                    <input type="email" name="email" id="email" class="inputForm rounded" placeholder="email" required value="<?=$email??''?>">
                    <label class="ms-4" for="title">Objet du message</label>
                    <input type="text" name="title" id="title" class="inputForm rounded" placeholder="&Eacute;crire l'objet du message ici..." required value="<?=$title??''?>" pattern="<?= REGEXP_TITLE ?>">
                    <label class="ms-4" for="message">Message</label>
                    <input type="text" name="message" id="message" class="inputForm rounded" placeholder="&Eacute;crire votre message ici..." required value="<?=$message??''?>" pattern="<?= REGEXP_MESSAGE ?>">
                    <input type="submit" class="my-2 mx-auto rounded" value="Envoyer le message" id="contactSubmit">
                </div>
            </div>
            <div class="col-6 d-none d-md-block">
                <table class="text-center">
                    <tbody>
                        <tr></tr>
                        <tr class="my-3">
                            <td><i class="fa-solid fa-location-dot"></i></td>
                            <td>Adresse en mettre ici en PHP</td>
                        </tr>
                        <tr></tr>
                        <tr class="my-3">
                            <td><i class="fa-solid fa-phone"></i></td>
                            <td>Numéro de téléphone en PHP aussi</td>
                        </tr>
                        <tr></tr>
                        <tr class="my-3">
                            <td><i class="fa-regular fa-envelope"></i></td>
                            <td>Adresse email ici en PHP bien sur</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>