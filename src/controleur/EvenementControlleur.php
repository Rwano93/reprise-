<?php



class EvenementControlleur {

    private $bdd;

    public function __construct(PDO $bdd) {
        $this->bdd = $bdd;
    }

    public function getEvenements() {
        $evenements = [];
        $req = $this->bdd->query('SELECT * FROM evenements');
        while ($donnees = $req->fetch()) {
            $evenements[] = new Evenement($donnees);
        }
        return $evenements;
    }

    public function ajouterEvenement(Evenement $evenement) {
        try {
            $req = $this->bdd->prepare('INSERT INTO evenements (titre, date, description, nb_places, image) VALUES (:titre, :date, :description, :nb_places, :image)');
            $req->execute(array(
                'titre' => $evenement->getTitre(),
                'date' => $evenement->getDate(),
                'description' => $evenement->getDescription(),
                'nb_places' => $evenement->getNb_places(),
                'image' => $evenement->getImage()
            ));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function modifierEvenement(Evenement $evenement) {
        try {
            $req = $this->bdd->prepare('UPDATE evenements SET titre = :titre, date = :date, description = :description, nb_places = :nb_places, image = :image WHERE id_evenements = :id_evenements');
            $req->execute(array(
                'id_evenements' => $evenement->getId_evenements(),
                'titre' => $evenement->getTitre(),
                'date' => $evenement->getDate(),
                'description' => $evenement->getDescription(),
                'nb_places' => $evenement->getNb_places(),
                'image' => $evenement->getImage()
            ));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function supprimerEvenement($id_evenements) {
        try {
            $req = $this->bdd->prepare('DELETE FROM evenements WHERE id_evenements = :id_evenements');
            $req->execute(array('id_evenements' => $id_evenements));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    

}

