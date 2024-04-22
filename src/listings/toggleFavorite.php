<?php
session_start();

// Vérifier si l'utilisateur est connecté, si la requête est de type GET, et si un paramètre 'id' est présent dans l'URL
if (!empty($_SESSION['isLoggedIn']) && $_SERVER['REQUEST_METHOD'] === "GET" && !empty($_GET['id'])) {
    // Récupérer l'identifiant 'id' à partir des paramètres GET
    $id = $_GET['id'];

    // Accéder a la valeur 'favorite' de l'annonce avec sa position('$id') dans le tableau en session
    $listingFavorite = $_SESSION['listings'][$id]['favorite'];

    // Basculer le statut 'favorite' de l'annonce
    $_SESSION['listings'][$id]['favorite'] = !$listingFavorite;

    // Rediriger l'utilisateur vers la page d'accueil après la mise à jour
    header("Location: /index.php");
    exit();
} else {
    header("Location: /index.php");
}
