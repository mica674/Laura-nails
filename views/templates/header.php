<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="/public/assets/img/icones/logoSite/lauraNailsFavicon.png" type="image/x-icon">
    <!-- Link to BOOTSTRAP MIN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Link to header.css, footer.css, 'special'.css & mediaQueries -->
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
    <link rel="stylesheet" href="/public/assets/css/main.css">
    <?php echo (empty($linkCss) ? '' : "<link rel=\"stylesheet\" href=\"/public/assets/css/$linkCss.css\">") ?> <!-- Si '$linkCss' existe et qu'il n'est pas vide, je link le css initialisé dans le controller correspondant à la page en cours -->
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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0 ms-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/Prestations">Prestations</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="/Lieux_et_horaires">Lieux et horaires</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="/Rendez_vous">Rendez-vous</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Avis">Avis</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Contact">Contact</a>
                        </li>
                        <?php
                        if ($clientConnected && !$adminConnected) {
                        ?>
                                <li class="d-flex justify-content-center mx-lg-2">
                                    <a class="loginButton d-flex align-items-center" href="/Deconnexion">Déconnexion</a>
                                </li>
                                <li class="d-flex justify-content-center mx-lg-2">
                                    <a class="loginButton d-flex align-items-center border-0" href="/Profil"><i class="fa-regular fa-user"></i></a>
                                </li>
                                <?php
                            } elseif($clientConnected && $adminConnected) { ?>
                                <li class="d-flex justify-content-center me-lg-2">
                                    <a class="loginButton d-flex align-items-center" href="/Dashboard">Dashboard</a>
                                </li>
                                <li class="d-flex justify-content-center mx-lg-2">
                                    <a class="loginButton d-flex align-items-center" href="/Deconnexion">Déconnexion</a>
                                </li>
                            <?php 
                        } else { ?>
                            <li class="d-flex justify-content-center mx-lg-2">
                                <a class="loginButton d-flex align-items-center" href="/Inscription">Inscription</a>
                            </li>
                            <li class="d-flex justify-content-center me-lg-2">
                                <a class="loginButton d-flex align-items-center" href="/Connexion">Connexion</a>
                            </li>
                        <?php  } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- NAVBAR end -->
    </header>
    <!-- HEADER end -->