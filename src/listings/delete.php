<?php
session_start();
require_once __DIR__ . '/../../config/pdo.php';

if (!empty($_SESSION['isLoggedIn']) && $_SERVER['REQUEST_METHOD'] === "GET" && !empty($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM listing WHERE id=:id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $listing = $stmt->fetch();

    if (!empty($listing) && $_SESSION['id'] === $listing['user_id']) {
        $stmt = $pdo->prepare("DELETE FROM listing WHERE id=:id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['success'] = "Votre annonce a bien été supprimée !";
    } else {
        $_SESSION['errors'] = "Vous n'avez pas l'autorisation d'effectuer cette action.";
    }

    header("Location: /index.php");
    exit();
} else {
    header("Location: /index.php");
}
