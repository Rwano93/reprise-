<?php


class RoleControlleur {

    public function ajouterRole(Role $role): bool {
        $bdd = (new SQLConnexion())->bdd(); 
        try {
            $req = $bdd->prepare('INSERT INTO role (libelle) VALUES (:libelle)');
            $req->execute(array('libelle' => $role->getLibelle()));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function modifierRole(Role $role): bool {
        $bdd = (new SQLConnexion())->bdd();
        try {
            $req = $bdd->prepare('UPDATE role SET libelle = :libelle WHERE id_role = :id_role');
            $req->execute(array('libelle' => $role->getLibelle(), 'id_role' => $role->getId_role()));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function supprimerRole(int $id_role): bool {
        $bdd = (new SQLConnexion())->bdd();
        try {
            $req = $bdd->prepare('DELETE FROM role WHERE id_role = :id_role');
            $req->execute(array('id_role' => $id_role));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}


