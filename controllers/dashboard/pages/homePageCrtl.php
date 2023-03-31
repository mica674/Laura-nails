<?php

// !INIT
require_once(__DIR__ . '/../../../config/initDashboard.php');

var_dump($_FILES['carouselImage'] ?? '');
try {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (!isset($_FILES['carouselImage'])) {
            throw new Exception("Erreur général");
        }
        $carouselNumber = 1;
        foreach ($_FILES['carouselImage']['name'] as $key => $value) {
            if ($_FILES['carouselImage']['error'][$key] == 4) {
                throw new Exception("La photo dans chaque case est obligatoire");
            }
            if ($_FILES['carouselImage']['error'][$key] > 0) {
                throw new Exception("Une autre erreur de transfert est survenue");
            }

            if (!in_array($_FILES['carouselImage']['type'][$key], IMAGE_EXTENSIONS)) {
                throw new Exception("Le type de l'image n'est pas autorisée (jpg ou png");
            }

            if ($_FILES['carouselImage']['size'][$key] > MAX_SIZE_FILE) {
                throw new Exception("La taille de l'image est trop supérieure à limite autorisée (5Mo)");
            }
            $extension = pathinfo($_FILES['carouselImage']['name'][$key], PATHINFO_EXTENSION); //Extension du fichier uploadé
            $from = $_FILES['carouselImage']['tmp_name'][$key]; //Chemin où est stocké temporairement le fichier uploadé
            $to = LOCATION_CAROUSEL . 'carousel' . $carouselNumber . '.' . $extension;
            move_uploaded_file($from, $to);


            // imagecopyresampled();
            
            
            // Scaled/Redimensionnement en fonction de l'extension de l'image
            if ($extension == 'png') {//PNG
                $gd_carousel = imagecreatefrompng($to);
            } elseif ($extension == 'jpeg' || $extension == 'jpg') {//JPEG
                $gd_carousel = imagecreatefromjpeg($to);
            }

                // Dimensions de l'image originale
                $width_original = imagesx($gd_carousel);
                $height_original = imagesy($gd_carousel);
    
                // Comparaison hauteur et largeur pour savoir si c'est portrait ou paysage
                $isPortrait = ($width_original > $height_original) ? true : false;
    
                // Nouvelle dimensions pour le redimensionnement
                if ($isPortrait) {
                    $width_scaled = 300;
                    $height_scaled = -1;
                } else {
                    $height_scaled = 300;
                    $width_scaled = round(($width_original/$height_original)*$height_scaled);
                }
                $gd_scaled = imagescale($gd_carousel, $width_scaled, $height_scaled, IMG_BICUBIC);
                $toScaled = LOCATION_CAROUSEL . 'carousel' . $carouselNumber . '_scaled.' . $extension;

                if ($extension == 'png') {//PNG
                    imagepng($gd_scaled, $toScaled);
                } elseif ($extension == 'jpeg' || $extension == 'jpg') {//JPEG
                    imagejpeg($gd_scaled, $toScaled);
                }

            $width_scaled = imagesx($gd_scaled);
            $height_scaled = imagesy($gd_scaled);

            if ($isPortrait) {
                // Portrait
                $x_cropped = 0;
                $x_cropped_wanted = $height_scaled;
                $y_cropped = round((imagesy($gd_scaled) - $y_cropped_wanted) / 2);
                $y_cropped_wanted = 300;
                
            } else {
                //Paysage
                $x_cropped_wanted = 300;
                $x_cropped = round((imagesx($gd_scaled) - $x_cropped_wanted) / 2);
                $y_cropped = 0;
                $y_cropped_wanted = $width_scaled;
            }

            $gd_cropped = imagecrop($gd_scaled, ['x' => $x_cropped, 'y' => $y_cropped, 'width' => $x_cropped_wanted, 'height' => $y_cropped_wanted]);
            $toCropped = LOCATION_CAROUSEL . 'carousel'. $carouselNumber . '_cropped.' . $extension;
            
            if ($extension == 'png') {//PNG
                imagepng($gd_cropped, $toCropped);
            } elseif ($extension == 'jpeg' || $extension == 'jpg') {//JPEG
                imagejpeg($gd_cropped, $toCropped);
            }
            
            $carouselNumber++;
        }
    }
} catch (\Throwable $th) {
    include(__DIR__ . '/../../../views/dashboard/templates/header.php');
    include(__DIR__ . '/../../../views/templates/errors.php');
    include(__DIR__ . '/../../../views/dashboard/templates/footer.php');
    die;
}


if (isset($_FILES['carouselImage'])) {
    $images = $_FILES['carouselImage']['full_path'];
}


// HEADER
$linkCss = 'pages/homePage';
include_once(__DIR__ . '/../../../views/dashboard/templates/header.php');

// VIEW
include_once(__DIR__ . '/../../../views/dashboard/pages/homePage.php');

// FOOTER
$jsToCall = 'homePage';
include_once(__DIR__ . '/../../../views/dashboard/templates/footer.php');
