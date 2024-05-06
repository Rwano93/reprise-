<?php

include '../controleur/UtilisateurControlleur.php';
include '../model/Utilisateur.php';
include '../bdd/SQLConnexion.php';

$controlleur = new UtilisateurControlleur();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["inscription"])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $motDePasse = $_POST['mdp'];
    $ref_role = 1; 
    if ($controlleur->inscription($nom, $prenom, $email, $motDePasse, $ref_role)) {
        header('Location: ../../vue/connexion.html');
        exit();
    } else {
        echo 'Erreur lors de l\'inscription';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["connexion"])) {
    $email = $_POST['email'];
    $password = $_POST['mdp'];
    $user = $controlleur->connexion($email, $mdp);
    if ($user) {
        session_start();
        $_SESSION['id_user'] = $user['id_user'];
        $role = $user['ref_role'];
        if ($role === 2) {
            header('Location: ../../vue/index_admin.php');
            exit();
        } else {
            header('Location: ../../vue/index.php');
            exit();
        }
    } else {
        echo 'Email ou mot de passe invalide';
    }
}

if(isset($_POST["deconnexion"])) { 
    $controlleur->deconnexion();
    header('Location: ../../vue/connexion.html');
    exit();
}

function getUserRoleFromDatabase($userId) {
    $connexion = new SQLConnexion(); 
    $stmt = $connexion->bdd()->prepare('SELECT r.libelle FROM role r JOIN user u ON r.id_role = u.ref_role WHERE u.id_user = :id');
    $stmt->execute(['id' => $userId]);
    $result = $stmt->fetch();
    return $result['libelle'] === '2' ? 'Administrateur' : 'Utilisateur';
}
