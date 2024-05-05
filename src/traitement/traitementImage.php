<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reprise_projet";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

// Traitement du téléchargement de l'image
if (isset($_FILES['image'])) {
    if ($_FILES['image']['error'] == 0) {
        $target_dir = 'uploads/';
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $imagePath = $target_dir . $_FILES['image']['name'];
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            echo "Le fichier " . basename($_FILES["image"]["name"]) . " a été téléchargé.";
        } else {
            echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
        }
    } else {
        echo "Erreur lors du téléchargement de l'image. Code d'erreur : " . $_FILES['image']['error'];
    }
}

// Récupération des autres données du formulaire
$titre = $_POST['titre'];
$date = $_POST['date'];
$description = $_POST['description'];

// Insertion des données dans la base de données
$stmt = $pdo->prepare("INSERT INTO evenements (titre, date, description, image) VALUES (?, ?, ?, ?)");
$stmt->execute([$titre, $date, $description, $imagePath]);
echo 'Événement ajouté avec succès !';
?>
