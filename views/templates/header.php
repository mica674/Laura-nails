<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Link to BOOTSTRAP MIN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

        <!-- Link to header.css, footer.css, 'special'.css & mediaQueries -->
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
    <?php echo (empty($linkCss)?'':"<link rel=\"stylesheet\" href=\"/public/assets/css/$linkCss.css\">") ?> <!-- Si '$linkCss' existe et qu'il n'est pas vide, je link le css initialisé dans le controller correspondant à la page en cours -->
    <link rel="stylesheet" href="/public/assets/css/mediaQueries.css">
    <title>Laura's nails</title>
</head>

<body>
    <!-- HEADER -->
    <header>
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="/index.php">
                    <h1>Laura's nails</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0 ms-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/controllers/prestationsCtrl.php">Prestations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/controllers/placeDateCtrl.php">Lieux et horaires</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/controllers/rendezVousCtrl.php">Rendez-vous</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/controllers#avis">Avis</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/controllers#contact">Contact</a>
                        </li>
                        <li class="nav-item nav-button">
                            <a class="nav-link nav-link-button" href="/controllers/registrerCtrl.php">Inscription</a>
                        </li>
                        <li class="nav-item nav-button">
                            <a class="nav-link nav-link-button" href="/controllers/loginCtrl.php">Connexion</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- NAVBAR end -->
    </header>
    <!-- HEADER end -->