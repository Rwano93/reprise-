<?php

class UtilisateurControlleur{

    public function inscription($nom, $prenom, $email, $motDePasse, $ref_role){
    $connexion = new SQLConnexion();
    $bdd = $connexion->bdd();

    
    $motDePasseHache = password_hash($motDePasse, PASSWORD_DEFAULT);

    try {
        $req = $bdd->prepare('INSERT INTO user (nom, prenom, email, mdp, ref_role) VALUES (:nom, :prenom, :email, :motDePasse, :ref_role)');
        $req->execute(array('nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'motDePasse' => $motDePasseHache, 'ref_role' => $ref_role));
        return true;
    } catch (Exception $e) {
        return false;
    }
}

    public function connexion($email, $mdp){
    $connexion = new SQLConnexion();
    $bdd = $connexion->bdd();

    $req = $bdd->prepare('SELECT * FROM user WHERE email = :email');
    $req->execute(array('email' => $email));
    $user = $req->fetch();

    if ($user) {
        return $user;
    } else {
        return false;
    }
}
    public function deconnexion(): bool {
        session_destroy();
        return true;
    }
}

