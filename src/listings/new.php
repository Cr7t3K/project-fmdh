<?php
session_start();

if (!isset($_SESSION['isLoggedIn'])) {
    header('Location: /src/security/login.php');
    exit();
}

function cleanInput($data) {
    $data = trim($data); // Supprime les espaces inutiles
    $data = htmlspecialchars($data); // Convertit les caractères spéciaux en entités HTML
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    $title = cleanInput($_POST['title'] ?? '');
    $price = cleanInput($_POST['price'] ?? 0);
    $location = cleanInput($_POST['location'] ?? '');
    $type = cleanInput($_POST['transaction'] ?? '');
    $description = cleanInput($_POST['description'] ?? '');
    $image = cleanInput($_POST['image'] ?? '');


    if (empty($title)) {
        $errors['title'] = "Le title est requis.";
    }

    if (empty($price)) {
        $errors['price'] = "Le price est requis.";
    } elseif (!is_numeric($price) || $price < 0) {
        $errors['price'] = "Le price doit être un nombre positif.";
    }

    if (empty($location)) {
        $errors['location'] = "La localisation est requise.";
    }

    if (empty($type) || $type !== 'rent' && $type !== 'sale') {
        $errors['type'] = "Le type de bien est requis.";
    }

    if (empty($description)) {
        $errors['description'] = "La description est requise.";
    }

    if (empty($image)) {
        $errors['image'] = "La description est requise.";
    }

    
    if (count($errors) === 0) {
        $_SESSION['listings'][] = [
            'title' => $title,
            'price' => $price,
            'transaction' => $type,
            'city' => $location,
            'favorite' => false,
            'img' => $image,
            'description' => $description
        ];

        $_SESSION['success'] = true;

        header("Location: /index.php");
        exit;
    }

    
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajout d'une Annonce</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://kit.fontawesome.com/8a0ae65aed.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-gray-100">
        <?php require_once '../_partials/_header.php' ?>

        <div class="container mx-auto px-4 py-8">
            <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
                <?php require_once '../_partials/listings/_form.php' ?>
            </div>
        </div>

        <?php require_once '../_partials/_footer.php' ?>
    </body>
</html>
