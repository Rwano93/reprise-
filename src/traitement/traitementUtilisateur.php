<?php

include '../controleur/UtilisateurControlleur.php';
include '../model/Utilisateur.php';
include '../bdd/SQLConnexion.php';

$controlleur = new UtilisateurControlleur();


if(isset($_POST["inscription"])) { 
    $user = new Utilisateur($_POST); 
    $success = $controlleur->inscription($user);
    if($success) {
        header('Location: ../../vue/index.php');
        exit();
    } else {
        header('Location: ../../vue/inscription.html');
        exit();
    }
}

if(isset($_POST["connexion"])) {
    $user = new Utilisateur($_POST);
    $success = $controlleur->connexion($user);
    if($success) {
        session_start();
        $_SESSION['id_user'] = $user->getId_user();

        $userId = $_SESSION['id_user']; 
        $userRole = getUserRoleFromDatabase($userId); 
        
        if($userRole === 'Administrateur') {
            header('Location: ../../vue/index_admin.php');
            exit();
        } else {
            header('Location: ../../vue/index.php');
            exit();
        }
    } else {
        
        header('Location: ../../vue/connexion.html');
        exit();
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
    return $result['libelle'];
}


