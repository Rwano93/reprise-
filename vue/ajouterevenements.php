<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un événement</title>
</head>
<body>
    <h1>Ajouter un événement</h1>
    <form action="ajouter_evenement.php" method="post" enctype="multipart/form-data">
        <label for="titre">Titre de l'événement :</label>
        <input type="text" id="titre" name="titre" required><br><br>

        <label for="date">Date de l'événement :</label>
        <input type="date" id="date" name="date" required><br><br>

        <label for="description">Description :</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

        <label for="image">Image :</label>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>

        <input type="submit" value="Ajouter l'événement">
    </form>
</body>
</html>
