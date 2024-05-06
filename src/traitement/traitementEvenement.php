<?php
include '../controleur/EvenementControlleur.php';
include '../model/Evenements.php';
include '../bdd/SQLConnexion.php'; 


$connexion = new SQLConnexion();
$bdd = $connexion->bdd(); 

$controlleur = new EvenementControlleur($bdd);

if(isset($_POST["Ajouter"])) { 
    $donnees = [
        'titre' => $_POST['titre'],
        'date' => $_POST['date'],
        'description' => $_POST['description'],
        'nb_places' => $_POST['nb_places'],
        'image' => isset($_POST['image']) ? $_POST['image'] : ''
    ];
    $evenement = new Evenement($donnees);
    $success = $controlleur->ajouterEvenement($evenement);
    if($success) {
        header('Location: ../../vue/index_admin.php');
        exit();
    } else {
        header('Location: ../../vue/index_admin.php');
        exit();
    }
}

if(isset($_POST["Modifier"])) { 
    $donnees = [
        'id_evenements' => $_POST['id_evenement'], 
        'titre' => $_POST['nouveau_titre'], 
        'date' => $_POST['nouvelle_date'],
        'description' => $_POST['nouvelle_description'],
        'nb_places' => $_POST['nouveau_nb_places'],
        'image' => $_POST['nouvelle_image']
    ];
    $evenement = new Evenement($donnees);
    $success = $controlleur->modifierEvenement($evenement);
    if($success) {
        header('Location: ../../vue/index_admin.php');
        exit();
    } else {
        header('Location: ../../vue/index_admin.php?id='.$donnees['id_evenements']);
        exit();
    }
}

if(isset($_POST["Supprimer"])) { 
    $id_evenements = $_POST['id_evenement']; 
    $success = $controlleur->supprimerEvenement($id_evenements);
    if($success) {
        header('Location: ../../vue/index_admin.php');
        exit();
    } else {
        header('Location: ../../vue/index_admin.php');
        exit();
    }
}

