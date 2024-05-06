<?php

include '../src/bdd/SQLConnexion.php';

$connexion = new SQLConnexion();
$bdd = $connexion->bdd(); 

$query = "SELECT id_evenements, titre FROM evenements";
$stmt = $bdd->query($query);
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
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            display: flex;
            width: 100%;
            max-width: 1200px;
            margin-top: 20px;
        }

        .sidebar {
            width: 250px;
            background-color: #333;
            color: #fff;
            padding: 20px;
            box-sizing: border-box;
            height: 100vh; /* Hauteur de la fenêtre */
            overflow-y: auto;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1; /* Pour s'assurer que la sidebar est au-dessus du contenu */
            transition: width 0.3s; /* Animation de transition */
        }

        .sidebar:hover {
            width: 300px; /* Largeur augmentée au survol */
        }

        .sidebar h1 {
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
            color: #fff;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar li {
            margin-bottom: 10px;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #555;
        }

        .content {
            flex: 1;
            margin-left: 250px; /* Marge pour compenser la largeur de la sidebar */
            padding: 20px;
        }

        h1 {
            color: #333;
            margin-top: 20px;
        }

        .section {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        h2 {
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="number"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h1>Menu</h1>
            <ul>
                <li><a href="index_admin.php">Tableau de bord</a></li>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="../vue/admin/modifierUserAdmin">Utilisateur</a></li>
                <li><a href="../vue/admin/contactAdmin.php">Contact</a></li>
                <li><a href="../vue/admin/historiqueAdmin.php">Historique d'événements</a></li>
                <li><a href="connexion.html">Déconnexion</a></li>
            </ul>
        </div>

        <div class="content">
            <h1>Administration des événements</h1>

            <div class="section">
                <h2>Ajouter un événement</h2>
                <form action="../src/traitement/traitementEvenement.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="titre">Titre :</label>
                        <input type="text" id="titre" name="titre" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date :</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description :</label>
                        <input type="text" id="description" name="description" required>
                    </div>
                    <div class="form-group">
                        <label for="nb_places">Nombre de places :</label>
                        <input type="number" id="nb_places" name="nb_places" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image :</label>
                        <input type="file" id="image" name="image" accept="image/*" required>
                    </div>
                    <button type="submit" name="Ajouter" class="btn">Ajouter</button>
                </form>
            </div>

            <div class="section">
                <h2>Modifier un événement</h2>
                <form action="../src/traitement/traitementEvenement.php" method="post">
                    <div class="form-group">
                        <label for="Modifier">Choisir un événement à modifier :</label>
                        <select id="Modifier" name="id_evenement" required>
                            <?php foreach ($evenements as $evenement): ?>
                                <option value="<?php echo $evenement['id_evenements']; ?>"><?php echo $evenement['titre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nouveau_titre">Nouveau titre :</label>
                        <input type="text" id="nouveau_titre" name="nouveau_titre" required>
                    </div>
                    <div class="form-group">
                        <label for="nouvelle_date">Nouvelle date :</label>
                        <input type="date" id="nouvelle_date" name="nouvelle_date" required>
                    </div>
                    <div class="form-group">
                        <label for="nouvelle_description">Nouvelle description :</label>
                        <input type="text" id="nouvelle_description" name="nouvelle_description" required>
                    </div>
                    <div class="form-group">
                        <label for="nouveau_nb_places">Nouveau nombre de places :</label>
                        <input type="number" id="nouveau_nb_places" name="nouveau_nb_places" required>
                    </div>
                    <div class="form-group">
                        <label for="nouvelle_image">Nouvelle image :</label>
                        <input type="file" id="nouvelle_image" name="nouvelle_image" accept="image/*" required>
                    </div>
                    <button type="submit" name="Modifier" class="btn">Modifier</button>
                </form>
            </div>

            <div class="section">
                <h2>Supprimer un événement</h2>
                <form action="../src/traitement/traitementEvenement.php" method="post">
                    <div class="form-group">
                        <label for="Supprimer">Choisir un événement à supprimer :</label>
                        <select id="Supprimer" name="id_evenement" required>
                            <?php foreach ($evenements as $evenement): ?>
                                <option value="<?php echo $evenement['id_evenements']; ?>"><?php echo $evenement['titre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" name="Supprimer" class="btn">Supprimer</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        
    </script>
</body>
</html>
