<?php

include '../controleur/RoleControlleur.php';
include '../model/Role.php';
include '../bdd/SQLConnexion.php';



$controlleur = new RoleControlleur();

if(isset($_POST["ajout_role"])) { 
    $donnees = [
        'libelle' => $_POST['libelle']
    ];
    $role = new Role($donnees);
    $success = $controlleur->ajouterRole($role);
    if($success) {
        header('Location: ../../vue/index.php');
        exit();
    } else {
        header('Location: ../../vue/ajout_role.php');
        exit();
    }
}

if(isset($_POST["modifier_role"])) { 
    $donnees = [
        'id_role' => $_POST['id_role'],
        'libelle' => $_POST['libelle']
    ];
    $role = new Role($donnees);
    $success = $controlleur->modifierRole($role);
    if($success) {
        header('Location: ../../vue/index.php');
        exit();
    } else {
        header('Location: ../../vue/modifier_role.php?id='.$donnees['id_role']);
        exit();
    }
}

if(isset($_POST["supprimer_role"])) { 
    $id_role = $_POST['id_role'];
    $success = $controlleur->supprimerRole($id_role);
    if($success) {
        header('Location: ../../vue/index.php');
        exit();
    } else {
        header('Location: ../../vue/index.php');
        exit();
    }
}


