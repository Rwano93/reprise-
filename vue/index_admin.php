<?php
// Inclure la classe de connexion à la base de données
require_once '../src/bdd/SQLConnexion.php';

// Instancier la connexion à la base de données
$connexion = new SQLConnexion();

// Récupérer les événements depuis la base de données
$stmt = $connexion->bdd()->query("SELECT * FROM evenements");
$evenements = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration des événements</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            display: flex;
        }
        .sidebar {
            width: 200px;
            background-color: #333;
            color: #fff;
            padding: 20px;
            box-sizing: border-box;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            transition: width 0.3s;
        }
        .sidebar:hover {
            width: 250px;
        }
        .sidebar h2 {
            margin-top: 0;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .sidebar li {
            margin-bottom: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .sidebar li a {
            display: block;
            padding: 10px;
            color: #fff;
            text-decoration: none;
        }
        .sidebar li:hover {
            background-color: #444;
        }
        .content {
            margin-left: 200px;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .event {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            display: flex;
            align-items: center;
        }
        .event h2 {
            margin-top: 0;
            margin-right: 20px;
            color: #666;
        }
        .event img {
            max-width: 100px;
            border-radius: 8px;
        }
        .event-details {
            flex: 1;
        }
        .event-image {
            margin-left: 20px;
        }
        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }
        form label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }
        form input[type="text"],
        form input[type="email"],
        form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .popup-content {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }
        .popup-content h2 {
            margin-top: 0;
            color: #333;
        }
        .popup-content button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        .popup-content button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Administration des événements</h1>

    <!-- Ajout d'un événement -->
    <h2>Ajouter un événement</h2>
    <form action="ajouter_evenement.php" method="post" enctype="multipart/form-data">
        <!-- Champs pour les détails de l'événement -->
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" required><br>
        <label for="date">Date :</label>
        <input type="date" id="date" name="date" required><br>
        <label for="description">Description :</label>
        <input type="text" id="description" name="description" required><br>
        <label for="nb_places">Nombre de places :</label>
        <input type="number" id="nb_places" name="nb_places" required><br>
        <label for="image">Image :</label>
        <input type="file" id="image" name="image" accept="image/*" required><br>
        <input type="submit" value="Ajouter">
    </form>

    <!-- Modification d'un événement -->
    <h2>Modifier un événement</h2>
    <form action="modifier_evenement.php" method="post">
        <!-- Sélection de l'événement à modifier -->
        <label for="modifier_evenement">Choisir un événement à modifier :</label>
        <select id="modifier_evenement" name="id_evenement" required>
            <?php foreach ($evenements as $evenement): ?>
                <option value="<?php echo $evenement['id_evenements']; ?>"><?php echo $evenement['titre']; ?></option>
            <?php endforeach; ?>
        </select>
        <!-- Champs pour les nouveaux détails de l'événement -->
        <label for="nouveau_titre">Nouveau titre :</label>
        <input type="text" id="nouveau_titre" name="nouveau_titre" required><br>
        <label for="nouvelle_date">Nouvelle date :</label>
        <input type="date" id="nouvelle_date" name="nouvelle_date" required><br>
        <label for="nouvelle_description">Nouvelle description :</label>
        <input type="text" id="nouvelle_description" name="nouvelle_description" required><br>
        <label for="nouveau_nb_places">Nouveau nombre de places :</label>
        <input type="number" id="nouveau_nb_places" name="nouveau_nb_places" required><br>
        <label for="nouvelle_image">Nouvelle image :</label>
        <input type="file" id="nouvelle_image" name="nouvelle_image" accept="image/*" required><br>
        <input type="submit" value="Modifier">
    </form>

   
    <h2>Supprimer un événement</h2>
    <form action="supprimer_evenement.php" method="post">
        
        <label for="supprimer_evenement">Choisir un événement à supprimer :</label>
        <select id="supprimer_evenement" name="id_evenement" required>
            <?php foreach ($evenements as $evenement): ?>
                <option value="<?php echo $evenement['id_evenements']; ?>"><?php echo $evenement['titre']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Supprimer">
    </form>
</body>
</html>


