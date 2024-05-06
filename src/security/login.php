<?php
session_start();
require_once __DIR__ . '/../../config/pdo.php';

if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
    header('Location: /index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $query = "SELECT * FROM user WHERE email=:email AND password=:password";
    $stmt = $pdo->prepare($query);

    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch();

    if ($result && $result['isActive']) {
        $_SESSION['email'] = $email;
        $_SESSION['isLoggedIn'] = true;

        header("Location: /index.php");
        exit;
    } else {
        $error = "Identifiants incorrects!";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<!-- Login Form -->
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm">
    <form method="POST">
        <h2 class="mb-6 text-xl font-bold text-center text-gray-700">Login</h2>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" id="email" name="email" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-6">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input type="password" id="password" name="password" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <?php if (!empty($error)): ?>
            <p class="text-red-500 text-xs italic"><?= $error; ?></p>
        <?php endif; ?>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Login
            </button>
            <!--  <a href="#" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">  -->
            <!--    Mot de passe oublié?    -->
            <!--  </a>  -->
        </div>
    </form>
</div>

</body>
</html>
