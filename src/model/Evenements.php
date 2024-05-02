<?php

class Evenement {

    private $id_evenements;
    private $titre;
    private $date;
    private $description;
    private $nb_places;

    public function __construct(array $donnees) {
        $this->hydrater($donnees);
    }

    public function hydrater(array $donnees) {
        foreach ($donnees as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
    }

    public function setId_evenements($id_evenements) {
        $this->id_evenements = $id_evenements;
    }

    public function setTitre(string $titre) {
        $this->titre = $titre;
    }

    public function setDate(string $date) {
        $this->date = $date;
    }

    public function setDescription(string $description) {
        $this->description = $description;
    }

    public function setNb_places(int $nb_places) {
        $this->nb_places = $nb_places;
    }

    public function getId_evenements() {
        return $this->id_evenements;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getDate() {
        return $this->date;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getNb_places() {
        return $this->nb_places;
    }
}
?>
