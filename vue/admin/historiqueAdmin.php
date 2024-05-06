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
    <title>Historique des événements</title>
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
            margin-left: 250px;
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
            transition: transform 0.3s ease-in-out;
        }
        .event:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .event h2 {
            margin-top: 0;
            color: #666;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .event p {
            margin: 5px 0;
            font-size: 14px;
            color: #444;
        }
        .event-details {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="../index_admin.php">Tableau de bord</a></li>
                <li><a href="../index.php">Accueil</a></li>
                <li><a href="contactAdmin.php">Contact</a></li>
                <li><a href="historiqueAdmin.php">Historique d'événements</a></li>
                <li><a href="../connexion.html">Déconnexion</a></li>
            </ul>
        </div>

        <!-- Contenu principal -->
        <div class="content">
            <h1>Historique des Événements</h1>
            
            <?php
                // Inclure la classe de connexion à la base de données
                require_once '../src/bdd/SQLConnexion.php';

                // Instancier la connexion à la base de données
                $connexion = new SQLConnexion();

                // Récupérer les événements depuis la base de données
                $stmt = $connexion->bdd()->query("SELECT * FROM evenements ORDER BY titre");
                $evenements = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Vérifier s'il y a des événements
                if ($evenements) {
                    foreach ($evenements as $evenement) {
                        echo '<div class="event">';
                        echo '<div class="event-details">';
                        echo '<h2>' . $evenement['titre'] . '</h2>';
                        echo '<p>Description: ' . $evenement['description'] . '</p>';
                        echo '<p>Date: ' . $evenement['date'] . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Aucun événement trouvé.</p>';
                }
            ?>
        </div>
    </div>
</body>
</html>
