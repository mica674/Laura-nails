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
    <link rel="stylesheet" href="/public/assets/css/dashboard/header.css">
    <link rel="stylesheet" href="/public/assets/css/dashboard/footer.css">
    <?php echo (empty($linkCss) ? '' : "<link rel=\"stylesheet\" href=\"/public/assets/css/dashboard/$linkCss.css\">") ?> <!-- Si '$linkCss' existe et qu'il n'est pas vide, je link le css initialisé dans le controller correspondant à la page en cours -->
    <link rel="stylesheet" href="/public/assets/css/mediaQueries.css">
    <title>Laura's nails</title>
</head>

<body>
    <!-- HEADER -->
    <header>

        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-3 col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                    <div class="d-flex flex-column align-items-center px-3 pt-2 text-white min-vh-100">
                        <a href="/" class="d-flex align-items-center justify-content-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <img src="/public/assets/img/icones/logoSite/lauraNailsFavicon.png" alt="Logo site" class="d-sm-none mt-2" id="siteLogoHeader">
                            <span class="fs-5 d-none d-sm-inline">
                                <h1>Laura's nails</h1>
                            </span>
                        </a>
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                            <li class="nav-item my-lg-3 mt-lg-5">
                                <a href="/Dashboard" class="nav-link align-middle px-0">
                                    <i class="fa-solid fa-house"></i><span class="ms-1 d-none d-sm-inline">Home</span>
                                </a>
                            </li>
                            <li class="nav-item dropend my-lg-3">
                                <a class="nav-link dropdown-toggle fs-5" data-bs-target="dropdownPages" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-solid fa-book-open"></i>
                                    <span class="ms-1 d-none d-sm-inline">Pages</span>
                                </a>
                                <div class="dropdown-menu ms-5 text-end" id="dropdownPages">
                                    <a class="dropdown-item fs-5 text-danger" href="/Dashboard/Home">Accueil</a>
                                    <a class="dropdown-item fs-5" href="/Dashboard/Prestations">Prestations</a>
                                    <!-- <a class="dropdown-item fs-5 text-danger" href="/Dashboard/PlaceDate">Lieux/horaires</a> -->
                                    <a class="dropdown-item fs-5 text-danger" href="#">Rendez-vous</a>
                                    <a class="dropdown-item fs-5" href="/Dashboard/Reviews/List">Avis</a>
                                    <a class="dropdown-item fs-5 text-danger" href="/Dashboard/Contact">Contact</a>
                                </div>
                            </li>
                            <li class="nav-item dropend my-lg-3">
                                <a class="nav-link dropdown-toggle fs-5" data-bs-target="dropdownClient" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-solid fa-people-group"></i>
                                    <span class="ms-1 d-none d-sm-inline">Clients</span>
                                </a>
                                <div class="dropdown-menu ms-5 text-end" id="dropdownClient">
                                    <a class="dropdown-item fs-5" href="/Dashboard/Clients/Add">Ajouter</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item fs-5" href="/Dashboard/Clients/List">Liste</a>
                                </div>
                            </li>
                            <li class="nav-item dropend my-lg-3">
                                <a class="nav-link dropdown-toggle fs-5" data-bs-target="dropdownAppointment" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-regular fa-calendar-check"></i>
                                    <span class="ms-1 d-none d-sm-inline">Rendez-vous</span>
                                </a>
                                <div class="dropdown-menu text-end" id="dropdownAppointment">
                                    <a class="dropdown-item fs-5" href="/Dashboard/Appointments/Add">Ajouter</a>
                                    <a class="dropdown-item fs-5" href="/Dashboard/Appointments/List">Liste</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item fs-5" href="/Dashboard/Appointments/Slots">Créneaux</a>
                                </div>
                            </li>
                        </ul>
                        <hr>
                        <div class="dropdown pb-4">
                            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="/public/assets/img/avatars/avatar.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                                <span class="d-none d-sm-inline mx-1">Avatar</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                                <!-- <li><a class="dropdown-item" href="#">New project...</a></li> -->
                                <!-- <li><a class="dropdown-item" href="#">Settings</a></li> -->
                                <!-- <li><a class="dropdown-item" href="#">Profile</a></li> -->
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="/Deconnexion">Déconnexion</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-9 py-3 px-0">