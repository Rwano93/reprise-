<?php

class Role {

    private $id_role;
    private $libelle;

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

    public function setId_role($id_role) {
        $this->id_role = $id_role;
    }

    public function setLibelle(string $libelle) {
        $this->libelle = $libelle;
    }

    public function getId_role() {
        return $this->id_role;
    }

    public function getLibelle() {
        return $this->libelle;
    }
}
