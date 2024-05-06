<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <style>
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
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="../index_admin.php">Tableau de bord</a></li>
                <li><a href="../index.php.php">Accueil</a></li>
                <li><a href="historiqueAdmin.php">Historique</a></li>
                <li><a href="contactAdmin.php">Contact</a></li>
                <li><a href="../connexion.html">Déconnexion</a></li>
            </ul>
        </div>

        <!-- Contenu principal -->
        <div class="content">
            <h1>Contact</h1>
            <p>Vous pouvez nous contacter à l'aide des informations suivantes :</p>
            <ul>
                <li>Email: contact@example.com</li>
                <li>Téléphone: +123456789</li>
                <li>Adresse: 123 Rue de l'Exemple, Ville, Pays</li>
            </ul>
        </div>
    </div>
</body>
</html>
