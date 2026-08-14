<?php
class AnneeScolaire {
    public int $id;
    public string $nom;
    public int $actif;

    public function __construct(int $id = 0, string $nom = "", int $actif = 0){
        $this->id = $id;
        $this->nom = $nom;
        $this->actif = $actif;
    }

    public function __toString(){
        return $this->nom;
    }
}