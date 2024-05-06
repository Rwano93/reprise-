<?php
include '../../src/bdd/SQLConnexion.php';

$connexion = new SQLConnexion();
$bdd = $connexion->bdd();

$stmt = $bdd->query('SELECT * FROM user');
$utilisateurs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration Utilisateurs</title>
    <style>
        /* Styles pour le corps de la page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Styles pour le conteneur principal */
        .container {
            display: flex;
            width: 100%;
            max-width: 1200px;
            margin-top: 20px;
        }

        /* Styles pour la barre latérale */
        .sidebar {
            width: 250px;
            background-color: #333;
            color: #fff;
            padding: 20px;
            box-sizing: border-box;
            height: 100vh;
            overflow-y: auto;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1;
            transition: width 0.3s;
        }

        .sidebar:hover {
            width: 300px;
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

        /* Styles pour le contenu */
        .content {
            flex: 1;
            margin-left: 250px;
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

        /* Styles pour les pop-ups */
        .popup {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            z-index: 9999;
        }

        .popup-content {
            text-align: center;
        }

        .popup h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .popup form {
            margin-bottom: 20px;
        }

        .popup form input[type="text"],
        .popup form input[type="email"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .popup form input[type="submit"],
        .popup button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .popup form input[type="submit"]:hover,
        .popup button:hover {
            background-color: #0056b3;
        }

        /* Styles pour les boutons Modifier et Supprimer */
        .btn-modifier {
            background-color: #28a745; /* Vert */
        }

        .btn-supprimer {
            background-color: #dc3545; /* Rouge */
        }

        .btn-rounded {
            border-radius: 20px; /* Bordure arrondie */
        }

        /* Style pour le bouton d'ajout */
        .btn-ajouter {
            background-color: #ffc107; /* Jaune */
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h1>Menu</h1>
            <ul>
                <li><a href="../index_admin.php">Tableau de bord</a></li>
                <li><a href="../index.php">Accueil</a></li>
                <li><a href="../admin/modifierUserAdmin.php">Utilisateur</a></li>
                <li><a href="../admin/contactAdmin.php">Contact</a></li>
                <li><a href="../admin/historiqueAdmin.php">Historique d'événements</a></li>
                <li><a href="../connexion.html">Déconnexion</a></li>
            </ul>
        </div>

        <div class="content">
            <h1>Liste des Utilisateurs</h1>
            <button class="btn btn-ajouter btn-rounded" onclick="openPopup('ajouterPopup')">Ajouter un utilisateur</button>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($utilisateurs as $utilisateur): ?>
                        <tr>
                            <td><?php echo $utilisateur['id_user']; ?></td>
                            <td><?php echo $utilisateur['nom']; ?></td>
                            <td><?php echo $utilisateur['email']; ?></td>
                            <td>
                                <button class="btn btn-modifier btn-rounded" onclick="openPopup('modifierPopup<?php echo $utilisateur['id_user']; ?>')">Modifier</button>
                                <button class="btn btn-supprimer btn-rounded" onclick="openPopup('supprimerPopup<?php echo $utilisateur['id_user']; ?>')">Supprimer</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pop-up d'ajout -->
<div id="ajouterPopup" class="popup" style="display: none;">
    <div class="popup-content">
        <h2>Ajouter un Utilisateur</h2>
        <form action="../../src/traitement/traitementUtilisateurAdmin.php" method="POST">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom">
    <label for="email">Email :</label>
    <input type="email" id="email" name="email">
    <label for="mdp">Mot de passe :</label>
    <input type="password" id="mdp" name="mdp" value="motdepassepardefaut">
    <input type="hidden" name="action" value="Ajouter"> 
    <input type="submit" value="Ajouter">
</form>



    <!-- Pop-ups de modification et de suppression -->
    <?php foreach ($utilisateurs as $utilisateur): ?>
        <!-- Pop-up de modification -->
        <div id="modifierPopup<?php echo $utilisateur['id_user']; ?>" class="popup" style="display: none;">
            <div class="popup-content">
                <h2>Modifier Utilisateur</h2>
                <form action="../../src/traitement/traitementUtilisateurAdmin.php" method="POST">
                    <input type="hidden" name="action" value="Modifier">
                    <input type="hidden" name="id" value="<?php echo $utilisateur['id_user']; ?>">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" value="<?php echo $utilisateur['nom']; ?>">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" value="<?php echo $utilisateur['email']; ?>">
                    <input type="submit" value="Modifier">
                </form>
                <button onclick="closePopup('modifierPopup<?php echo $utilisateur['id_user']; ?>')">Fermer</button>
            </div>
        </div>

        <!-- Pop-up de suppression -->
        <div id="supprimerPopup<?php echo $utilisateur['id_user']; ?>" class="popup" style="display: none;">
            <div class="popup-content">
                <h2>Supprimer Utilisateur</h2>
                <p>Êtes-vous sûr de vouloir supprimer cet utilisateur ?</p>
                <form action="../../src/traitement/traitementUtilisateurAdmin.php" method="POST">
                    <input type="hidden" name="action" value="Supprimer">
                    <input type="hidden" name="id" value="<?php echo $utilisateur['id_user']; ?>">
                    <input type="submit" value="Supprimer">
                </form>
                <button onclick="closePopup('supprimerPopup<?php echo $utilisateur['id_user']; ?>')">Annuler</button>
            </div>
        </div>
    <?php endforeach; ?>

    <script>
        function openPopup(popupId) {
            var popup = document.getElementById(popupId);
            popup.style.display = "flex";
        }

        function closePopup(popupId) {
            var popup = document.getElementById(popupId);
            popup.style.display = "none";
        }
    </script>
</body>
</html>
