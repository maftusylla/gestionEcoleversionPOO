<?php

class Eleve {
    public int $id;
    public string $nom;
    public string $prenom;
    public string $matricule;

    public function __construct(int $id = 0, string $nom = "", string $prenom = "", string $matricule = ""){
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->matricule = $matricule;
    }

    public function __toString(){
        return $this->prenom." ".$this->nom;
    }
}