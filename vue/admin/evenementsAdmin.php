<?php
    // Inclure la classe de connexion à la base de données
    require_once '../../src/bdd/SQLConnexion.php';

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
        /* Votre CSS ici */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 50;
            background-color: #f5f5f5;
        }
        .container {
            display: flex;
        }
        .sidebar {
            width: 250px;
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
            width: 300px;
        }
        .sidebar h2 {
            margin-top: 0;
            text-align: center;
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
            margin: 0 auto;
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
            transition: transform 0.3s;
        }
        .event:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
            text-align: center; /* Centre les informations */
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
            transition: background-color 0.3s;
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
            transition: background-color 0.3s;
        }
        .popup-content button:hover {
            background-color: #0056b3;
        }
        
        
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #0056b3;
        }
        
        .places-restantes {
            color: green;
        }

        .places-restantes-full {
            color: red;
        }

    </style>
</head>
<body>
    <div id="overlay" class="popup" style="display: none;"></div>
    <div id="inscriptionPopup" class="popup" style="display: none;">
        
    </div>  

    <div class="container">
        <div class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="../index_admin.php">Tableau de bord</a></li>
                <li><a href="../index.php">Accueil</a></li>
                <li><a href="historiqueAdmin.php">Historique</a></li>
                <li><a href="contactAdmin.php">Contact</a></li>
                <li><a href="../connexion.html">Déconnexion</a></li>
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
                    <?php
                        // Calcul du compte à rebours
                        $dateEvenement = new DateTime($evenement['date']);
                        $maintenant = new DateTime();
                        $diff = $dateEvenement->diff($maintenant);
                        $joursRestants = $diff->format('%a');
                        
                        // Récupérer le nombre de places réservées pour cet événement
                        $stmt = $connexion->bdd()->prepare("SELECT COUNT(*) AS total FROM reserver WHERE ref_evenements = ?");
                        $stmt->execute([$evenement['id_evenements']]);
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $placesReservees = $row['total'];
                        
                        // Calculer le nombre de places restantes
                        $placesRestantes = $evenement['nb_places'] - $placesReservees;
                    ?>
                    <p>Places restantes: <?php echo $placesRestantes; ?></p>
                    <p>Jours restants: <?php echo $joursRestants; ?></p>
                    <button class="button" onclick="openPopup('inscriptionPopup')">Inscription</button>
                </div>
                <!-- Image de l'événement -->
                <div class="event-image">
                    <img src="<?php echo $evenement['image']; ?>" alt="Image de l'événement">
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        function openPopup(popupId) {
            var popup = document.getElementById(popupId);
            popup.style.display = "flex";
        }

        
        function closePopup(popupId) {
            var popup = document.getElementById(popupId);
            popup.style.display = "none";
        }

        
        var buttons = document.querySelectorAll(".inscriptionButton");

        
        buttons.forEach(function(button) {
            button.addEventListener("click", function() {
                openPopup("inscriptionPopup");
            });
        });

        
        document.getElementById("closeButton").addEventListener("click", function() {
            closePopup("inscriptionPopup");
        });
    </script>
</body>
</html>
