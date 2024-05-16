<?php
session_start();
require_once __DIR__ . '/../../config/pdo.php';

// Vérifier si l'utilisateur est connecté, si la requête est de type GET, et si un paramètre 'id' est présent dans l'URL
if (!empty($_SESSION['isLoggedIn']) && $_SERVER['REQUEST_METHOD'] === "GET" && !empty($_GET['id'])) {
    // Récupérer l'identifiant 'id' à partir des paramètres GET
    $id = $_GET['id'];

    $query = "SELECT * FROM listing WHERE id=:id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $listing = $stmt->fetch();

    if (!empty($listing)) {
        $query = "UPDATE listing SET isfavorite=:favorite WHERE id={$listing['id']}";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':favorite', !$listing['isfavorite'], PDO::PARAM_BOOL);
        $success = $stmt->execute();
    }

    if (empty($listing) || isset($success) && !$success){
        $_SESSION['errors'] = "Problème lors de la modification de l'annonce";
    }


    // Rediriger l'utilisateur vers la page d'accueil après la mise à jour
    header("Location: /index.php");
    exit();
} else {
    header("Location: /index.php");
}
