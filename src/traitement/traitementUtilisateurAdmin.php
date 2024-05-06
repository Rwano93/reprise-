<?php


require_once '../bdd/SQLConnexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

    $action = $_POST['action'];
    $id = $_POST['id_user'];

    switch ($action) {
        case 'Ajouter': 
            ajouterUtilisateur(); 
            break;
        case 'Modifier':
            modifierUtilisateur();
            break;
        case 'Supprimer':
            supprimerUtilisateur();
            break;
        default:
            break;
    }
}

function ajouterUtilisateur() {
 
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp']; 

    try {
   
        $connexion = new SQLConnexion();
        
 
        $stmt = $connexion->bdd()->prepare('INSERT INTO user (nom, email, mdp) VALUES (:nom, :email, :mdp)');
        
      
        $stmt->execute(['nom' => $nom, 'email' => $email, 'mdp' => $mdp]); 

       
        header('Location: ../../vue/indexAdmin.php');
        exit();
    } catch (PDOException $e) {
       
        echo "Erreur PDO: " . $e->getMessage();
    }
}

function modifierUtilisateur() {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];

    $connexion = new SQLConnexion();
    $stmt = $connexion->bdd()->prepare('UPDATE user SET nom = :nom, email = :email WHERE id_user = :id');
    $stmt->execute(['nom' => $nom, 'email' => $email, 'id' => $id]);

    header('Location: ../../vue/admin/modifierUserAdmin.php');
    exit();
}

function supprimerUtilisateur() {
    $id = $_POST['id'];

    $connexion = new SQLConnexion();
    $stmt = $connexion->bdd()->prepare('DELETE FROM user WHERE id_user = :id');
    $stmt->execute(['id' => $id]);

    header('Location: ../../vue/admin/modifierUser.php');
    exit();
}

