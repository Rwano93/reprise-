<?php

class Utilisateur {

private $id_user;
private $nom;
private $prenom;
private $email;
private $mdp; 
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

public function setId_user($id_user) {
    $this->id_user = $id_user;
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

public function setMdp(string $mdp) {
    $this->mdp = $mdp;
}

public function setRef_role(int $ref_role) {
    $this->ref_role = $ref_role;
}

public function getId_user() {
    return $this->id_user;
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

public function getMdp() {
    return $this->mdp;
}

public function getRef_role() {
    return $this->ref_role;
}
}
