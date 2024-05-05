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
    <title>Accueil</title>
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
<div class="popup" id="popup">
        <h3>Confirmation</h3>
        <p><?php echo $message; ?></p>
        <button onclick="closePopup()">Fermer</button>
    </div>
    <div class="overlay" id="overlay"></div>
        <div class="container">
            
            <div class="sidebar">
                <h2>Menu</h2>
                <ul>
                    <li><a href="index.php">Evenements</a></li>
                    <li><a href="Historique.php">Historique d'événements</a></li>
                    <li><a href="connexion.html">Déconnexion</a></li>
                </ul>
            </div>

            <!-- Contenu principal -->
            <div class="content">
                <h1>Événements</h1>
                
                <!-- Affichage des événements depuis la base de données -->
                <?php foreach ($evenements as $evenement): ?>
                <div class="event">
                    <!-- Détails de l'événement -->
                    <div class="event-details">
                        <h2><?php echo $evenement['titre']; ?></h2>
                        <p><?php echo $evenement['description']; ?></p>
                        <p>Date: <?php echo $evenement['date']; ?></p>
                        <button onclick="openPopup('inscriptionPopup')">Inscription</button>
                    </div>
                    <!-- Image de l'événement -->
                    <div class="event-image">
                        <img src="<?php echo $evenement['image']; ?>" alt="Image de l'événement">
                    </div>
                </div>
                <?php endforeach; ?>

                <!-- Formulaire d'inscription dans un pop-up -->
                <div id="inscriptionPopup" class="popup" style="display: none;">
                    <div class="popup-content">
                        <h2>S'inscrire à un événement</h2>
                        <form action="#" method="post">
                            <label for="name">Nom:</label>
                            <input type="text" id="name" name="name" required>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                            <label for="event">Choisir un événement:</label>
                            <select id="event" name="event" required>
                                <?php foreach ($evenements as $evenement): ?>
                                <option value="<?php echo $evenement['id_evenements']; ?>"><?php echo $evenement['titre']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="submit" value="S'inscrire">
                        </form>
                        <button onclick="closePopup('inscriptionPopup')">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function openPopup() {
            document.getElementById("popup").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        function closePopup() {
            document.getElementById("popup").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }

        window.onload = function() {
            var message = "<?php echo $message; ?>";
            if (message !== "") {
                openPopup();
            }
        };
    </script>
</body>
</html>
