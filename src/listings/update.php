<?php
session_start();
require_once __DIR__ . '/../../config/pdo.php';

if (!isset($_SESSION['isLoggedIn'])) {
    header('Location: /src/security/login.php');
    exit();
}

function cleanInput($data) {
    $data = trim($data); // Supprime les espaces inutiles
    $data = htmlspecialchars($data); // Convertit les caractères spéciaux en entités HTML
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && !empty($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM listing WHERE id=:id");
    $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();

    $property = $stmt->fetch();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];

    $title = cleanInput($_POST['title'] ?? '');
    $propertyType = cleanInput($_POST['property_type'] ?? '');
    $price = cleanInput($_POST['price'] ?? 0);
    $location = cleanInput($_POST['location'] ?? '');
    $transaction = cleanInput($_POST['transaction'] ?? '');
    $description = cleanInput($_POST['description'] ?? '');
    $image = $_FILES['image'] ?? '';

    if (empty($title)) {
        $errors['title'] = "The title is required.";
    }

    if (empty($propertyType)) {
        $errors['property_type'] = "Type of property required.";
    }

    if (empty($price)) {
        $errors['price'] = "Price is required.";
    } elseif (!is_numeric($price) || $price < 0) {
        $errors['price'] = "The price must be a positive number.";
    }

    if (empty($location)) {
        $errors['location'] = "Location is required.";
    }

    if (empty($transaction) || $transaction !== 'rent' && $transaction !== 'sale') {
        $errors['transaction'] = "The type of contract is required.";
    }

    if (empty($description)) {
        $errors['description'] = "Description is required.";
    }

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
        $allowed = ["jpg" => "image/jpeg", "jpeg" => "image/jpeg", "png" => "image/png"];
        $filename = $_FILES["image"]["name"];
        $filetype = $_FILES["image"]["type"];
        $filesize = $_FILES["image"]["size"];
        $ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $destination = "/uploads/" . uniqid('listing') . ".{$ext}";

        // 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize) {
            $errors['image'][] = "The file size exceeds the authorized limit. (5MB)";
        }

        if (in_array($filetype, $allowed)) {
            if (empty($errors)) {
                if (!is_dir(__DIR__ . "/../../uploads")) {
                    mkdir(__DIR__ . "/../../uploads", 0777, true); // true for recursive create
                }
                if (!move_uploaded_file($_FILES["image"]["tmp_name"], __DIR__ . "/../..{$destination}")) {
                    $errors['image'][] = "Error, please start again!";
                }
            }
        } else {
            $errors['image'][] = "Please select a valid file format.";
        }
    }

    if (empty($errors)) {
        $query = "UPDATE listing SET title=:title, price=:price, city=:city, img=:img, description=:description, transaction=:transaction, type=:type WHERE id=:id";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':price', $price, PDO::PARAM_INT);
        $stmt->bindValue(':city', $location, PDO::PARAM_STR);
        $stmt->bindValue(':img', $destination ?? $_POST['baseImg'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
        $stmt->bindValue(':transaction', $transaction, PDO::PARAM_STR);
        $stmt->bindValue(':type', $propertyType, PDO::PARAM_STR);
        $stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);

        $stmt->execute();

        $_SESSION['success'] = "Votre annonce a été mise a jour avec succès !";

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
