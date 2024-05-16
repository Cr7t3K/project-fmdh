<?php
session_start();
require_once __DIR__ . "/config/pdo.php";

$houseQuery = "SELECT * FROM listing WHERE type='house'";
$apartmentQuery = "SELECT * FROM listing WHERE type='apartment'";

$stmt = $pdo->query($houseQuery);
$houses = $stmt->fetchAll();

$stmt = $pdo->query($apartmentQuery);
$apartments = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Annonces Immobilières</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://kit.fontawesome.com/8a0ae65aed.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-gray-100">
        <?php require_once 'src/_partials/_header.php' ?>
        <?php
        if (!empty($_SESSION['success'])) {
            include 'src/_partials/listings/_modal-success.php';
            unset($_SESSION['success']);
        }
        if (!empty($_SESSION['errors'])) {
            include 'src/_partials/listings/_modal-errors.php';
            unset($_SESSION['errors']);
        }
        ?>

        <main class="container mx-auto px-6 py-8">
            <h1 class="text-2xl font-semibold text-gray-900 mb-1">Nos annonces de maisons</h1>
            <hr class="h-px mb-8 bg-gray-300 border-0 dark:bg-gray-700">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                    foreach ($houses as $property) {
                        require 'src/_partials/listings/_card.php';
                    }
                ?>
            </div>

            <h1 class="text-2xl font-semibold text-gray-900 mb-1 mt-20">Nos annonces d'appartements</h1>
            <hr class="h-px mb-8 bg-gray-300 border-0 dark:bg-gray-700">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                foreach ($apartments as $property) {
                    require 'src/_partials/listings/_card.php';
                }
                ?>
            </div>
        </main>

        <?php require_once 'src/_partials/_footer.php' ?>
    </body>
    <script>
        let menuContainers = document.querySelectorAll('.menu-container');

        menuContainers.forEach((e) => {
            const optionsBtn = e.querySelector('.optionsBtn');
            const optionsMenu = e.querySelector('.optionsMenu');

            optionsBtn.addEventListener('click', () => {
                optionsMenu.classList.toggle('hidden');
            });

            // Close options menu when clicking outside
            document.addEventListener('click', (event) => {
                if (!optionsMenu.contains(event.target) && !optionsBtn.contains(event.target)) {
                    optionsMenu.classList.add('hidden');
                }
            });
        })
    </script>
</html>
