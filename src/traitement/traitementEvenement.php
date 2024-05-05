<?php

include '../controleur/EvenementControlleur.php';
include '../model/Evenements.php';

$controlleur = new EvenementControlleur($bdd);

if(isset($_POST["ajout_evenement"])) { 
    $donnees = [
        'titre' => $_POST['titre'],
        'date' => $_POST['date'],
        'description' => $_POST['description'],
        'nb_places' => $_POST['nb_places'],
        'image' => $_POST['image']
    ];
    $evenement = new Evenement($donnees);
    $success = $controlleur->ajouterEvenement($evenement);
    if($success) {
        header('Location: ../../vue/index.php');
        exit();
    } else {
        header('Location: ../../vue/ajout_evenement.php');
        exit();
    }
}

if(isset($_POST["modifier_evenement"])) { 
    $donnees = [
        'id_evenements' => $_POST['id_evenements'],
        'titre' => $_POST['titre'],
        'date' => $_POST['date'],
        'description' => $_POST['description'],
        'nb_places' => $_POST['nb_places'],
        'image' => $_POST['image']
    ];
    $evenement = new Evenement($donnees);
    $success = $controlleur->modifierEvenement($evenement);
    if($success) {
        header('Location: ../../vue/index.php');
        exit();
    } else {
        header('Location: ../../vue/modifier_evenement.php?id='.$donnees['id_evenements']);
        exit();
    }
}

if(isset($_POST["supprimer_evenement"])) { 
    $id_evenements = $_POST['id_evenements'];
    $success = $controlleur->supprimerEvenement($id_evenements);
    if($success) {
        header('Location: ../../vue/index.php');
        exit();
    } else {
        header('Location: ../../vue/index.php');
        exit();
    }
}
