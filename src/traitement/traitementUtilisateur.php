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
    //var_dump($user);exit();
    $success = $controlleur->connexion($user);
    //var_dump($success);exit();
    if($success) {
        header('Location: ../../vue/index.php');
        exit();
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

?>
