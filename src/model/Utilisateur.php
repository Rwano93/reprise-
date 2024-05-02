<?php

class Utilisateur {

    private $id_utilisateur;
    private $nom;
    private $prenom;
    private $email;
    private $motDePasse; 
    private $ref_role; 

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

    public function setId_utilisateur($id_utilisateur) {
        $this->id_utilisateur = $id_utilisateur;
    }

    public function setNom(string $nom) {
        $this->nom = $nom;
    }

    public function setPrenom(string $prenom) {
        $this->prenom = $prenom;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function setMotDePasse(string $motDePasse) {
        $this->motDePasse = $motDePasse;
    }

    public function setRef_role(int $ref_role) {
        $this->ref_role = $ref_role;
    }

    public function getId_utilisateur() {
        return $this->id_utilisateur;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMotDePasse() {
        return $this->motDePasse;
    }

    public function getRef_role() {
        return $this->ref_role;
    }
}
?>
