<?php
session_start();
require_once __DIR__ . '/../../config/pdo.php';


if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
    header('Location: /index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm-password'] ?? '';

    if ($password === $confirmPassword) {
        $query = "SELECT * FROM user WHERE email=:email";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch();

        if (!$user) {
            $query = "INSERT INTO user (email, role, password) VALUES (:email, 'ADMIN', :password)";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':password', $password, PDO::PARAM_STR);
            $stmt->execute();

            $_SESSION['email'] = $email;
            $_SESSION['isLoggedIn'] = true;
            session_regenerate_id(true);

            header("Location: /index.php");
            exit;
        }
        $error = "Un compte est déjà associé à cet email.";
    } else {
        $error = "Les mots de passe ne correspondent pas !";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<!-- Registration Form -->
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm">
    <form method="POST">
        <h2 class="mb-6 text-xl font-bold text-center text-gray-700">Inscription</h2>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" id="email" name="email" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Mot de passe</label>
            <input type="password" id="password" name="password" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="confirm-password" class="block text-gray-700 text-sm font-bold mb-2">Confirmer le mot de passe</label>
            <input type="password" id="confirm-password" name="confirm-password" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <?php if (!empty($error)): ?>
            <p class="text-red-500 text-xs italic"><?= $error; ?></p>
        <?php endif; ?>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-6" type="submit">
                S'inscrire
            </button>
        </div>
    </form>
</div>

</body>
</html>
