<?php

class UtilisateurControlleur{

    public function inscription(Utilisateur $user): bool {
        $bdd = (new SQLConnexion())->bdd(); 

        $motDePasse = $user->getMotDePasse();
        if ($motDePasse !== null) {
            $motDePasseHache = password_hash($motDePasse, PASSWORD_DEFAULT); 
            try {
                $req = $bdd->prepare('INSERT INTO user (nom, prenom, email, mdp, ref_role) VALUES (:nom, :prenom, :email, :motDePasse, :ref_role)');
                $req->execute(array('nom' => $user->getNom(), 'prenom' => $user->getPrenom(), 'email' => $user->getEmail(), 'motDePasse' => $motDePasseHache, 'ref_role' => 1)); // Mettez l'ID du rôle par défaut
                return true;
            } catch (Exception $e) {
                var_dump("erreur requete");
                return false;
            }
        } else {
            var_dump("erreur mdp");
            return false;
        }
    }

    public function connexion(Utilisateur $user): bool {
        $bdd = (new SQLConnexion())->bdd();

        $req = $bdd->prepare('SELECT * FROM user WHERE email = :email');
        $req->execute(array('email' => $user->getEmail()));
        $donnees = $req->fetch();
        $req->closeCursor();
        
        if ($donnees) {
            return password_verify($user->getMotDePasse(), $donnees['mdp']);
        } else {
            return false;
        }
    }

    public function deconnexion(): bool {
        session_destroy();
        return true;
    }
}

?>
