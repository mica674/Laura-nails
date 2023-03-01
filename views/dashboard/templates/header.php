<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="/public/assets/img/icones/logoSite/lauraNailsFavicon.png" type="image/x-icon">
    <!-- Link to BOOTSTRAP MIN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Link to header.css, footer.css, 'special'.css & mediaQueries -->
    <link rel="stylesheet" href="/public/assets/css/dashboard/header.css">
    <link rel="stylesheet" href="/public/assets/css/dashboard/footer.css">
    <?php echo (empty($linkCss) ? '' : "<link rel=\"stylesheet\" href=\"/public/assets/css/$linkCss.css\">") ?> <!-- Si '$linkCss' existe et qu'il n'est pas vide, je link le css initialisé dans le controller correspondant à la page en cours -->
    <link rel="stylesheet" href="/public/assets/css/mediaQueries.css">
    <title>Laura's nails</title>
</head>

<body>
    <!-- HEADER -->
    <header>

        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <span class="fs-5 d-none d-sm-inline">
                                <h1>Laura's nails</h1>
                            </span>
                        </a>
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                            <li class="nav-item my-lg-2">
                                <a href="Dashboard" class="nav-link align-middle px-0">
                                    <i class="fa-solid fa-house"></i><span class="ms-1 d-none d-sm-inline">Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle my-lg-2">
                                    <i class="fa-solid fa-pager"></i> <span class="ms-1 d-none d-sm-inline">Page</span> </a>
                                <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                    <li class="ms-lg-2 w-100">
                                        <a href="#" class="nav-link px-0 my-lg-2"><i class="fa-solid fa-tag"></i> <span class="d-none d-sm-inline">Preatations</span></a>
                                    </li>
                                    <li class="ms-lg-2">
                                        <a href="#" class="nav-link px-0 my-lg-2"><i class="fa-regular fa-clock"></i> <span class="d-none d-sm-inline">Lieux et horaires</span></a>
                                    </li>
                                    <li class="ms-lg-2">
                                        <a href="#" class="nav-link px-0 my-lg-2"><i class="fa-regular fa-calendar-check"></i> <span class="d-none d-sm-inline">Rendez-vous</span></a>
                                    </li>
                                    <li class="ms-lg-2">
                                        <a href="#" class="nav-link px-0 my-lg-2"><i class="fa-solid fa-star-half-stroke"></i> <span class="d-none d-sm-inline">Avis</span></a>
                                    </li>
                                    <li class="ms-lg-2">
                                        <a href="#" class="nav-link px-0 my-lg-2"><i class="fa-regular fa-address-card"></i> <span class="d-none d-sm-inline">Contact</span></a>
                                    </li>

                                </ul>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0 align-middle">
                                <i class="fa-solid fa-people-group"></i> <span class="ms-1 d-none d-sm-inline">Clients</span></a>
                            </li>
                            <!-- <li>
                                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                    <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Bootstrap</span></a>
                                <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                    <li class="w-100">
                                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1</a>
                                    </li>
                                    <li>
                                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
                                <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                    <li class="w-100">
                                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 1</a>
                                    </li>
                                    <li>
                                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 2</a>
                                    </li>
                                    <li>
                                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 3</a>
                                    </li>
                                    <li>
                                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 4</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0 align-middle">
                                <i class="fa-solid fa-people-group"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
                            </li> -->
                        </ul>
                        <hr>
                        <div class="dropdown pb-4">
                            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="/public/assets/img/avatars/avatar.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                                <span class="d-none d-sm-inline mx-1">Avatar</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                                <li><a class="dropdown-item" href="#">New project...</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Sign out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col py-3 px-0">