<?php
session_start();

if(isset($_SESSION['user_id'])) {
    
    $userId = $_SESSION['user_id']; 
    $userRole = getUserRoleFromDatabase($userId); 

    if($userRole === 'Administrateur') {
        header('Location: index_admin.php');
        exit();
    } else {
        header('Location: index.php');
        exit();
    }
} else {
    header('Location: vue/connexion.html'); 
    exit();
}

function getUserRoleFromDatabase($userId) {
    $bdd = new PDO('mysql:host=localhost;dbname=reprise_project;charset=utf8', 'root', '');
    $query = $bdd->prepare('SELECT r.libelle FROM role r JOIN utilisateur u ON r.id_role = u.id_role WHERE u.id_utilisateur = :id');
    $query->execute(['id' => $userId]);
    $result = $query->fetch();
    return $result['libelle'];
}

